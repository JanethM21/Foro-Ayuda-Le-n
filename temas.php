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

// Obtener los temas de la base de datos
$topics = []; // Aquí debes llenar el array con los datos de la base de datos
$result = $conn->query("SELECT id, name, description FROM topics");

if ($result) { // Verificar si la consulta fue exitosa
    while ($row = $result->fetch_assoc()) {
        $topics[] = $row;
    }
} else {
    // Manejo de errores en caso de que la consulta falle
    echo "Error en la consulta: " . $conn->error;
}
function obtenerTemas($parent_topic_id) {
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

    // Preparar y ejecutar la consulta para obtener los temas
    $stmt = $conn->prepare("SELECT name, description FROM topics WHERE parent_topic_id = ?");
    $stmt->bind_param("i", $parent_topic_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $temas = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $temas[] = $row; // Agregar cada tema al array
        }
    }

    $stmt->close();
    $conn->close();

    return $temas; // Retornar los temas
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Foro de Dudas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Temas de Interés</h1>
        <a href="create_topic.php" class="btn btn-primary mb-3">Crear Nuevo Tema</a>
        <div class="row">
            <?php foreach ($topics as $topic): ?>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($topic['name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($topic['description']); ?></p>
                        <a href="<?php echo 'view_topic.php?topic_id=' . intval($topic['id']); ?>" class="btn btn-info">Ver Dudas</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
<footer>
<div>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina De Inicio</title>
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
    <a href="http://localhost/ayuda%20leon/dashboard.php" class="boton">Pagina De Inicio</a>
    </div>
</footer>

</html>

<?php
// Cerrar la conexión
$conn->close();
?>