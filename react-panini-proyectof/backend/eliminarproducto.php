<?php
// Verificar si la solicitud es de tipo OPTIONS (preflight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *'); // Cambia esto según tu configuración de frontend
    header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
    header('Access-Control-Allow-Methods: DELETE, OPTIONS');
    exit();
}

// Headers CORS para respuestas normales
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: DELETE');

// Verificar si se recibió un ID válido por parámetro
$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    http_response_code(400);
    echo json_encode(array("message" => "ID de producto no proporcionado"));
    exit;
}

// Incluir archivo de conexión a la base de datos SQLite
include 'conexion.php';

try {
    // Preparar la consulta SQL para eliminar el producto por ID
    $query = "DELETE FROM productos WHERE id = :id";
    $statement = $conex->prepare($query);

    // Ejecutar la consulta con el ID del producto
    $statement->execute(array(':id' => $id));

    // Verificar si se eliminó correctamente
    $rowCount = $statement->rowCount();
    if ($rowCount > 0) {
        http_response_code(200);
        echo json_encode(array("message" => "Producto eliminado correctamente"));
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "No se encontró el producto con el ID proporcionado"));
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(array("message" => "Error en la base de datos: " . $e->getMessage()));
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(array("message" => "Error en el servidor: " . $e->getMessage()));
}
?>