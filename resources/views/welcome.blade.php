<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <title>Foodie API</title>
</head>
<body style="display: flex; flex-direction: column; align-items: center; justify-content: center; ">
  <h1>Bienvenido a Foodie API</h1>
    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 1rem ">
     <h2>Rutas de Usuarios</h2>
    <span>Registro de Usuario: POST /api/users</span>
    <span>Inicio de Sesión: POST /api/users/login</span>
    <h2>Rutas de Restaurantes</h2>
    <span>Listar todos los restaurantes (público): GET /api/restaurants</span>
    <span>Crear un restaurante (autenticación requerida): POST /api/restaurants</span>
    <span>Modificar un restaurante (autenticación requerida): PATCH /api/restaurants/{id}</span>
    <span>Eliminar un restaurante (autenticación requerida): DELETE /api/restaurants/{id}</span>
    </div>
</body>
</html>

