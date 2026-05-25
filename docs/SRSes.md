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

Este documento sirve como referencia principal para desarrolladores, diseñadores, testers y futuros mantenedores del proyecto, y establece un acuerdo claro sobre lo que el sistema debe hacer antes de iniciar su desarrollo.

---

## 1.2 Alcance

El Sistema de Gestión para Barbería es una aplicación web compuesta por una API REST en el backend desarrollada con Laravel 13, y una Single Page Application (SPA) en el frontend construida con React, Vite y TypeScript, ambas independientes. El sistema busca optimizar el proceso de agendado de citas y el flujo de trabajo general de la barbería, centralizando su información administrativa.

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
| API REST | Interfaz de programación de aplicaciones basada en el estilo arquitectónico REST |
| SRS | Software Requirements Specification — Especificación de Requisitos de Software |
| RF | Requisito Funcional |
| RNF | Requisito No Funcional |
| CRUD | Crear, Leer, Actualizar y Eliminar |
| JWT | JSON Web Token — estándar para autenticación mediante tokens |
| SPA | Single Page Application — aplicación web de una sola página |
| RBAC | Role-Based Access Control — control de acceso basado en roles |
| ORM | Object-Relational Mapping — mapeo objeto-relacional |
| Eloquent | ORM incluido en Laravel para interactuar con la base de datos |
| TypeScript | Superconjunto tipado de JavaScript que compila a JavaScript |
| Vite | Herramienta de construcción y servidor de desarrollo para el frontend |
| React | Biblioteca de JavaScript para construcción de interfaces de usuario |
| Cliente | Usuario que agenda servicios en la barbería |
| Barbero | Empleado encargado de realizar los servicios |
| Administrador | USuario con los accesos mas altos del sistema |
| Endpoint | URL de la API que expone una funcionalidad específica |
| jwt-auth | Paquete de Laravel para autenticación mediante JWT (php-open-source-saver/jwt-auth) |
| Soft delete | Eliminación lógica de un registro sin borrarlo físicamente de la base de datos |

---

## 1.4 Referencias

- IEEE 830-1998 — Software Requirements Specification Standard
- Documentación oficial de Laravel 13: https://laravel.com/docs
- Documentación oficial de Eloquent ORM: https://laravel.com/docs/eloquent
- Documentación oficial de jwt-auth: https://github.com/PHP-Open-Source-Saver/jwt-auth
- Documentación oficial de MariaDB: https://mariadb.com/kb/en/
- Documentación oficial de React: https://react.dev
- Documentación oficial de Vite: https://vitejs.dev
- Documentación oficial de TypeScript: https://www.typescriptlang.org/docs
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
- La sección 7 incluye apéndices y diagramas y glosario de endpoints.

---

# 2. Descripción General

## 2.1 Perspectiva del Producto

El Sistema de Gestión para Barbería es una aplicación web con arquitectura de dos capas independientes:

- **Backend:** API REST desarrollada con Laravel 13 utilizando Eloquent ORM para la interacción con la base de datos MariaDB. Expone recursos a través de endpoints JSON y gestiona toda la lógica de negocio y persistencia de datos.
- **Frontend:** Single Page Application desarrollada con React, Vite y TypeScript. Consume la API REST del backend a través de HTTP en desarrollo y HTTPS en produccion,  se encarga únicamente de la presentación e interacción con el usuario.

La comunicación entre ambas capas se realiza exclusivamente mediante HTTP en desarrollo y en produccion se recomienda HTTPS intercambiando datos en formato JSON. El sistema será accesible desde navegadores web modernos y requerirá autenticación mediante tokens a través de JWT (JSON Web Token) para acceder a todas las rutas protegidas.

---

## 2.2 Funciones del Producto

Las principales funciones del sistema son:

- Inicio y cierre de sesión con autenticación basada en tokens (JWT (JSON Web Token))
- Gestión de usuarios y roles (RBAC)
- Gestión de clientes
- Gestión de barberos y sus horarios
- Administración del catálogo de servicios con precio y duración
- Programación de citas sin traslapes
- Registro de pagos en efectivo o mediante PayPal
- Visualización del historial de citas por cliente
- Generación de reportes básicos de ingresos

---

## 2.3 Características de los Usuarios

### Administrador

- Acceso total a todas las funcionalidades del sistema.
- Gestiona usuarios y asigna roles.
- Administra el catálogo de servicios.
- Administra los horarios de los barberos.
- Supervisa citas, pagos y genera reportes de ingresos.

### Barbero
- Visualiza sus citas asignadas.
- Consulta su horario de trabajo.
- Consulta los servicios que ha realizado.

### Cliente

- Se registra en el sistema.
- Agenda y cancela citas seleccionando barbero, servicio, fecha y hora.
- Consulta el historial de sus citas.
- Visualiza el catálogo de servicios disponibles y los barberos disponibles.
- Realiza pagos en efectivo o mediante PayPal.


## 2.4 Restricciones Generales

- El backend debe desarrollarse exclusivamente con Laravel 13 y PHP 8.2+.
- La interacción con la base de datos debe realizarse a través de Eloquent ORM.
- El sistema debe implementar autenticación stateless mediante JWT (JSON Web Token).
- La base de datos utilizada será MariaDB.
- El frontend debe desarrollarse con React, Vite y TypeScript.
- Toda comunicación entre frontend y backend debe realizarse mediante HTTPS en el entorno de producción o HTTP en desarrollo.
- La integración de pagos en línea se realizará exclusivamente mediante la API REST de PayPal.
- El proyecto debe completarse en un plazo máximo de 2 meses.

---

## 2.5 Suposiciones y Dependencias

- Los usuarios contarán con acceso a internet.
- Se JWT Auth para la gestión de tokens.
- Los usuarios contarán con acceso a internet durante el uso del sistema.
- Los usuarios utilizarán navegadores modernos con soporte para ES6+ (Chrome, Firefox, Edge, Safari en sus versiones actuales).
- JavaScript debe estar habilitado en el navegador del usuario.
- El entorno de servidor debe ser compatible con PHP 8.2+ para ejecutar Laravel 13.
- El sistema depende de la disponibilidad de la API REST de PayPal para procesar pagos en línea.
- Se asume que la barbería opera con horarios fijos semanales configurados por el administrador.

---

# 3. Requisitos Específicos

# 3.1 Requisitos Funcionales

## 3.1.1 Autenticación

- **RF-01** El sistema debe proporcionar un endpoint de inicio de sesión mediante correo electrónico y contraseña.
- **RF-02** El sistema debe validar las credenciales del usuario antes de permitir el acceso y retornar un token de autenticación mediante JWT (JSON Web Token).
- **RF-03** El sistema debe restringir el acceso a todas las rutas protegidas únicamente a usuarios autenticados con token válido.
- **RF-04** El sistema debe implementar control de acceso basado en roles (RBAC) diferenciando entre administrador, barbero y cliente.
- **RF-05** El sistema debe proporcionar un endpoint de cierre de sesión que invalide el token activo del usuario.
- **RF-06** El sistema debe permitir la recuperación de contraseña mediante un enlace enviado al correo electrónico registrado.

---

## 3.1.2 Gestión de Usuarios y Roles

- **RF-07** El sistema debe permitir al administrador registrar nuevos usuarios con rol de administrador o barbero.
- **RF-08** El sistema debe permitir a cualquier persona registrarse en la plataforma como cliente mediante un formulario público de registro.
- **RF-09** El sistema debe permitir al administrador actualizar la información de cualquier usuario.
- **RF-10** El sistema debe permitir al administrador asignar uno o más roles a un usuario, con la restricción de que el rol de cliente es exclusivo y no puede combinarse con ningún otro rol.
- **RF-11** El sistema debe limitar las funcionalidades disponibles según los roles del usuario autenticado. Si un usuario posee múltiples roles, el sistema debe otorgarle las funcionalidades combinadas de todos sus roles activos.

---

## 3.1.3 Gestión de Barberos

- **RF-12** El sistema debe permitir registrar barberos con su información personal y de contacto.
- **RF-13** El sistema debe permitir actualizar la información de un barbero existente.
- **RF-14** El sistema debe exponer un endpoint para listar los barberos disponibles.
- **RF-15** El sistema debe permitir al administrador configurar los horarios de trabajo de cada barbero.
- **RF-16** El sistema debe permitir al barbero seleccionar del catálogo general los servicios que él ofrece y realiza."

---

## 3.1.4 Gestión de Servicios

- **RF-17** El sistema debe permitir al administrador registrar servicios en el catálogo.
- **RF-18** El sistema debe permitir al administrador actualizar la información de un servicio existente.
- **RF-19** El sistema debe permitir al administrador eliminar servicios del catálogo de forma lógica (soft delete), sin borrarlos físicamente de la base de datos.
- **RF-29** El sistema debe exponer un endpoint para listar los servicios activos disponibles.
- **RF-21** El sistema debe almacenar el precio y la duración estimada en minutos de cada servicio.

---

## 3.1.5 Gestión de Citas

- **RF-22** El sistema debe permitir a los clientes programar citas seleccionando un barbero, uno o más servicios, fecha y hora disponible.
- **RF-23** El sistema debe permitir cancelar una cita con al menos 24 horas de anticipación a la fecha y hora programada.
- **RF-24** El sistema debe validar y prevenir la creación de citas superpuestas para el mismo barbero en el mismo horario.
- **RF-25** El sistema debe almacenar el historial de todas las citas y permitir su consulta filtrada por cliente, barbero o fecha.
- **RF-26** Cada cita debe estar asociada a un cliente, un barbero y uno o más servicios del catálogo.

---

## 3.1.6 Gestión de Pagos

- **RF-27** El sistema debe registrar los pagos asociados a una cita, indicando el método utilizado: efectivo o PayPal.
- **RF-28** El sistema debe almacenar el historial completo de todos los pagos realizados.
- **RF-29** El sistema debe calcular automáticamente el costo total de una cita en función de los servicios seleccionados.
- **RF-30** El sistema debe integrarse con la API REST de PayPal para procesar pagos en línea.
- **RF-31** El sistema debe generar reportes básicos de ingresos filtrables por período de tiempo.

---

# 3.2 Requisitos No Funcionales

## 3.2.1 Rendimiento

- **RNF-01** El sistema debe soportar al menos 50 usuarios concurrentes sin degradación notable del servicio.
- **RNF-02** Los endpoints de la API deben responder en menos de 2 segundos bajo condiciones normales de carga.
---

## 3.2.2 Seguridad

- **RNF-03** Las contraseñas deben almacenarse utilizando el algoritmos de hash seguros
- **RNF-04** El sistema debe validar y sanear todas las entradas del usuario en el servidor utilizando los Form Requests de Laravel, para prevenir inyección SQL y XSS.
- **RNF-05** El sistema debe utilizar HTTPS en el entorno de producción.
- **RNF-06** Los tokens de autenticación deben invalidarse correctamente al cerrar sesión.
- **RNF-07** La API debe implementar rate limiting para proteger los endpoints contra ataques de fuerza bruta.
- **RNF-08** La integración con PayPal debe realizarse del lado del servidor, nunca exponiendo credenciales en el frontend.

---

## 3.2.3 Confiabilidad

- **RNF-09** El sistema debe mantener la consistencia de los datos mediante el uso de transacciones de base de datos en operaciones críticas.
- **RNF-10** Las operaciones críticas como el registro de pagos y la creación de citas deben revertirse completamente (rollback) en caso de error.

---

## 3.2.4 Mantenibilidad

- **RNF-11** El backend debe seguir los principios de diseño de API REST: stateless, recursos identificables mediante URLs y uso correcto de verbos HTTP (GET, POST, PUT, DELETE).
- **RNF-12** La interacción con la base de datos debe realizarse exclusivamente a través de Eloquent ORM, evitando consultas SQL en crudo salvo casos justificados.
- **RNF-13** El código del backend debe organizarse siguiendo la estructura de carpetas estándar de Laravel.
- **RNF-14** El código del frontend debe utilizar TypeScript en todos los componentes y servicios, definiendo interfaces o tipos para todos los modelos de datos consumidos desde la API.
- **RNF-15** La API debe contar con documentación de endpoints actualizada en una colección de Postman.

---

## 3.2.5 Usabilidad

- **RNF-16** El frontend debe proporcionar una interfaz intuitiva y responsiva, adaptable a dispositivos de escritorio y móviles.
- **RNF-17** Las operaciones comunes (agendar cita, consultar historial, registrar pago) deben completarse en no más de tres pasos desde la interfaz de usuario.

---

# 4. Restricciones de Diseño

| Restricción | Detalle |
|-------------|---------|
| Backend | Laravel 13 con PHP 8.2+ |
| ORM | Eloquent (incluido en Laravel) |
| Estilo arquitectónico | API REST stateless |
| Autenticación | JWT (JSON Web Token) |
| Base de datos | MariaDB |
| Frontend | React 18+ con Vite y TypeScript |
| Lenguaje frontend | TypeScript obligatorio; no se permite JS puro |
| Pagos en línea | API REST de PayPal |
| Servidor web | Nginx o Apache con PHP-FPM |
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

- Un Usuario  administrador puedo tener el rol de Barbero.
- Un Barbero está asociado a exactamente un Usuario.
- Un Barbero puede tener el rol de Administrador.
- Un Cliente está asociado a exactamente un Usuario y no puede tener otro rol. 
- Una Cita pertenece a un Cliente y a un Barbero.
- Una Cita puede incluir uno o más Servicios (relación muchos a muchos).
- El costo total de una Cita se calcula a partir de la suma de los precios de sus Servicios.
- Un Barbero puede tener uno o más Horarios semanales.
- Un Pago está asociado a exactamente una Cita.


# 6. Cronograma

El proyecto tiene una duración estimada de 8 semanas distribuidas de la siguiente manera:

| Fase | Semanas | Actividades principales |
|------|---------|------------------------|
| Planeación | 1 | Cierre del SRS, configuración de entornos de desarrollo y repositorio. |
| Diseño | 1 – 2 | Modelo relacional (ERD), diseño de endpoints y wireframes del frontend. |
| Desarrollo — Backend | 2 – 5 | Migraciones, modelos Eloquent, autenticación con JWT, CRUD de entidades, lógica de citas y pagos con PayPal. |
| Desarrollo — Frontend | 3 – 6 | Componentes React con TypeScript, consumo de la API, vistas y flujos de usuario. |
| Pruebas | 7 | Pruebas funcionales, validación de endpoints y corrección de errores. |
| Documentación y cierre | 8 | Documentación técnica, colección Postman actualizada y entrega final. |

# 7. Apéndices

## 7.1 Diagramas Planificados

- Diagrama Entidad-Relación (ERD)
- Modelo Relacional  
- Diagrama de Casos de Uso
- Diagrama de Clases.
- Diseño de Endpoints (colección Postman)

## 7.2 Glosario de Endpoints Principales

| Método | Endpoint | Descripción | Rol requerido |
|--------|----------|-------------|---------------|
| POST | /api/auth/register| Registro de nuevo usuario| Publico |
| POST | /api/auth/login | Inicio de sesión, retorna token JWT | Público |
| POST | /api/auth/logout | Cierre de sesión, invalida el token | Autenticado |
| POST | /api/auth/forgot-password | Solicitud de recuperación de contraseña | Público |
| POST | /api/auth/reset-password | Restablecimiento de contraseña | Público |
| GET | /api/users | Listar todos los usuarios | Administrador |
| POST | /api/users | Crear un nuevo usuario | Administrador |
| PUT | /api/users/{id} | Actualizar un usuario | Administrador |
| GET | /api/barbers | Listar barberos disponibles | Autenticado |
| POST | /api/barbers | Registrar un barbero | Administrador |
| PUT | /api/barbers/{id} | Actualizar información de un barbero | Administrador |
| GET | /api/barbers/{id}/schedules | Consultar horarios de un barbero | Autenticado |
| PUT | /api/barbers/{id}/schedules | Actualizar horarios de un barbero | Administrador |
| GET | /api/services | Listar servicios activos del catálogo | Autenticado |
| POST | /api/services | Registrar un servicio | Administrador |
| PUT | /api/services/{id} | Actualizar un servicio | Administrador |
| DELETE | /api/services/{id} | Eliminar lógicamente un servicio | Administrador |
| GET | /api/appointments | Listar citas (filtradas por rol) | Autenticado |
| POST | /api/appointments | Crear una nueva cita | Cliente |
| PUT | /api/appointments/{id}/cancel | Cancelar una cita | Cliente / Administrador |
| GET | /api/payments | Listar pagos | Administrador |
| POST | /api/payments | Registrar un pago (efectivo o PayPal) | Administrador |
| GET | /api/reports/income | Reporte de ingresos por período | Administrador |

