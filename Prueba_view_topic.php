<?php
include 'temas.php'; // Incluir el archivo temas.php

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
    
    // Obtener el tema específico
    $topic_stmt = $conn->prepare("SELECT name, description FROM topics WHERE id = ?");
    $topic_stmt->bind_param("i", $topic_id);
    $topic_stmt->execute();
    $topic_result = $topic_stmt->get_result();

    if ($topic_result->num_rows > 0) {
        $topic = $topic_result->fetch_assoc();
    } else {
        die("Tema no encontrado.");
    }

    // Obtener las preguntas relacionadas con el tema usando la función del archivo temas.php
    $questions = obtenerTemas($topic_id);

    $topic_stmt->close();
} else {
    die("ID de tema no proporcionado.");
}

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
        <p><?php echo htmlspecialchars($topic['description']); ?></p>
        <div>
        <h2>Agregar Tema Relacionado</h2>
        <form action="add_topic.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nombre del Tema</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <input type="hidden" name="parent_topic_id" value="<?php echo $topic_id; ?>">
            <button type="submit" class="btn btn-primary">Agregar Tema</button>
        </form>
        </div>
        <h2>Temas Relacionados</h2>
        <ul class="list-group">
            <?php if (!empty($temas_relacionados)): ?>
                <?php foreach ($temas_relacionados as $tema): ?>
                    <li class="list-group-item">
                        <h5><?php echo htmlspecialchars($tema['name']); ?></h5>
                        <p><?php echo htmlspecialchars($tema['description']); ?></p>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="list-group-item">No hay temas relacionados disponibles.</li>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>