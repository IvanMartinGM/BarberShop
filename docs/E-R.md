==================================
Modelo Entidad - Relacion
SIstema de gestion para barberia
==================================

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
un barbero puede tener varios turnos

RELACIÓN:
UN BARBERO PUEDE TENER MUCHOS HORARIOS.


━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
ENTIDAD: Horario
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

id
especialidad
estado_disponibilidad
biografia
fecha_contratacion
calificacion_promedio
experiencia_años



Cardinalidad: 
