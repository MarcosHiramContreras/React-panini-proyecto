<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Incluir la configuración de la conexión a la base de datos
include 'conexion.php'; // Aquí debes incluir el archivo donde tienes la configuración de conexión a tu base de datos SQLite

try {
    // Consulta SQL para seleccionar todos los productos
    $query = "SELECT * FROM productos";
    $statement = $conex->prepare($query);
    $statement->execute();

    // Obtener los resultados de la consulta
    $productos = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Devolver los productos como JSON
    echo json_encode($productos);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(array("message" => "Error al obtener productos: " . $e->getMessage()));
}
?>