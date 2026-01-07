# CRUD Relacional con PHP, MySQLi y Bootstrap

Este proyecto implementa un CRUD (Create, Read, Update, Delete) en PHP utilizando MySQLi y Bootstrap.  
Incluye gestión de productos con categorías y subida de imágenes.

---

## ⚙️ Requisitos
- PHP >= 7.4
- MySQL/MariaDB
- Servidor local (XAMPP, Laragon, etc.)
- Composer (opcional)

---

## 🗄️ Base de datos
La base de datos se llama **`crudrelacional`**.  
Importa el archivo `crudrelacional.sql` incluido en el repositorio:

```bash
mysql -u root -p < crudrelacional.sql
```
👤 Usuario de aplicación

Para mayor seguridad, se recomienda crear un usuario dedicado con privilegios mínimos:
sql
DROP USER IF EXISTS 'appuser'@'localhost';
CREATE USER 'appuser'@'localhost' IDENTIFIED BY 'appUser2026';
GRANT SELECT, INSERT, UPDATE, DELETE ON crudrelacional.* TO 'appuser'@'localhost';
FLUSH PRIVILEGES;
📂 Directorio de imágenes

El proyecto utiliza el directorio uploads/ para almacenar las fotos de los productos.

En el repositorio se incluyen imágenes de prueba para validar el CRUD.
🚀 Instalación

1.    Clona el repositorio:
    bash
git clone https://github.com/jtintin/crudRelacional.git

2. Copia el proyecto en tu servidor local (ejemplo: htdocs/crudrelacional).

3. Configura tu archivo de conexión modelo/conexion.php con el usuario appuser y la clave appUser2026.

4. Accede desde el navegador:

http://localhost/crudrelacional

✨ Funcionalidades

    Registro de productos con foto y categoría.

    Listado de productos con tabla y modal de edición.

    CRUD completo (insertar, leer, actualizar, eliminar).

    Gestión de categorías desde pestañas (tabs).

    Bootstrap 5 para interfaz moderna y responsiva.

📌 Autor

Proyecto desarrollado por Juan Antonio Tintín Cuasapáz  
Especialista en informática y soporte técnico N2/N3, perfeccionando habilidades avanzadas en Laravel, PHP y SQL.
📌 Autor y Créditos

Este proyecto fue desarrollado por Juan Antonio Tintín Cuasapáz, especialista en informática y soporte técnico N2/N3, con experiencia en PHP, MySQL y Laravel.

📺 Referencia inicial:
Como hacer un CRUD EN PHP Y MYSQL | BOOTSTRAP - MVC #01 - Interfaz – 05/01/2026

🔧 Mejoras implementadas:

    Integración del campo foto en el CRUD de productos.

    Manejo seguro de usuarios en MySQL con el principio de mínimo privilegio.

    Documentación y estructura más clara para portabilidad.

    Uso de pestañas (tabs) para gestión de productos y categorías.

