<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <form method="POST" action="/login">
        @csrf
        <label>Nombre:</label>
        <input type="text" name="Nombre"><br>
        <label>Contraseña:</label>
        <input type="password" name="Password"><br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
