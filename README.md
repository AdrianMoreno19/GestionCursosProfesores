# 📚 Sistema de Gestión de Cursos

![Build Status](https://img.shields.io/badge/status-active-brightgreen) ![License](https://img.shields.io/badge/license-MIT-blue)

Este es un sistema desarrollado en PHP para la administración de cursos, usuarios y solicitudes de inscripción, todo a través de una interfaz web intuitiva.

---

## ✨ Funcionalidades

- 🖥️ **Administración de cursos:** Permite agregar, eliminar y desactivar cursos según el estado de inscripción.
- 🧑‍🎓 **Gestión de inscripciones:** Los usuarios pueden solicitar inscripción en los cursos disponibles.
- 📧 **Notificaciones por correo:** Se envían confirmaciones automáticas cuando un usuario es aceptado en un curso.
- 🗓️ **Control de fechas:** Posibilidad de desactivar cursos cuando finaliza el período de inscripción.
- 🔒 **Gestión de usuarios:** Los administradores tienen control total sobre inscripciones y cursos.

## 📷 Captura de Pantalla

🚧 *Próximamente...*

---

## 🔧 Requisitos del Sistema

Este sistema requiere un servidor web con PHP y acceso a una base de datos MySQL. Puedes utilizar **XAMPP**, **MAMP** o cualquier entorno PHP compatible.

- **PHP 7.0 o superior**
- **MySQL**
- **Servidor web (Apache, Nginx, etc.)**

---

## ℹ️ Instalación y Configuración

Sigue estos pasos para instalar y utilizar el sistema:

### 1️⃣ Clonar el repositorio:
```bash
git clone https://github.com/AdrianMorenoGomez/GestionDeCursos.git
```

### 2️⃣ Configurar la base de datos:
- Importa el archivo SQL en tu servidor MySQL.
- Edita el archivo **config.php** con las credenciales correctas de la base de datos.

### 3️⃣ Acceder al sistema en el servidor web:
- Copia los archivos del sistema en la carpeta raíz de tu servidor web (por ejemplo, `htdocs` en XAMPP).
- Abre el navegador y accede a:
  ```
  http://localhost/GestionDeCursos
  ```

### 4️⃣ Acceder como administrador:
- Utiliza las credenciales predefinidas para administrar cursos y usuarios.

---

## ⚙️ Personalización

Puedes adaptar el sistema a tus necesidades:

- **Base de datos:** Modifica la estructura según los requerimientos de tu organización.
- **Diseño:** Edita los archivos CSS para cambiar el estilo y colores.
- **Funcionalidad:** Ajusta los archivos PHP para modificar lógica de inscripción, cursos o correos electrónicos.

---

## 🚀 Contribuciones

Si quieres mejorar este sistema:

1. Realiza un **fork** del repositorio.
2. Crea una nueva rama:
   ```bash
   git checkout -b nombre-de-tu-rama
   ```
3. Aplica tus modificaciones y realiza un **commit**:
   ```bash
   git commit -m "Descripción de cambios"
   ```
4. Envía un **pull request**.

---

## ✉️ Licencia

Este proyecto está bajo la **Licencia MIT**. Consulta el archivo [LICENSE](LICENSE) para más detalles.

---

## ⭐️ Apoya el Proyecto

Si este sistema te ha sido útil, considera darle una estrella ⭐️ en GitHub.

Las estrellas ayudan a más personas a descubrir el proyecto y me motivan a seguir mejorándolo.

### ¿Cómo ayudar?
✅ Da una estrella ⭐️ al repositorio.
✅ Haz un **fork** y personaliza el código.
✅ Envíanos un **pull request** con mejoras.

¡Gracias por tu apoyo! 🙌
