# Bayer Corporativo

![Repo Size](https://img.shields.io/github/repo-size/Bjimenez20/bayer_corp)
![Last Commit](https://img.shields.io/github/last-commit/Bjimenez20/bayer_corp)
![Commit Activity](https://img.shields.io/github/commit-activity/m/Bjimenez20/bayer_corp)
![Issues](https://img.shields.io/github/issues/Bjimenez20/bayer_corp)
![License](https://img.shields.io/badge/license-MIT-green)

![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4?logo=php&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?logo=javascript&logoColor=black)
![CSS](https://img.shields.io/badge/CSS-3-1572B6?logo=css3&logoColor=white)
![HTML](https://img.shields.io/badge/HTML-5-E34F26?logo=html5&logoColor=white)

---

## 🧾 Descripción General

**Bayer Corporativo** es un sistema web desarrollado con **PHP, JavaScript, HTML y CSS**, orientado a la gestión de procesos internos corporativos.  
El proyecto está diseñado bajo una arquitectura por capas que facilita la mantenibilidad, escalabilidad y comprensión del código.

Este repositorio sirve como base funcional y documental para el desarrollo, análisis y despliegue del sistema en entornos  y corporativos.

---

## 🚀 Funcionalidades Principales

- 🔐 Autenticación de usuarios.
- 🗂️ Separación por capas (presentación, lógica y datos).
- 📄 Gestión de vistas principales del sistema.
- 🧱 Estructura modular para facilitar mantenimiento.
- 🔄 Control de sesión de usuarios.

---

## 🧱 Tecnologías Utilizadas

| Tecnología | Uso |
|----------|-----|
| PHP | Backend y lógica del negocio |
| JavaScript | Interacción del lado del cliente |
| HTML5 | Estructura de las vistas |
| CSS3 | Diseño y estilos |
| Git / GitHub | Control de versiones |

---

## 🗂️ Estructura del Proyecto


bayer_corp/
├── datos/ # Acceso y gestión de datos
├── logica/ # Reglas de negocio y controladores
├── presentacion/ # Interfaces de usuario
├── index.php # Página principal
├── inicio.php # Página inicial autenticada
├── inicio_sin_server.php # Página de acceso sin servidor
├── README.md # Documentación del proyecto


---



## ⚙️ Instalación

1. **Clonar el repositorio**

   ```bash

   git clone https://github.com/Bjimenez20/bayer_corp.git

  

2. **Acceder al Proyecto**
    cd bayer_corp


   
3. **Configurar y ejecutar el proyecto**

http://localhost/bayer_corp/


Copiar el proyecto en htdocs  o directorio equivalente.

Iniciar el servidor Apache.



##  :wrench:Configuracion

<php
define('DB_HOST', 'localhost');
define('DB_NAME', 'bayer_db');
define('DB_USER', 'root');
define('DB_PASS', 'password');
?>

---

## :satellite:Endpoints del Sistema

:lock_with_ink_pen:**Inicio de seccion**

- Metodo: POST
- Archivo /logica/login.php
- Descripción:Valida la credenciales del usuario e inicia la sesión


**Parametros**

| Nombre   | Tipo   | Descripción       |
| -------- | ------ | ----------------- |
| usuario  | string | Nombre de usuario |
| password | string | Contraseña        |



---

 ## 🚪Cierre de seccion

- **Método**: GET
- **Archivo**:/logica/logout.php
- **Descripción**: Finaliza la sesión activa del usuario.
---

 ## 🗄️ Base de Datos 

 El sistema utiliza una base de datis relacional para almacenar información.

| Campo      | Tipo    | Descripción         |
| ---------- | ------- | ------------------- |
| id         | int     | Identificador único |
| usuario    | varchar | Usuario             |
| contraseña | varchar | Contraseña cifrada  |
| rol        | varchar | Rol del usuario     |


## Flujo de Usuario

🔄 **Flujo de Usuario**  

1. El usuario accede a index.php.

2. Ingresa sus credenciales.

3. El sistema valida la información.

4. Se inicia la sesión.

5. El usuario accede a inicio.php.

6. Puede cerrar sesión cuando lo desee.

---
## 🏗️ Arquitectura del Sistema

- El proyecto implementa una arquitectura por capas:

- Presentación: Interfaces visuales.

- Lógica: Procesamiento y reglas del negocio.

- Datos: Acceso y persistencia de información.

Esta arquitectura mejora la organización y el mantenimiento del sistema.

---


## 🧑‍💻 Equipo Responsable

Proyecto: Bayer Corporativo

Repositorio: https://github.com/Bjimenez20/bayer_corp

Para dudas o mejoras, utilizar la sección de Issues del repositorio.

---

## 🪪 Licencia

Este proyecto se distribuye bajo la licencia MIT, lo que permite su uso, modificación y distribución con fines educativos y profesionales.

📌 **Mantenimiento y Actualizaciones**

El README debe actualizarse cuando:

Se agreguen nuevas funcionalidades.

Cambien los pasos de instalación.

Se modifique la arquitectura.

Se añadan nuevas dependencias.

## ✅ Conclusión

Un README bien estructurado garantiza una correcta comprensión del proyecto, facilita la colaboración y mejora la calidad del desarrollo en entornos corporativos y académicos.

Este documento debe mantenerse alineado con el estado actual del sistema.







