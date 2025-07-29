<?php
session_start(); // Inicia la sesión para almacenar información del usuario

// Verifica si la solicitud es de tipo POST (es decir, el formulario fue enviado)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // --- Lógica de Validación (EJEMPLO MUY BÁSICO) ---
    // En un sistema real, aquí harías:
    // 1. Conexión a una base de datos.
    // 2. Consulta a la base de datos para obtener el usuario.
    // 3. Verificación de la contraseña hasheada (password_verify).
    // 4. Protección contra inyección SQL (consultas preparadas).

    // Usuarios y contraseñas de prueba (NUNCA USAR ASÍ EN PRODUCCIÓN)
    $usuarios_validos = [
        "admin" => "password123",
        "usuario1" => "secreto456"
    ];

    if (isset($usuarios_validos[$usuario]) && $usuarios_validos[$usuario] === $contrasena) {
        // Login exitoso
        $_SESSION['loggedin'] = true;
        $_SESSION['usuario'] = $usuario; // Guarda el nombre de usuario en la sesión
        
        // Redirige al usuario a una página de bienvenida o dashboard
        header("Location: bienvenida.php");
        exit; // Es importante salir después de una redirección
    } else {
        // Login fallido
        $_SESSION['error_login'] = "Usuario o contraseña incorrectos.";
        
        // Redirige de vuelta a la página de login
        header("Location: index.php");
        exit;
    }
} else {
    // Si alguien intenta acceder a este archivo directamente sin enviar el formulario
    header("Location: index.php");
    exit;
}
?>