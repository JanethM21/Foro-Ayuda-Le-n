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
$parent_topic_id = intval($_GET['id']);

// Preparar y ejecutar la consulta para obtener los temas
$stmt = $conn->prepare("SELECT name, description FROM topics_respuestas WHERE parent_topic_id = ?");
$stmt->bind_param("i", $parent_topic_id);
$stmt->execute();
$result = $stmt->get_result();

// Mostrar los temas
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
    }
} else {
    echo "No se encontraron temas.";
}

$stmt->close();
$conn->close();
?>