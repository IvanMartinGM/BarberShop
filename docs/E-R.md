# Modelo Entidad-Relación
## Sistema de Gestión para Barbería



**Versión:** 1.0  
**Estándar:** Notación crow's foot  
**Base de datos:** MariaDB


## Índice de Entidades

| Entidad | Tipo | Descripción |
|---|---|---|
| [Roles](#roles) | Catálogo | Define los roles disponibles en el sistema |
| [Usuarios](#usuarios) | Core | Credenciales y datos generales de acceso |
| [Clientes](#clientes) | Core | Perfil e historial del cliente |
| [Barberos](#barberos) | Core | Perfil y datos laborales del barbero |
| [Horarios](#horarios) | Catálogo | Bloques de tiempo disponibles |
| [Dias\_Semana](#dias_semana) | Catálogo | Días de la semana disponibles |
| [Servicios](#servicios) | Catálogo | Catálogo de servicios ofrecidos |
| [Citas](#citas) | Transaccional | Registro de citas agendadas |
| [Pagos](#pagos) | Transaccional | Registro de pagos asociados a citas |
| [Metodo\_Pago](#metodo_pago) | Catálogo | Métodos de pago aceptados |

---

## Tablas Intermedias (N:M)

| Tabla | Entidades que relaciona |
|---|---|
| [Usuarios\_Roles](#usuarios_roles) | Usuarios ↔ Roles |
| [Barberos\_Servicios](#barberos_servicios) | Barberos ↔ Servicios |
| [Barberos\_Horarios](#barberos_horarios) | Barberos ↔ Horarios |
| [Horarios\_Dias\_Semana](#horarios_dias_semana) | Horarios ↔ Dias\_Semana |
| [Citas\_Servicios](#citas_servicios) | Citas ↔ Servicios |

---

## Entidades

---

### Roles

Catálogo de roles disponibles en el sistema. Un rol define el nivel de acceso y las acciones permitidas para cada usuario.

```
ROLES
─────────────────────────
id               INT          PK  AUTO_INCREMENT
nombre           VARCHAR(50)  NOT NULL UNIQUE
descripcion      TEXT
```

#### Relaciones

| Cardinalidad | Entidad relacionada | Mediante | Descripción |
|---|---|---|---|
| N:M | Usuarios | Usuarios\_Roles | Un rol puede ser asignado a muchos usuarios; un usuario puede tener muchos roles |

---

### Usuarios

Entidad central del sistema. Almacena las credenciales de acceso y los datos de identificación de todos los actores del sistema, independientemente de su rol.

```
USUARIOS
─────────────────────────
id                 INT           PK  AUTO_INCREMENT
nombres            VARCHAR(100)  NOT NULL
primerApellido     VARCHAR(60)   NOT NULL
segundoApellido    VARCHAR(60)
correo             VARCHAR(150)  NOT NULL UNIQUE
contrasena         VARCHAR(255)  NOT NULL
estado             TINYINT(1)    DEFAULT 1
nombreUsuario      VARCHAR(60)   NOT NULL UNIQUE
fecha_registro     TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
ultimo_acceso      TIMESTAMP
genero             ENUM('M','F','otro')
foto_perfil        VARCHAR(255)
celular            VARCHAR(20)
```
#### Relaciones

| Cardinalidad | Entidad relacionada | Mediante | Descripción |
|---|---|---|---|
| N:M | Roles | Usuarios\_Roles | Un usuario puede tener muchos roles |
| 1:1 | Clientes | FK id\_usuario | Un usuario puede ser un cliente |
| 1:1 | Barberos | FK id\_usuario | Un usuario puede ser un barbero |

---

### Clientes

Extiende la entidad Usuarios con atributos propios del perfil de cliente: historial, preferencias, puntos de fidelidad y datos relevantes para la atención.

```
CLIENTES
─────────────────────────
id_cliente              INT           PK  AUTO_INCREMENT
id_usuario              INT           FK UNIQUE → Usuarios.id
fecha_nacimiento        DATE
ultima_visita           TIMESTAMP
tipo_cliente            VARCHAR(50)
puntos_fidelidad        INT           DEFAULT 0
acepta_notificaciones   TINYINT(1)    DEFAULT 1
notas_generales         TEXT
total_visitas           INT           DEFAULT 0
total_gastado           DECIMAL(10,2) DEFAULT 0.00
```

#### Relaciones

| Cardinalidad | Entidad relacionada | Mediante | Descripción |
|---|---|---|---|
| 1:1 | Usuarios | FK id\_usuario | Un cliente es exactamente un usuario |
| 1:N | Citas | FK id\_cliente en Citas | Un cliente puede agendar muchas citas |

---

### Barberos

Extiende la entidad Usuarios con atributos propios del perfil del barbero: especialidad, disponibilidad, calificación y experiencia.

```
BARBEROS
─────────────────────────
id                       INT           PK  AUTO_INCREMENT
id_usuario               INT           FK UNIQUE → Usuarios.id
estado_disponibilidad    ENUM('disponible','ocupado','inactivo')
especialidad             VARCHAR(150)
biografia                TEXT
fecha_contratacion       DATE
calificacion_promedio    DECIMAL(3,2)  DEFAULT 0.00
experiencia_anos         INT           DEFAULT 0
```

#### Relaciones

| Cardinalidad | Entidad relacionada | Mediante | Descripción |
|---|---|---|---|
| 1:1 | Usuarios | FK id\_usuario | Un barbero es exactamente un usuario |
| N:M | Servicios | Barberos\_Servicios | Un barbero puede realizar muchos servicios; un servicio puede ser realizado por muchos barberos |
| 1:N | Citas | FK id\_barbero en Citas | Un barbero atiende muchas citas |
| N:M | Horarios | Barberos\_Horarios | Un barbero puede tener muchos horarios asignados |

---

### Horarios

Define los bloques de tiempo disponibles que pueden asignarse a los barberos y vincularse a días específicos de la semana.

```
HORARIOS
─────────────────────────
id             INT          PK  AUTO_INCREMENT
nombre_horario VARCHAR(80)  NOT NULL
descripcion    TEXT
hora_inicio    TIME         NOT NULL
hora_fin       TIME         NOT NULL
estado         TINYINT(1)   DEFAULT 1
```

#### Relaciones

| Cardinalidad | Entidad relacionada | Mediante | Descripción |
|---|---|---|---|
| N:M | Barberos | Barberos\_Horarios | Un horario puede ser asignado a muchos barberos |
| N:M | Dias\_Semana | Horarios\_Dias\_Semana | Un horario puede aplicar a muchos días de la semana |

---

### Dias\_Semana

Catálogo estático de los días de la semana. Permite asociar horarios a días específicos con una relación N:M.

```
DIAS_SEMANA
─────────────────────────
id          INT          PK  AUTO_INCREMENT
nombre_dia  VARCHAR(20)  NOT NULL UNIQUE
```

#### Relaciones

| Cardinalidad | Entidad relacionada | Mediante | Descripción |
|---|---|---|---|
| N:M | Horarios | Horarios\_Dias\_Semana | Un día puede tener muchos horarios; un horario puede aplicar a muchos días |

---

### Servicios

Catálogo de servicios ofrecidos por la barbería. Incluye precio base, duración estimada y categoría para facilitar la búsqueda y el cálculo automático del costo de una cita.

```
SERVICIOS
─────────────────────────
id                  INT            PK  AUTO_INCREMENT
nombre_servicio     VARCHAR(100)   NOT NULL
descripcion         TEXT
precio_base         DECIMAL(8,2)   NOT NULL
duracion_minutos    INT            NOT NULL
categoria           VARCHAR(60)
estado              TINYINT(1)     DEFAULT 1
created_at          TIMESTAMP      DEFAULT CURRENT_TIMESTAMP
updated_at          TIMESTAMP      ON UPDATE CURRENT_TIMESTAMP
```

> **Nota:** Se agregan `timestamps` en esta entidad transaccional/catálogo para facilitar auditoría y control de cambios.

#### Relaciones

| Cardinalidad | Entidad relacionada | Mediante | Descripción |
|---|---|---|---|
| N:M | Barberos | Barberos\_Servicios | Un servicio puede ser ofrecido por muchos barberos |
| N:M | Citas | Citas\_Servicios | Muchos servicios puede estar incluido en muchas citas |

---

### Citas

Entidad transaccional central. Registra cada cita agendada, vinculando un cliente, un barbero, uno o más servicios, y un estado que refleja el ciclo de vida de la cita.

```
CITAS
─────────────────────────
id                    INT      PK  AUTO_INCREMENT
id_cliente            INT      FK → Clientes.id_cliente  NOT NULL
id_barbero            INT      FK → Barberos.id           NOT NULL
fecha_cita            DATE     NOT NULL
hora_inicio           TIME     NOT NULL
hora_fin              TIME     NOT NULL
estado_cita           ENUM('pendiente','confirmada','cancelada','completada')
                               DEFAULT 'pendiente'
observaciones         TEXT
created_at            TIMESTAMP  DEFAULT CURRENT_TIMESTAMP
updated_at            TIMESTAMP  ON UPDATE CURRENT_TIMESTAMP
```

> **Nota:** Se agregan `timestamps` en esta entidad transaccional.

#### Relaciones

| Cardinalidad | Entidad relacionada | Mediante | Descripción |
|---|---|---|---|
| N:1 | Clientes | FK id\_cliente | Muchas citas pertenecen a un mismo cliente |
| N:1 | Barberos | FK id\_barbero | Muchas citas son atendidas por un mismo barbero |
| 1:1 | Pagos | FK id\_cita en Pagos | Cada cita tiene exactamente un pago asociado |
| N:M | Servicios | Citas\_Servicios | Una cita puede incluir uno o más servicios |

---


### Pagos

Entidad transaccional que registra el pago asociado a una cita. Cada cita tiene exactamente un pago; cada pago está vinculado a un solo método de pago.

```
PAGOS
─────────────────────────
id                       INT            PK  AUTO_INCREMENT
id_cita                  INT            FK UNIQUE → Citas.id  NOT NULL
id_metodo_pago           INT            FK → Metodo_Pago.id   NOT NULL
monto                    DECIMAL(10,2)  NOT NULL
fecha_pago               TIMESTAMP      DEFAULT CURRENT_TIMESTAMP
estado_pago              ENUM('pendiente','pagado','cancelado','reembolsado')
                                        DEFAULT 'pendiente'
referencia_transaccion   VARCHAR(150)
concepto                 VARCHAR(255)
created_at               TIMESTAMP      DEFAULT CURRENT_TIMESTAMP
updated_at               TIMESTAMP      ON UPDATE CURRENT_TIMESTAMP
```

> **Nota:** Se agregan `timestamps` en esta entidad transaccional.

#### Relaciones

| Cardinalidad | Entidad relacionada | Mediante | Descripción |
|---|---|---|---|
| 1:1 | Citas | FK id\_cita UNIQUE | Un pago está asociado a exactamente una cita |
| N:1 | Metodo\_Pago | FK id\_metodo\_pago | Muchos pagos pueden usar el mismo método de pago |

---

### Metodo\_Pago

Catálogo de métodos de pago aceptados por el sistema. Actualmente contempla efectivo y PayPal.

```
METODO_PAGO
─────────────────────────
id              INT          PK  AUTO_INCREMENT
nombre_metodo   VARCHAR(60)  NOT NULL UNIQUE
descripcion     TEXT
estado          TINYINT(1)   DEFAULT 1
```

#### Relaciones

| Cardinalidad | Entidad relacionada | Mediante | Descripción |
|---|---|---|---|
| 1:N | Pagos | FK id\_metodo\_pago en Pagos | Un método de pago puede estar en muchos pagos |

---

## Tablas Intermedias

---

### Usuarios\_Roles

Resuelve la relación N:M entre **Usuarios** y **Roles**. Registra la fecha de asignación y el estado actual del rol para cada usuario.

```
USUARIOS_ROLES
─────────────────────────
id_usuario        INT        PK  FK → Usuarios.id
id_rol            INT        PK  FK → Roles.id
fecha_asignacion  TIMESTAMP  DEFAULT CURRENT_TIMESTAMP
estado            TINYINT(1) DEFAULT 1
```

**Clave primaria compuesta:** `(id_usuario, id_rol)`

---

### Barberos\_Servicios

Resuelve la relación N:M entre **Barberos** y **Servicios**. Permite saber qué barberos ofrecen qué servicios.

```
BARBEROS_SERVICIOS
─────────────────────────
id_barbero    INT  PK  FK → Barberos.id
id_servicio   INT  PK  FK → Servicios.id
estado            TINYINT(1) DEFAULT 1
created_at  TIMESTAMP  DEFAULT CURRENT_TIMESTAMP
updated_at  TIMESTAMP  DEFAULT CURRENT_TIMESTAMP
```

**Clave primaria compuesta:** `(id_barbero, id_servicio)`

---

### Barberos\_Horarios

Resuelve la relación N:M entre **Barberos** y **Horarios**. Registra la fecha de asignación del horario y su estado.

```
BARBEROS_HORARIOS
─────────────────────────
id_barbero        INT        PK  FK → Barberos.id
id_horario        INT        PK  FK → Horarios.id
fecha_asignacion  TIMESTAMP  DEFAULT CURRENT_TIMESTAMP
estado            TINYINT(1) DEFAULT 1
```

**Clave primaria compuesta:** `(id_barbero, id_horario)`

---

### Horarios\_Dias\_Semana

Resuelve la relación N:M entre **Horarios** y **Dias\_Semana**. Permite que un horario aplique a varios días, y que un día tenga varios horarios.

```
HORARIOS_DIAS_SEMANA
─────────────────────────
id_horario    INT  PK  FK → Horarios.id
id_dia        INT  PK  FK → Dias_Semana.id
```

**Clave primaria compuesta:** `(id_horario, id_dia)`

---

### Citas\_Servicios

Resuelve la relación N:M entre **Citas** y **Servicios**. Almacena el precio y duración real aplicados en el momento de la cita, independientemente de cambios futuros en el catálogo.

```
CITAS_SERVICIOS
─────────────────────────
id_cita                 INT            PK  FK → Citas.id
id_servicio             INT            PK  FK → Servicios.id
precio_aplicado         DECIMAL(8,2)   NOT NULL
hora_inicio_real        Timestamp NULL
hora_fin_real           Timestamp NULL
duracion_real_minutos   INT
observaciones_servicio  TEXT
```

**Clave primaria compuesta:** `(id_cita, id_servicio)`

> **Nota:** `precio_aplicado` y `duracion_servicio` preservan el valor histórico del servicio al momento de la cita. El costo total de la cita se calcula como `SUM(precio_aplicado)` sobre los registros de esta tabla.

---

## Resumen de Cardinalidades

```
Usuarios    ──(N:M)──  Roles               [via Usuarios_Roles]
Usuarios    ──(1:1)──  Clientes
Usuarios    ──(1:1)──  Barberos
Clientes    ──(1:N)──  Citas
Barberos    ──(1:N)──  Citas
Barberos    ──(N:M)──  Servicios           [via Barberos_Servicios]
Barberos    ──(N:M)──  Horarios            [via Barberos_Horarios]
Horarios    ──(N:M)──  Dias_Semana         [via Horarios_Dias_Semana]
Citas       ──(N:M)──  Servicios           [via Citas_Servicios]
Citas       ──(1:1)──  Pagos
Pagos       ──(N:1)──  Metodo_Pago
```

---

## Notas Generales

### Timestamps

Se agregan `created_at` y `updated_at` en todas las entidades transaccionales según lo acordado en el diseño:

| Entidad | Timestamps |
|---|---|
| Citas | `created_at`, `updated_at` |
| Pagos | `created_at`, `updated_at` |
| Servicios | `created_at`, `updated_at` |

### Soft Delete

Las entidades que requieren eliminación lógica implementan un campo `estado TINYINT(1)` en lugar de borrado físico:

- `Usuarios.estado`
- `Servicios.estado`
- `Horarios.estado`
- `Metodo_Pago.estado`
- `Usuarios_Roles.estado`
- `Barberos_Horarios.estado`

### Enums

| Campo | Valores válidos |
|---|---|
| `Usuarios.genero` | `M`, `F`, `otro` |
| `Barberos.estado_disponibilidad` | `disponible`, `ocupado`, `inactivo` |
| `Citas.estado_cita` | `pendiente`, `confirmada`, `cancelada`, `completada` |
| `Pagos.estado_pago` | `pendiente`, `pagado`, `cancelado`, `reembolsado` |

### Integridad Referencial

Todas las claves foráneas deben definirse con restricciones explícitas (`FOREIGN KEY ... REFERENCES`) en MariaDB. Las operaciones de eliminación en entidades padres deben evaluarse caso por caso:

- `Usuarios` → `Clientes` / `Barberos`: `ON DELETE RESTRICT` (no se elimina un usuario si tiene perfil activo)
- `Citas` → `Pagos`: `ON DELETE RESTRICT` (no se elimina una cita con pago registrado)
- Tablas intermedias: `ON DELETE CASCADE` donde corresponda














