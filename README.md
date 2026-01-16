# Sistema de Gestión de Proyectos y Tareas  
### Laravel 12 & PostgreSQL

Este proyecto es una solución técnica completa para la gestión de proyectos y tareas, desarrollada como parte de una evaluación técnica. Incluye autenticación de usuarios, manejo de roles, relaciones de base de datos y una API REST.

---

##  Requisitos Previos

- PHP 8.2 o superior  
- Composer  
- NPM  
- PostgreSQL 15 o superior  
- Servidor local (XAMPP, Laragon o servidor integrado de Laravel)

---

## Instalación y Configuración

### 1. Clonar el repositorio
```bash
git clone https://github.com/GabyVanegas/gestion_proyectos.git
cd gestion-proyectos-prueba
```
### 2. Instalar dependencias de PHP
```bash
composer install
```

### 3. Instalar y compilar dependencias de frontend
```bash
npm install
npm run build
```

### 4. Configurar archivo de entorno

Copia el archivo de ejemplo y renómbralo a `.env`:

```bash
cp .env.example .env

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=db_gestion_proyectos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña

```

### 5. Generar clave de la aplicación
```bash
php artisan key:generate
```

### 6. Ejecutar migraciones y seeders
Este comando creará todas las tablas y los roles necesarios (Admin y Usuario).
```bash
php artisan migrate:fresh --seed
```

### 7. Levantar el servidor
Sino utiliza ningún servidor local puede levantar el servidor solo ejecutando este comando: 
```bash
php artisan serve
```
## Roles y Autenticación

El sistema implementa autenticación de usuarios utilizando **Laravel UI**, proporcionando las funcionalidades de registro, inicio de sesión y restablecimiento de contraseña.

La autorización se gestiona mediante un sistema de **roles basado en una tabla relacional** y un **middleware personalizado**, garantizando el control de acceso a rutas protegidas.

### Roles definidos

- **Administrador**
  - Acceso exclusivo a la ruta protegida `/admin`
  - Permisos completos sobre el sistema

- **Usuario**
  - Acceso estándar a la gestión de proyectos y tareas

### Control de acceso

La ruta `/admin` se encuentra protegida y solo puede ser accedida por usuarios con el rol **Administrador**.  
Los usuarios sin este rol reciben una respuesta de acceso denegado.

> **Nota:** Para pruebas, el rol de administrador puede asignarse mediante el seeder o directamente desde la base de datos utilizando pgAdmin.

## Modelo de Datos

El sistema se basa en un modelo relacional diseñado para la gestión estructurada de proyectos y sus tareas asociadas, utilizando PostgreSQL como sistema gestor de base de datos.

### Entidades principales

#### Proyectos
- `id`
- `name`
- `description`
- `created_at`
- `updated_at`

#### Tareas
- `id`
- `title`
- `description`
- `status`
- `project_id`
- `created_at`
- `updated_at`

### Estados de las tareas
Las tareas pueden encontrarse en uno de los siguientes estados:

- `pendiente`
- `en_progreso`
- `completada`

### Relaciones

- Un **Proyecto** puede tener múltiples **Tareas**.
- Una **Tarea** pertenece a un único **Proyecto**.

Esta relación se implementa como **uno a muchos (1:N)** mediante la clave foránea `project_id` en la tabla `tasks`, con **eliminación en cascada** para garantizar la integridad referencial.

### Integridad y consistencia

- Uso de claves foráneas para asegurar la relación entre proyectos y tareas.
- Eliminación automática de tareas asociadas al eliminar un proyecto.
- Validación de estados de tareas a nivel de aplicación.

## API REST

El sistema expone una **API REST** que permite la integración con clientes externos y el consumo de datos en formato **JSON**.  
Los endpoints están diseñados siguiendo principios RESTful y reflejan la estructura del modelo de datos.

### Endpoints disponibles

#### Proyectos

| Método | Endpoint | Descripción |
|------|--------|-------------|
| GET | `/api/projects` | Obtiene la lista de proyectos con sus tareas |
| POST | `/api/projects` | Crea un nuevo proyecto |
| GET | `/api/projects/{id}` | Obtiene el detalle de un proyecto específico |

#### Tareas

| Método | Endpoint | Descripción |
|------|--------|-------------|
| PATCH | `/api/tasks/{id}` | Actualiza parcialmente el estado de una tarea |

### Formato de respuesta

Las respuestas de la API se devuelven en formato **JSON**, incluyendo los datos solicitados y los códigos de estado HTTP correspondientes.

## Interfaz de Usuario

La interfaz de usuario fue desarrollada utilizando **Blade Templates** y **Bootstrap**, basándose en el scaffolding generado por **Laravel UI (Auth)**.

### Características principales

- Formularios de **Login**, **Registro** y **Restablecimiento de contraseña** completamente funcionales.
- Traducción y personalización de las vistas de autenticación al idioma español.
- Vistas estructuradas para la gestión de **Proyectos** y **Tareas**.
- Formularios con validación de datos y mensajes de error claros para el usuario.
- Navegación sencilla e intuitiva, orientada a una experiencia de usuario clara y funcional.

### Enfoque de diseño

La interfaz prioriza la **claridad**, **usabilidad** y **consistencia visual**, manteniendo una estructura simple y alineada a los requerimientos funcionales de la prueba técnica, sin depender de componentes externos innecesarios.


