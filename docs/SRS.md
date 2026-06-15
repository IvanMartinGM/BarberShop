# Especificación de Requisitos de Software (SRS)

# Sistema de Gestión para Barbería

**Versión:** 1.0
**Fecha:** 2026
**Estándar:** IEEE 830-1998

---

## Historial de Versiones

| Versión | Fecha | Descripción |
|---------|-------|-------------|
| 1.0 | 2026 | Versión inicial del documento |


---

# 1. Introducción

## 1.1 Propósito

El propósito de este documento es definir de manera formal los requisitos funcionales y no funcionales del Sistema de Gestión para Barbería. Describe las características, restricciones, interfaces, objetivos y comportamiento esperado del sistema.

Este documento sirve como referencia principal para el desarrollador, y establece un acuerdo claro sobre lo que el sistema debe hacer antes de iniciar su desarrollo.

---

## 1.2 Alcance

El Sistema de Gestión para Barbería es una aplicación web monolítica desarrollada con **Laravel 13**, siguiendo el patrón de arquitectura **MVC (Modelo-Vista-Controlador)**. La capa de presentación se construye con **Blade** (motor de plantillas de Laravel) y **Tailwind CSS** como framework de estilos, utilizado tanto en las vistas públicas como en el panel administrativo para barberos, administradores y clientes autenticados. El módulo de autenticación se basa en **Laravel Breeze** (stack Blade), que provee el flujo de inicio de sesión, registro, recuperación de contraseña y gestión de perfil sobre el cual se construye el control de acceso por roles. Las gráficas y reportes visuales del panel se implementan mediante **Chart.js**.

El sistema busca optimizar el proceso de agendado de citas y el flujo de trabajo general de la barbería, centralizando su información administrativa en una sola aplicación.

El sistema permitirá:

- Gestión de usuarios y roles
- Administración de barberos
- Gestión de clientes
- Administración de servicios
- Programación de citas
- Gestión de horarios de barberos
- Registro de pagos en efectivo o mediante PayPal
- Control de acceso basado en roles

---

## 1.3 Definiciones, Acrónimos y Abreviaciones

| Término | Definición |
|---------|-----------|
| MVC | Modelo-Vista-Controlador — patrón de arquitectura de software |
| SRS | Software Requirements Specification — Especificación de Requisitos de Software |
| RF | Requisito Funcional |
| RNF | Requisito No Funcional |
| CRUD | Crear, Leer, Actualizar y Eliminar |
| ORM | Object-Relational Mapping — mapeo objeto-relacional |
| Eloquent | ORM incluido en Laravel para interactuar con la base de datos |
| Blade | Motor de plantillas de Laravel para construir las vistas |
| Tailwind CSS | Framework de utilidades CSS utilizado para construir la interfaz del panel y las vistas públicas |
| Laravel Breeze | Paquete oficial de Laravel que provee el andamiaje de autenticación (login, registro, recuperación de contraseña, perfil) basado en sesiones, sobre el stack Blade |
| Chart.js | Librería JavaScript utilizada para renderizar gráficas en el dashboard y los reportes de ingresos |
| RBAC | Role-Based Access Control — control de acceso basado en roles |
| Cliente | Usuario que agenda servicios en la barbería |
| Barbero | Empleado encargado de realizar los servicios |
| Administrador | Usuario con los accesos más altos del sistema |
| Middleware | Capa intermedia de Laravel que filtra las peticiones HTTP (p. ej. autenticación y roles) |
| Soft delete | Eliminación lógica de un registro sin borrarlo físicamente de la base de datos |
| Sesión | Mecanismo de Laravel para mantener el estado de autenticación del usuario entre peticiones |

---

## 1.4 Referencias

- IEEE 830-1998 — Software Requirements Specification Standard
- Documentación oficial de Laravel 13: https://laravel.com/docs
- Documentación oficial de Eloquent ORM: https://laravel.com/docs/eloquent
- Documentación oficial de Blade: https://laravel.com/docs/blade
- Documentación oficial de Laravel Breeze: https://laravel.com/docs/starter-kits#breeze
- Documentación oficial de Tailwind CSS: https://tailwindcss.com/docs
- Documentación oficial de Chart.js: https://www.chartjs.org/docs/latest/
- Documentación oficial de MariaDB: https://mariadb.com/kb/en/
- Documentación oficial de PayPal REST API: https://developer.paypal.com/docs/api

---

## 1.5 Visión General del Documento

Este documento está organizado de la siguiente manera:

- La sección 1 presenta la introducción general del proyecto.
- La sección 2 describe la perspectiva general del sistema.
- La sección 3 define los requisitos específicos funcionales y no funcionales.
- La sección 4 presenta restricciones de diseño.
- La sección 5 describe los requisitos de la base de datos.
- La sección 6 contiene el cronograma preliminar.
- La sección 7 incluye apéndices, diagramas y el mapa de rutas/vistas del sistema.

---

# 2. Descripción General

## 2.1 Perspectiva del Producto

El Sistema de Gestión para Barbería es una aplicación web **monolítica** construida sobre el framework **Laravel 13**, siguiendo el patrón **MVC**:

- **Modelo:** Clases Eloquent que representan las entidades del sistema (Usuario, Cliente, Barbero, Servicio, Cita, Pago, etc.) y gestionan el acceso a la base de datos **MariaDB**.
- **Vista:** Plantillas **Blade** que renderizan la interfaz utilizando **Tailwind CSS** para los estilos, con componentes Blade reutilizables compartidos entre el panel administrativo y las vistas públicas.
- **Controlador:** Clases que reciben las peticiones HTTP, aplican la lógica de negocio a través de los modelos, y devuelven la vista correspondiente.

La autenticación y el control de acceso se manejan mediante el sistema de **sesiones** de Laravel (no se utiliza JWT ni API REST). El control de acceso basado en roles se implementa mediante **middlewares** personalizados.

---

## 2.2 Funciones del Producto

Las principales funciones del sistema son:

- Inicio y cierre de sesión mediante autenticación basada en sesiones de Laravel
- Gestión de usuarios y roles (RBAC)
- Gestión de clientes
- Gestión de barberos y sus horarios
- Administración del catálogo de servicios con precio y duración
- Programación de citas sin traslapes
- Registro de pagos en efectivo o mediante PayPal
- Visualización del historial de citas por cliente
- Generación de reportes básicos de ingresos, visualizados mediante gráficas (Chart.js)
- Panel administrativo construido con Blade y Tailwind CSS, con vistas diferenciadas según el rol del usuario

---

## 2.3 Características de los Usuarios

### Administrador

- Acceso total a todas las funcionalidades del sistema a través del panel administrativo.
- Gestiona usuarios y asigna roles.
- Administra el catálogo de servicios.
- Administra los horarios de los barberos.
- Supervisa citas, pagos y genera reportes de ingresos.

### Barbero

- Visualiza sus citas asignadas desde su panel.
- Consulta su horario de trabajo.
- Consulta y selecciona los servicios que ofrece.

### Cliente

- Se registra en el sistema mediante un formulario público.
- Agenda y cancela citas seleccionando barbero, servicio, fecha y hora.
- Consulta el historial de sus citas.
- Visualiza el catálogo de servicios disponibles y los barberos disponibles.
- Realiza pagos en efectivo o mediante PayPal.

---

## 2.4 Restricciones Generales

- El sistema debe desarrollarse exclusivamente con **Laravel 13** y **PHP 8.2+**.
- La aplicación debe seguir el patrón de arquitectura **MVC**.
- La interacción con la base de datos debe realizarse a través de **Eloquent ORM**.
- La interfaz de usuario debe construirse con **Blade** y **Tailwind CSS**.
- La autenticación debe implementarse mediante **Laravel Breeze** (stack Blade), sobre el sistema de **sesiones** de Laravel.
- La base de datos utilizada será **MariaDB**.
- La integración de pagos en línea se realizará exclusivamente mediante la API REST de PayPal, consumida desde el backend de Laravel.
- El proyecto debe completarse en un plazo máximo de 2 meses.

---

## 2.5 Suposiciones y Dependencias

- Los usuarios contarán con acceso a internet.
- Los usuarios utilizarán navegadores modernos con soporte para ES6+ (Chrome, Firefox, Edge, Safari en sus versiones actuales).
- JavaScript debe estar habilitado en el navegador del usuario para los componentes interactivos del panel (gráficas con Chart.js, validaciones de formularios, comportamiento de la interfaz con Alpine.js).
- El entorno de servidor debe ser compatible con PHP 8.2+ para ejecutar Laravel 13.
- El sistema depende de la disponibilidad de la API REST de PayPal para procesar pagos en línea.
- Se asume que la barbería opera con horarios fijos semanales configurados por el administrador.

---

# 3. Requisitos Específicos

# 3.1 Requisitos Funcionales

## 3.1.1 Autenticación

- **RF-01** El sistema debe proporcionar un formulario de inicio de sesión mediante correo electrónico y contraseña.
- **RF-02** El sistema debe validar las credenciales del usuario antes de permitir el acceso e iniciar una sesión autenticada.
- **RF-03** El sistema debe restringir el acceso a todas las vistas y rutas protegidas únicamente a usuarios con sesión activa, mediante middleware `auth`.
- **RF-04** El sistema debe implementar control de acceso basado en roles (RBAC) mediante middleware, diferenciando entre administrador, barbero y cliente.
- **RF-05** El sistema debe proporcionar una opción de cierre de sesión que invalide la sesión activa del usuario.
- **RF-06** El sistema debe permitir la recuperación de contraseña mediante un enlace enviado al correo electrónico registrado.

---

## 3.1.2 Gestión de Usuarios y Roles

- **RF-07** El sistema debe permitir al administrador registrar nuevos usuarios con rol de administrador o barbero desde el panel.
- **RF-08** El sistema debe permitir a cualquier persona registrarse en la plataforma como cliente mediante un formulario público de registro.
- **RF-09** El sistema debe permitir al administrador actualizar la información de cualquier usuario.
- **RF-10** El sistema debe permitir al administrador asignar uno o más roles a un usuario, con la restricción de que el rol de cliente es exclusivo y no puede combinarse con ningún otro rol.
- **RF-11** El sistema debe limitar las vistas y opciones de menú disponibles según los roles del usuario autenticado. Si un usuario posee múltiples roles, el sistema debe otorgarle las funcionalidades combinadas de todos sus roles activos.

---

## 3.1.3 Gestión de Barberos

- **RF-12** El sistema debe permitir registrar barberos con su información personal y de contacto.
- **RF-13** El sistema debe permitir actualizar la información de un barbero existente.
- **RF-14** El sistema debe mostrar una vista con el listado de barberos disponibles.
- **RF-15** El sistema debe permitir al administrador configurar los horarios de trabajo de cada barbero.
- **RF-16** El sistema debe permitir al barbero seleccionar, desde el catálogo general, los servicios que él ofrece y realiza.

---

## 3.1.4 Gestión de Servicios

- **RF-17** El sistema debe permitir al administrador registrar servicios en el catálogo.
- **RF-18** El sistema debe permitir al administrador actualizar la información de un servicio existente.
- **RF-19** El sistema debe permitir al administrador eliminar servicios del catálogo de forma lógica (soft delete), sin borrarlos físicamente de la base de datos.
- **RF-20** El sistema debe mostrar una vista con los servicios activos disponibles.
- **RF-21** El sistema debe almacenar el precio y la duración estimada en minutos de cada servicio.

---

## 3.1.5 Gestión de Citas

- **RF-22** El sistema debe permitir a los clientes programar citas seleccionando un barbero, uno o más servicios, fecha y hora disponible, mediante un formulario.
- **RF-23** El sistema debe permitir cancelar una cita con al menos 24 horas de anticipación a la fecha y hora programada.
- **RF-24** El sistema debe validar y prevenir la creación de citas superpuestas para el mismo barbero en el mismo horario.
- **RF-25** El sistema debe almacenar el historial de todas las citas y permitir su consulta filtrada por cliente, barbero o fecha desde el panel.
- **RF-26** Cada cita debe estar asociada a un cliente, un barbero y uno o más servicios del catálogo.

---

## 3.1.6 Gestión de Pagos

- **RF-27** El sistema debe registrar los pagos asociados a una cita, indicando el método utilizado: efectivo o PayPal.
- **RF-28** El sistema debe almacenar el historial completo de todos los pagos realizados.
- **RF-29** El sistema debe calcular automáticamente el costo total de una cita en función de los servicios seleccionados.
- **RF-30** El sistema debe integrarse con la API REST de PayPal, desde el backend de Laravel, para procesar pagos en línea.
- **RF-31** El sistema debe generar reportes básicos de ingresos filtrables por período de tiempo, mostrados en una vista del panel mediante gráficas implementadas con Chart.js.

---

# 3.2 Requisitos No Funcionales

## 3.2.1 Rendimiento

- **RNF-01** El sistema debe soportar al menos 50 usuarios concurrentes sin degradación notable del servicio.
- **RNF-02** Las vistas y operaciones del sistema deben cargar en menos de 2 segundos bajo condiciones normales de carga.

---

## 3.2.2 Seguridad

- **RNF-03** Las contraseñas deben almacenarse utilizando algoritmos de hash seguros (bcrypt, mediante el helper `Hash` de Laravel).
- **RNF-04** El sistema debe validar y sanear todas las entradas del usuario en el servidor utilizando los **Form Requests** de Laravel, para prevenir inyección SQL y XSS.
- **RNF-05** El sistema debe utilizar HTTPS en el entorno de producción.
- **RNF-06** Las sesiones deben invalidarse correctamente al cerrar sesión.
- **RNF-07** El sistema debe implementar protección CSRF en todos los formularios mediante el token `@csrf` de Laravel.
- **RNF-08** La integración con PayPal debe realizarse del lado del servidor, nunca exponiendo credenciales en las vistas Blade ni en JavaScript del cliente.

---

## 3.2.3 Confiabilidad

- **RNF-09** El sistema debe mantener la consistencia de los datos mediante el uso de transacciones de base de datos en operaciones críticas.
- **RNF-10** Las operaciones críticas como el registro de pagos y la creación de citas deben revertirse completamente (rollback) en caso de error.

---

## 3.2.4 Mantenibilidad

- **RNF-11** El sistema debe seguir el patrón de arquitectura **MVC** propio de Laravel, separando claramente modelos, controladores y vistas.
- **RNF-12** La interacción con la base de datos debe realizarse exclusivamente a través de **Eloquent ORM**, evitando consultas SQL en crudo salvo casos justificados.
- **RNF-13** El código del proyecto debe organizarse siguiendo la estructura de carpetas estándar de Laravel (`app/Models`, `app/Http/Controllers`, `resources/views`, etc.).
- **RNF-14** Las vistas deben reutilizar componentes y layouts de Blade (`@extends`, `@include`, `@component`) para evitar duplicación de código en el panel administrativo.
- **RNF-15** El proyecto debe contar con documentación básica de rutas y vistas del sistema.

---

## 3.2.5 Usabilidad

- **RNF-16** La interfaz, construida con Blade y Tailwind CSS, debe ser intuitiva y responsiva, adaptable a dispositivos de escritorio y móviles.
- **RNF-17** Las operaciones comunes (agendar cita, consultar historial, registrar pago) deben completarse en no más de tres pasos desde la interfaz de usuario.

---

# 4. Restricciones de Diseño

| Restricción | Detalle |
|-------------|---------|
| Framework | Laravel 13 con PHP 8.2+ |
| Arquitectura | MVC (Modelo-Vista-Controlador) |
| ORM | Eloquent (incluido en Laravel) |
| Motor de plantillas | Blade |
| Estilos / UI | Tailwind CSS |
| Gráficas y reportes | Chart.js |
| Autenticación | Laravel Breeze (stack Blade), sobre sesiones de Laravel |
| Base de datos | MariaDB |
| Pagos en línea | API REST de PayPal, consumida desde el backend |
| Servidor web | Servidor de desarrollo de Laravel (`php artisan serve`) / Nginx o Apache con PHP-FPM en producción |
| Protocolo | HTTP en desarrollo y HTTPS en producción |
| Plazo de desarrollo | 2 meses |

---

# 5. Requisitos de Base de Datos

## 5.1 Entidades Principales

| Entidad | Descripción |
|---------|-------------|
| Usuario | Almacena credenciales de acceso y datos generales de todos los usuarios del sistema. |
| Rol | Define los roles disponibles: administrador, barbero y cliente. |
| Cliente | Información de contacto y datos personales del cliente. |
| Barbero | Información personal y laboral del barbero. |
| Servicio | Catálogo de servicios con nombre, precio y duración. |
| Cita | Registro de citas con fecha, hora, estado y relaciones con cliente y barbero. |
| Horario | Disponibilidad semanal de cada barbero. |
| Pago | Registro de pagos asociados a citas completadas. |

## 5.2 Relaciones Clave

- Un Usuario administrador puede tener el rol de Barbero.
- Un Barbero está asociado a exactamente un Usuario.
- Un Barbero puede tener el rol de Administrador.
- Un Cliente está asociado a exactamente un Usuario y no puede tener otro rol.
- Una Cita pertenece a un Cliente y a un Barbero.
- Una Cita puede incluir uno o más Servicios (relación muchos a muchos).
- El costo total de una Cita se calcula a partir de la suma de los precios de sus Servicios.
- Un Barbero puede tener uno o más Horarios semanales.
- Un Pago está asociado a exactamente una Cita.

> El modelo entidad-relación (ERD) detallado se mantiene igual al definido previamente en el documento `E-R.md`, ya que la migración a arquitectura MVC no modifica el modelo de datos, solo la forma en que se expone y consume.

---

# 6. Cronograma

El proyecto tiene una duración estimada de 8 semanas distribuidas de la siguiente manera:

| Fase | Semanas | Actividades principales |
|------|---------|------------------------|
| Planeación | 1 | Cierre del SRS, configuración del entorno de desarrollo y repositorio. |
| Diseño | 1 – 2 | Modelo relacional (ERD), diseño de rutas y vistas, configuración de Laravel Breeze y Tailwind CSS. |
| Desarrollo — Autenticación y Roles | 2 – 3 | Migraciones, modelos Eloquent, autenticación con sesiones (Laravel Breeze), middlewares de roles. |
| Desarrollo — Módulos CRUD | 3 – 5 | Controladores y vistas Blade/Tailwind CSS para barberos, servicios, horarios y clientes. |
| Desarrollo — Citas y Pagos | 5 – 7 | Lógica de agendado de citas, validación de traslapes, pagos en efectivo y PayPal. |
| Pruebas | 7 | Pruebas funcionales, validación de formularios y corrección de errores. |
| Documentación y cierre | 8 | Documentación técnica, mapa de rutas/vistas y entrega final. |

---

# 7. Apéndices

## 7.1 Diagramas Planificados

- Diagrama Entidad-Relación (ERD)
- Modelo Relacional
- Diagrama de Casos de Uso
- Diagrama de Clases (Modelos Eloquent)
- Mapa de Rutas y Vistas del sistema

## 7.2 Mapa de Rutas y Vistas Principales

| Método | Ruta | Vista / Acción | Rol requerido |
|--------|------|-----------------|---------------|
| GET | /login | Formulario de inicio de sesión | Público |
| POST | /login | Procesa el inicio de sesión | Público |
| POST | /logout | Cierra la sesión | Autenticado |
| GET | /register | Formulario de registro de cliente | Público |
| POST | /register | Procesa el registro de cliente | Público |
| GET | /forgot-password | Formulario de recuperación de contraseña | Público |
| POST | /reset-password | Restablecimiento de contraseña | Público |
| GET | /dashboard | Panel principal (Blade + Tailwind CSS) | Autenticado |
| GET | /usuarios | Listado de usuarios | Administrador |
| GET | /usuarios/crear | Formulario de creación de usuario | Administrador |
| POST | /usuarios | Guardar nuevo usuario | Administrador |
| GET | /usuarios/{id}/editar | Formulario de edición de usuario | Administrador |
| PUT | /usuarios/{id} | Actualizar usuario | Administrador |
| GET | /barberos | Listado de barberos | Autenticado |
| GET | /barberos/crear | Formulario de registro de barbero | Administrador |
| POST | /barberos | Guardar nuevo barbero | Administrador |
| GET | /barberos/{id}/editar | Formulario de edición de barbero | Administrador |
| PUT | /barberos/{id} | Actualizar barbero | Administrador |
| GET | /barberos/{id}/horarios | Ver horarios de un barbero | Autenticado |
| PUT | /barberos/{id}/horarios | Actualizar horarios de un barbero | Administrador |
| GET | /servicios | Listado de servicios activos | Autenticado |
| GET | /servicios/crear | Formulario de registro de servicio | Administrador |
| POST | /servicios | Guardar nuevo servicio | Administrador |
| GET | /servicios/{id}/editar | Formulario de edición de servicio | Administrador |
| PUT | /servicios/{id} | Actualizar servicio | Administrador |
| DELETE | /servicios/{id} | Eliminar lógicamente un servicio | Administrador |
| GET | /citas | Listado de citas (filtrado por rol) | Autenticado |
| GET | /citas/crear | Formulario para agendar cita | Cliente |
| POST | /citas | Guardar nueva cita | Cliente |
| PUT | /citas/{id}/cancelar | Cancelar una cita | Cliente / Administrador |
| GET | /pagos | Listado de pagos | Administrador |
| GET | /pagos/crear | Formulario de registro de pago | Administrador |
| POST | /pagos | Registrar un pago (efectivo o PayPal) | Administrador |
| GET | /reportes/ingresos | Reporte de ingresos por período | Administrador |
