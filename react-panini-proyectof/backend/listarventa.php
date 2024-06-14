<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Incluir la configuración de la conexión a la base de datos
include 'conexion.php'; // Asegúrate de que este archivo contiene la configuración correcta para tu base de datos SQLite

try {
    // Consulta SQL para seleccionar todas las ventas
    $query = "SELECT * FROM ventas";
    $statement = $conex->prepare($query);
    $statement->execute();

    // Obtener los resultados de la consulta
    $ventas = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Devolver las ventas como JSON
    echo json_encode($ventas);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(array("message" => "Error al obtener ventas: " . $e->getMessage()));
}
?>