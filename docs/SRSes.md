# Especificación de Requisitos de Software (SRS)

# Sistema de Gestión para Barbería

---

# 1. Introducción

## 1.1 Propósito

El propósito de este documento es definir de manera formal los requisitos funcionales y no funcionales del Sistema de Gestión para Barbería.

Este documento describe las características, restricciones, interfaces, objetivos y comportamiento esperado del sistema.

Además, sirve como referencia principal para desarrolladores, diseñadores, testers y futuros mantenedores del proyecto.

---

## 1.2 Alcance

El Sistema de Gestión para Barbería es una aplicación web diseñada para administrar las operaciones principales de una barbería.

El sistema permitirá:

* Gestión de usuarios y roles
* Administración de barberos
* Gestión de clientes
* Administración de servicios
* Programación de citas
* Gestión de horarios
* Registro de pagos
* Control de acceso basado en roles

El sistema busca mejorar la organización de citas, optimizar el flujo de trabajo de la barbería y centralizar la información administrativa.

---

## 1.3 Definiciones, Acrónimos y Abreviaciones

| Término | Definición                                  |
| ------- | ------------------------------------------- |
| MVC     | Modelo-Vista-Controlador                    |
| SRS     | Software Requirements Specification         |
| RF      | Requisito Funcional                         |
| RNF     | Requisito No Funcional                      |
| OOP     | Programación Orientada a Objetos            |
| CRUD    | Crear, Leer, Actualizar y Eliminar          |
| Cliente | Usuario que agenda servicios en la barbería |
| Barbero | Empleado encargado de realizar servicios    |

---

## 1.4 Referencias

* IEEE 830-1998 Software Requirements Specification Standard
* Documentación oficial de PHP
* Documentación oficial de MariaDB
* Documentación oficial de Nginx

---

## 1.5 Visión General del Documento

Este documento está organizado de la siguiente manera:

* La sección 1 presenta la introducción general del proyecto.
* La sección 2 describe la perspectiva general del sistema.
* La sección 3 define los requisitos específicos del sistema.
* La sección 4 presenta restricciones de diseño.
* La sección 5 describe los requisitos de la base de datos.
* La sección 6 contiene cronograma preliminar y presupuesto.
* La sección 7 incluye apéndices y diagramas.

---

# 2. Descripción General

## 2.1 Perspectiva del Producto

El Sistema de Gestión para Barbería será una aplicación web cliente-servidor.

La aplicación utilizará una arquitectura MVC (Modelo-Vista-Controlador) y será desarrollada utilizando PHP Vanilla con programación orientada a objetos.

La comunicación entre el cliente y el servidor se realizará mediante HTTP/HTTPS.

El sistema será accesible desde navegadores web modernos.

---

## 2.2 Funciones del Producto

Las principales funciones del sistema incluyen:

* Inicio y cierre de sesión
* Gestión de usuarios y roles
* Gestión de clientes
* Gestión de barberos
* Gestión de servicios
* Programación de citas
* Gestión de horarios
* Registro de pagos
* Visualización de historial de citas
* Generación de reportes básicos

---

## 2.3 Características de los Usuarios

### Administrador

* Gestiona usuarios y roles
* Administra servicios y horarios
* Supervisa operaciones del sistema

### Barbero

* Visualiza citas asignadas
* Consulta horarios
* Gestiona servicios realizados

### Cliente

* Agenda citas
* Consulta historial de citas
* Visualiza servicios disponibles

---

## 2.4 Restricciones Generales

* El backend deberá desarrollarse utilizando PHP Vanilla.
* El sistema deberá utilizar programación orientada a objetos.
* El sistema deberá implementar arquitectura MVC.
* La base de datos utilizada será MariaDB.
* El frontend utilizará HTML5, CSS3 y JavaScript.

---

## 2.5 Suposiciones y Dependencias

* Los usuarios contarán con acceso a internet.
* Los usuarios utilizarán navegadores modernos.
* El sistema depende de un servidor web compatible con PHP.
* JavaScript deberá estar habilitado para ciertas funcionalidades del frontend.

---

# 3. Requisitos Específicos

# 3.1 Requisitos Funcionales

## 3.1.1 Autenticación

* RF-1 El sistema deberá proporcionar una interfaz de inicio de sesión utilizando correo electrónico y contraseña.
* RF-2 El sistema deberá validar las credenciales del usuario antes de permitir acceso.
* RF-3 El sistema deberá restringir el acceso únicamente a usuarios autenticados.
* RF-4 El sistema deberá implementar control de acceso basado en roles.
* RF-5 El sistema deberá permitir cerrar sesión de manera segura.
* RF-6 El sistema deberá proporcionar recuperación de contraseña.

---

## 3.1.2 Gestión de Usuarios y Roles

* RF-7 El sistema deberá permitir a los administradores registrar usuarios.
* RF-8 El sistema deberá permitir actualizar información de usuarios.
* RF-9 El sistema deberá permitir asignar roles a usuarios.
* RF-10 El sistema deberá limitar funcionalidades dependiendo del rol del usuario.

---

## 3.1.3 Gestión de Barberos

* RF-11 El sistema deberá permitir registrar barberos.
* RF-12 El sistema deberá permitir actualizar información de barberos.
* RF-13 El sistema deberá mostrar los barberos disponibles.
* RF-14 El sistema deberá administrar los horarios de los barberos.

---

## 3.1.4 Gestión de Servicios

* RF-15 El sistema deberá permitir registrar servicios.
* RF-16 El sistema deberá permitir actualizar información de servicios.
* RF-17 El sistema deberá permitir eliminar servicios.
* RF-18 El sistema deberá mostrar los servicios disponibles.
* RF-19 El sistema deberá almacenar precio y duración de cada servicio.

---

## 3.1.5 Gestión de Citas

* RF-20 El sistema deberá permitir a los clientes programar citas.
* RF-21 El sistema deberá permitir cancelar citas.
* RF-22 El sistema deberá prevenir citas superpuestas.
* RF-23 El sistema deberá almacenar historial de citas.
* RF-24 El sistema deberá asociar citas con clientes y barberos.

---

## 3.1.6 Gestión de Pagos

* RF-25 El sistema deberá registrar pagos asociados a servicios.
* RF-26 El sistema deberá almacenar registros de pagos.
* RF-27 El sistema deberá calcular el costo total de servicios.
* RF-28 El sistema deberá generar reportes básicos de pagos.

---

# 3.2 Requisitos No Funcionales

## 3.2.1 Rendimiento

* RNF-1 El sistema deberá soportar al menos 50 usuarios concurrentes.
* RNF-2 El sistema deberá responder en menos de 2 segundos bajo condiciones normales.

---

## 3.2.2 Seguridad

* RNF-3 Las contraseñas deberán almacenarse utilizando algoritmos hash seguros.
* RNF-4 El sistema deberá validar entradas de usuario en el servidor.
* RNF-5 El sistema deberá utilizar HTTPS en producción.

---

## 3.2.3 Confiabilidad

* RNF-6 El sistema deberá mantener consistencia de datos.
* RNF-7 Las transacciones deberán revertirse en caso de error.

---

## 3.2.4 Mantenibilidad

* RNF-8 El sistema deberá implementar arquitectura MVC.
* RNF-9 El sistema deberá desarrollarse utilizando OOP.
* RNF-10 El código deberá mantenerse organizado y documentado.

---

## 3.2.5 Usabilidad

* RNF-11 El sistema deberá proporcionar una interfaz intuitiva.
* RNF-12 Las operaciones comunes deberán completarse en no más de tres pasos.

---

# 4. Restricciones de Diseño

* El sistema deberá utilizar PHP Vanilla.
* El sistema deberá seguir arquitectura MVC.
* La base de datos utilizada será MariaDB.
* El frontend utilizará HTML5, CSS3 y JavaScript.
* El servidor web será Nginx.

---

# 5. Requisitos de Base de Datos

## 5.1 Entidades Principales

* Usuario
* Rol
* Cliente
* Barbero
* Servicio
* Cita
* Horario
* Pago

---

# 6. Cronograma Preliminar y Presupuesto

## 6.1 Cronograma

| Fase          | Descripción                         |
| ------------- | ----------------------------------- |
| Planeación    | Definición de requisitos y análisis |
| Diseño        | UML, ERD y arquitectura             |
| Desarrollo    | Implementación del sistema          |
| Pruebas       | Validación y corrección de errores  |
| Documentación | Elaboración de documentación final  |

---

# 7. Apéndices

## 7.1 Diagramas

* Diagrama de Casos de Uso
* Diagrama Entidad-Relación (ERD)
* Diagrama de Clases
* Diagrama de Secuencia
* Diagrama de Actividades

