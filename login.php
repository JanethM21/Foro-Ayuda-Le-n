<?php
session_start();

// Conexión a la base de datos
$mysqli = new mysqli("localhost", "root", "", "ayuda_leon");

// Verifica si hay errores en la conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Verifica si se ha enviado el formulario de inicio de sesión
if (isset($_POST['login'])) {
    // Escapa los datos de entrada para evitar inyecciones
    $username = $mysqli->real_escape_string(trim($_POST['username']));
    $password = trim($_POST['password']);

    // Prepara la consulta SQL
    $stmt = $mysqli->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Verifica si se encontró el usuario
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        
        // Verifica la contraseña
        if (password_verify($password, $hashed_password)) {
            // Establece las variables de sesión
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit;
        } else {
            echo "¡Contraseña incorrecta!";
        }
    } else {
        echo "¡Usuario no encontrado!";
    }

    // Cierra la declaración
    $stmt->close();
}

// Verifica si se ha enviado el formulario de registro
if (isset($_POST['register'])) {
    // Escapa los datos de entrada para evitar inyecciones
    $new_username = $mysqli->real_escape_string(trim($_POST['new_username']));
    $new_password = trim($_POST['new_password']);
    $email = $mysqli->real_escape_string(trim($_POST['email']));

    // Encriptar la contraseña
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Prepara la consulta SQL para insertar el nuevo usuario
    $stmt = $mysqli->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $new_username, $hashed_password, $email);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Usuario creado exitosamente.";
    } else {
        echo "Error al crear el usuario: " . $stmt->error;
    }

    // Cierra la declaración
    $stmt->close();
}

// Cierra la conexión
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión / Registrarse</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #5cb85c;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        .error {
            color: red;
            text-align: center;
        }
        .success {
            color: green;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">



<!-- Formulario de inicio de sesión -->
<h2>Iniciar sesión</h2>
<form action="login.php" method="post">
  <label for="username">Nombre de usuario:</label>
  <input id="username" name="username" required type="text" />
  
  <label for="password">Contraseña:</label>
  <input id="password" name="password" required type="password" />
  
  <input name="login" type="submit" value="Iniciar sesión" />
</form>

<!-- Formulario de registro -->
<h2>Registrarse</h2>
<form action="login.php" method="post">
  <label for="new_username">Nombre de usuario:</label>
  <input id="new_username" name="new_username" required type="text" />
  
  <label for="new_password">Contraseña:</label>
  <input id="new_password" name="new_password" required type="password" />
  
  <label for="email">Correo electrónico:</label>
  <input id="email" name="email" required type="email" />
  
  <input name="register" type="submit" value="Registrarse" />
</form>