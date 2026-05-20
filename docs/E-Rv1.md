
-----------------------------------
Entidad: Roles
-----------------------------------

Roles
---------
id
nombre
descripcion



Cardinalidad
roles (N)----- (N)usuarios

Que se resuleve con

USUARIOS_ROLES
-----------------------------
id_usuario (PK)(FK)

id_rol (PK)(FK)

fecha_asignacion

estado

Relacion: 
Cada rol puede ser asignado a muchos usuarios. 

-----------------------------------
Entidad: Usuarios
-----------------------------------



id
nombres
primerApellido
segundoApellido
correo
contrasena
estado
nombreUsuario
fecha_registro
ultimo_acceso
genero
foto_perfil
celular

Cardinalidad
usuarios (1)----- (1)clientes

Relacion:
Un usuario puede ser un cliente

usuarios (1)----- (1)barberos

Relacion:
Un usuario puede ser un barbero

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
ENTIDAD: CLIENTES
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

CLIENTES
-----------------------------
id_cliente (PK)

id_usuario (FK UNIQUE)

fecha_nacimiento

ultima_visita

tipo_cliente

alergias

puntos_fidelidad

acepta_notificaciones

notas_generales

total_visitas

total_gastado


CARDINALIDAD:
           llamdaa agenda
CLIENTES (1) ─────────── (N) CITAS

RELACIÓN:
UN CLIENTE REALIZA MUCHAS CITAS.

Cardinalidad:
clientes (1) ----- usuarios (1) 

Relacion:
Un usuario puede ser un cliente



━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
ENTIDAD: BARBEROS
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

BARBEROS
-----------------------------
id (PK)

id_usuario (FK UNIQUE)

estado_disponibilidad

especialidad -> descripcion corta

biografia

fecha_contratacion

calificacion_promedio

experiencia_anos


CARDINALIDADES:


Relacion:
UN barbero es un usuario, y un usuario es un barbero.

Mediante:
BARBEROS (1) ─────────── (1) Usuarios


BARBEROS (N) ─────────── (N) SERVICIOS

Mediante: 
Aqui se gener una nueva tabla llamda 
Barberos_Servicios

RELACIÓN:
un barbero puede realizar muchos servicios y un servicio
puede ser realizado por muchos barberos

BARBEROS (1) ─────────── (N) CITAS

RELACIÓN:
UN BARBERO ATIENDE MUCHAS CITAS, 
pero solo un barbero atiende a una cita


BARBEROS (N) ─────────── (N) HORARIOS
MEDIANTE:

BARBEROS_HORARIOS
-----------------------------
id_barbero (PK)(FK)

id_horario (PK)(FK)

fecha_asignacion

estado



RELACIÓN:
UN BARBERO PUEDE TENER MUCHOS HORARIOS.
Muchos horarios pueden ser asignados a varios
barberos


━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
ENTIDAD: Horario
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

id
nombre_HORARIO
descripcion
hora_inicio
hora_fin
estado



Cardinalidad: 

Relacion: 

Muchos barberos pueden tener muchos horarios, muchos horarios pueden estar enlazados a muchos barberos 

HORARIOS(N) ─────────── (N) BARBEROS

Mediante la tabal auxiliar barberos_horarios- 


Muchos horarios pueden estar enlazados a muchos dias de la semana 
y muchos dias de la semana pueden estar enlazados a muchos horarios

HORARIOS(N) ─────────── (N) dias_semana

Mediante la tabla auxiliar horarios_dias_semana

HORARIOS_DIAS_SEMANA
-----------------------------
id_horario (PK)(FK)

id_dia (PK)(FK)
Mediante: 
Muchos horarios pueden estar enlazados a muchos dias de la semana 
y muchos dias de la semana pueden estar enlazados a muchos horarios
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
ENTIDAD: Dias_Semana 
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

Atributos: 
id
nombre_dia



Cardinalidad: 

Relacion: 

*Muchos barberos pueden tener muchos horarios, muchos horarios pueden estar enlazados a muchos barberos 

HORARIOS(N) ─────────── (N) BARBEROS

Mediante la tabal auxiliar barberos_horarios- 


Muchos horarios pueden estar enlazados a muchos dias de la semana 
y muchos dias de la semana pueden estar enlazados a muchos horarios

Relacion:
dias_semana(N) ─────────── (N) horarios

Mediante la tabla auxiliar horarios_dias_semana

HORARIOS_DIAS_SEMANA
-----------------------------
id_horario (PK)(FK)

id_dia (PK)(FK)


━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
ENTIDAD: Servicios 
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

Atributos:

id
nombre_servicio
descripcion
precio_base
duracion_minutos
categoria
estado

Cardinalidad:

*BARBEROS (N) ─────────── (N) SERVICIOS

Mediante: 
Aqui se gener una nueva tabla llamada 
Barberos_Servicios, con sus respectivos atributos

RELACIÓN:
un barbero puede realizar muchos servicios y un servicio
puede ser realizado por muchos barberos

*SERVICIOS (N)  ─────────── (N) CITAS

MEDIANTE: 
Se egenera una tabla intermedia llamada citas_servicios
con sus respectivos atributos

-----------------------------
id_cita (PK)(FK)

id_servicio (PK)(FK)

precio_aplicado

duracion_servicio

observaciones_servicio

Relacion:
Un servicio puede estar enlazado en diversas citas, y una cita 
puede tener diversos servicios. 


━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
ENTIDAD: Citas
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

Atributos: 
id
idCLiente (fk)
idBarbero (fk)
creada_por_usuario (fk)
fecha_cita
hora_inicio
hora_fin
estado_cita -> sera un enum pendinte, confirmada, cancelada, completada. 
observaciones
fecha_registro


Cardinalidad:

*Citas (N)  ─────────── (1) clientes


Mediante: Aqui muchas citas pueden estar egendadas por el mismo cliente
y un solo cliente puede estar enlazado a muchas citas  

Relacion: La relacion llamada agenda

*Citas (1)  ─────────── (1) pagos

Mediante: Aqui caa cita estara enlazada a un solo y unico pago, y un pago 
estara enlazado a una sola cita. 

*SERVICIOS (N)  ─────────── (N) CITAS

MEDIANTE: 
Se egenera una tabla intermedia llamada citas_servicios
con sus respectivos atributos

-----------------------------
id_cita (PK)(FK)

id_servicio (PK)(FK)

precio_aplicado

duracion_servicio

observaciones_servicio

Relacion:
Un servicio puede estar enlazado en diversas citas, y una cita 
puede tener diversos servicios. 

BARBEROS (1) ─────────── (N) CITAS

RELACIÓN:
UN BARBERO ATIENDE MUCHAS CITAS, 
pero solo un barbero atiende a una cita
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
ENTIDAD: Pagos
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

Atributos: 

id
idCitas (fk unique)
idMetodo_pago (fk)
monto
fecha_pago
estado_pago -> enum (pendiente  pagado cancelado reembolsado)
referencia_transaccion
concepto -> como los bancos, en vez de observaciones


Cardinalidad: 

Relacion: La relacion llamada agenda

*Citas (1)  ─────────── (1) pagos

Mediante: Aqui caa cita estara enlazada a un solo y unico pago, y un pago 
estara enlazado a una sola cita. 

*Pagos (N)  ─────────── (1) Metodo_Pago

Mediante: LA relacion se utiliza_con

Aqui cada Pago estara enlazado con un solo Metodo_Pago, y 
un solo metodo de pago estara enlazado a muchos pagos. 


━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
ENTIDAD: Metodo_Pago
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

Atributos: 

id
nombre_metodo
descripcion
estado

Cardinalidad: 

*Pagos (N)  ─────────── (1) Metodo_Pago

Mediante: LA relacion se utiliza_con

Aqui cada Pago estara enlazado con un solo Metodo_Pago, y 
un solo metodo de pago estara enlazado a muchos pagos. 


AGREGA timestamps

En entidades transaccionales:

CITAS
PAGOS
SERVICIOS