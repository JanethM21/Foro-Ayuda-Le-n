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

// Obtener el ID del tema desde la URL
if (isset($_GET['topic_id'])) {
    $topic_id = intval($_GET['topic_id']);

    // Preparar y ejecutar la consulta para obtener el tema
    $stmt = $conn->prepare("SELECT name, description FROM topics WHERE id = ?");
    $stmt->bind_param("i", $topic_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró el tema
    if ($result->num_rows > 0) {
        $topic = $result->fetch_assoc();
    } else {
        echo "Tema no encontrado.";
        exit;
    }

    $stmt->close();
} else {
    echo "ID de tema no especificado.";
    exit;
}

// Manejo de la respuesta al tema
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reply_title'], $_POST['reply_description'])) {
    $reply_title = $_POST['reply_title'];
    $reply_description = $_POST['reply_description'];

    // Insertar la respuesta en la base de datos
    $stmt = $conn->prepare("INSERT INTO replies (topic_id, title, description) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $topic_id, $reply_title, $reply_description);
    $stmt->execute();
    $stmt->close();
}

// Obtener las respuestas del tema
$stmt = $conn->prepare("SELECT title, description FROM replies WHERE topic_id = ?");
$stmt->bind_param("i", $topic_id);
$stmt->execute();
$result = $stmt->get_result();

$responses = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $responses[] = $row; // Agregar cada respuesta al array
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($topic['name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1><?php echo htmlspecialchars($topic['name']); ?></h1>
        <p><?php echo nl2br(htmlspecialchars($topic['description'])); ?></p>
        <a href="index.php" class="btn btn-primary">Volver a Temas</a>

        <hr>

        <h2>Responder al Tema</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label for="reply_title" class="form-label">Título de la Respuesta</label>
                <input type="text" class="form-control" id="reply_title" name="reply_title" required>
            </div>
            <div class="mb-3">
                <label for="reply_description" class="form-label">Descripción de la Respuesta</label>
                <textarea class="form-control" id="reply_description" name="reply_description" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Enviar Respuesta</button>
        </form>

        <hr>

        <h2>Respuestas</h2>
        <?php if (count($responses) > 0): ?>
            <ul class="list-group">
                <?php foreach ($responses as $response): ?>
                    <li class="list-group-item">
                        <h5><?php echo htmlspecialchars($response['title']); ?></h5>
                        <p><?php echo nl2br(htmlspecialchars($response['description'])); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No hay respuestas para este tema aún.</p>
        <?php endif; ?>
    </div>
</body>
<footer>
<div>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apartado de Temas</title>
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
    <a href="http://localhost/ayuda%20leon/temas.php" class="boton">Apartado de Temas</a>
    </div>
</footer>
</html>