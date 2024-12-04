<?php
$servername = "localhost"; // Cambia si es necesario
$username = "root"; // Cambia si es necesario
$password = ""; // Cambia si es necesario
$dbname = "ayuda_leon"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Manejar la inserción del nuevo tema
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);

    // Validar que los campos no estén vacíos
    if (!empty($name) && !empty($description)) {
        // Preparar y vincular
        $stmt = $conn->prepare("INSERT INTO topics (name, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $description);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Nuevo tema creado exitosamente.";
            // Redirigir a la página principal o a la página de temas
            header("Location: temas.php"); // Cambia 'index.php' a la página que desees
            exit();
        } else {
            echo "Error al crear el tema: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Por favor, completa todos los campos.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Nuevo Tema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Crear Nuevo Tema</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Nombre del Tema</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Crear Tema</button>
            <a href="temas.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>