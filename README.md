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

- Registro de Usuario: `POST /api/users`
  -Ejemplo:
  {
  "name": "UserExample",
  "email": "userexample@example.com",
  "password": "12345678"
  }
- Inicio de Sesión: `POST /api/users/login`
  Ejemplo:
  {
  "name": "UserExample",
  "password": "12345678"
  }

### Rutas de Restaurantes

- Listar todos los restaurantes (público): `GET /api/restaurants`
- Crear un restaurante (autenticación requerida): `POST /api/restaurants`
  -Ejemplo:
  {
  "name": "RestaurantExample",
  "address": "Example street",
  "phone": "999999999"
  }
- Modificar un restaurante (autenticación requerida): `PATCH /api/restaurants/{id}`
- Eliminar un restaurante (autenticación requerida): `DELETE /api/restaurants/{id}`

## Seguridad

La API utiliza autenticación JWT para proteger las rutas de restaurantes. En todas las rutas protegidas, asegúrate de incluir el token JWT en la cabecera de la solicitud utilizando el esquema "Bearer" en la cabecera "Authorization".
