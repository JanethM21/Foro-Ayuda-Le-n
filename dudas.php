<?php
// Conexión a la base de datos
$servername = "localhost"; // Cambia si es necesario
$username = "root"; // Cambia si es necesario
$password = ""; // Cambia si es necesario
$dbname = "ayuda_leon"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['titulo']) && !empty($_POST['descripcion'])) {
    $titulo = htmlspecialchars($_POST['titulo']); // Sanitizar la entrada
    $descripcion = htmlspecialchars($_POST['descripcion']); // Sanitizar la entrada

    // Preparar y vincular
    $stmt = $conn->prepare("INSERT INTO dudas (titulo, descripcion) VALUES (?, ?)");
    $stmt->bind_param("ss", $titulo, $descripcion);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Duda publicada con éxito.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();
}

// Obtener las dudas publicadas
$result = $conn->query("SELECT * FROM dudas ORDER BY fecha DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Dudas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"], textarea {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .duda {
            background: #e9ecef;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
        }
        .duda h3 {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Publica tu Duda</h1>
        <form method="POST" action="">
            <input type="text" name="titulo" placeholder="Título de la duda" required>
            <textarea name="descripcion" placeholder="Descripción de la duda..." required></textarea>
            <button type="submit">Enviar Duda</button>
        </form>

        <h2>Dudas Publicadas</h2>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="duda">
                    <h3><?php echo $row['titulo']; ?></h3>
                    <p><?php echo $row['descripcion']; ?></p>
                    <p><small>Publicado el: <?php echo $row['fecha']; ?></small></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No hay dudas publicadas todavía.</p>
        <?php endif; ?>
        </body>
    <footer>
    <div>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicación de dudas</title>
    <style>
        .boton {
            background-color: #cc261f; /* Color de fondo */
            color: white; /* Color del texto */
            padding: 10px 20px; /* Espaciado interno */
            text-align: center; /* Centrar texto */
            text-decoration: none; /* Sin subrayado */
            display: inline-block; /* Mostrar como bloque en línea */
            border: none; /* Sin borde */
            border-radius: 5px; /* Bordes redondeados */
            cursor: pointer; /* Cambiar cursor al pasar el mouse */
        }
    </style>
    <a href="http://localhost/ayuda%20leon/dashboard.php" class="boton">Publicación de dudas</a>
    </div>
    </footer>
