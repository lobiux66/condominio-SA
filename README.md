# Condominio SA

Sistema web de administración de condominios construido con Laravel 11, PHP 8.2 y Vite.

## Objetivo de esta rama

Preparar una primera versión demostrable para administradores y personal del condominio. La interfaz reúne los módulos existentes; cada flujo debe validarse antes de ofrecerlo como sistema de producción.

## Requisitos

- PHP 8.2 o superior y Composer
- Node.js y npm
- PostgreSQL (configuración sugerida) o una base compatible con la configuración de Laravel

## Instalación local

1. Clona el repositorio y entra en la carpeta:
   `git clone https://github.com/lobiux66/condominio-SA.git`
2. Instala dependencias:
   `composer install`
3. Copia `.env.example` a `.env` y configura la base de datos:
   `cp .env.example .env`
4. Genera la clave de la aplicación:
   `php artisan key:generate`
5. Crea la base de datos vacía y ejecuta las migraciones:
   `php artisan migrate`
6. Instala y compila los recursos:
   `npm install`
   `npm run build`
7. Inicia el servidor:
   `php artisan serve`
8. Abre `http://127.0.0.1:8000`.

## Datos de demostración

El proyecto incluye seeders en `database/seeders`. Antes de ejecutar `php artisan db:seed`, revisa su contenido y usa únicamente una base de datos local desechable. Algunos seeders crean cuentas de prueba y datos relacionados; no reutilices esas credenciales en un servidor público.

**Importante:** `php artisan migrate:fresh --seed` elimina todas las tablas y vuelve a crearlas. No lo ejecutes sobre una base de datos con información real. Para despliegues normales se usa `php artisan migrate --force`, que no borra las tablas existentes.

## Despliegue con Docker

El `Dockerfile` prepara Apache, PHP, las dependencias y los recursos de frontend. Configura en el proveedor las variables de entorno reales (`APP_KEY`, conexión de base de datos y `APP_DEBUG=false`) antes de publicar. El contenedor ejecuta migraciones pendientes al arrancar; no carga automáticamente seeders ni restablece la base de datos.

## Estado de la versión

- [x] Primera renovación visual del panel principal y búsqueda de módulos.
- [x] Archivo de variables de entorno de ejemplo.
- [x] Arranque Docker sin reiniciar/borrar los datos en cada despliegue.
- [ ] Ejecutar pruebas automáticas y pruebas manuales de cada módulo.
- [ ] Verificar permisos de administrador y personal.
- [ ] Cargar datos ficticios revisados para una demo aislada.
- [ ] Publicar en hosting y configurar dominio/HTTPS.

Esta versión es una base de demostración en preparación, no una certificación de seguridad ni de funcionamiento completo.
