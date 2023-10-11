# API de Restaurantes

API desarrollada con PHP y Laravel para la gestión de restaurantes y usuarios con autenticación JWT.

## Funcionalidades

- Registro y inicio de sesión de usuarios.
- Gestión de restaurantes: Crear, Modificar y Eliminar (requiere autenticación).
- Listar todos los restaurantes (público).

## Requisitos

- PHP (versión 8.2.4)
- Laravel (versión 10.26.2)
- Composer

## Configuración

1. Clona el repositorio.
2. Instala las dependencias con `composer install`.
3. Configura las variables de entorno en el archivo `.env`.
4. Ejecuta las migraciones con `php artisan migrate`.
5. Genera la clave secreta JWT con `php artisan jwt:secret`.

## Uso

- Registro de Usuario: `POST /api/`
- Inicio de Sesión: `POST /api/login`

### Rutas de Restaurantes

- Listar todos los restaurantes (público): `GET /api/restaurants`
- Crear un restaurante (autenticación requerida): `POST /api/restaurants`
- Modificar un restaurante (autenticación requerida): `PATCH /api/restaurants/{id}`
- Eliminar un restaurante (autenticación requerida): `DELETE /api/restaurants/{id}`

## Seguridad

La API utiliza autenticación JWT para proteger las rutas de restaurantes.

## Contribuciones

Las contribuciones son bienvenidas a través de Pull Requests.
