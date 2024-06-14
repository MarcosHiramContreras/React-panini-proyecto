<?php

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *'); // Cambia esto según tu configuración de frontend
    header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    exit();
}

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

// Verificar si se recibieron datos JSON
$data = json_decode(file_get_contents("php://input"), true);

// Verificar si todos los campos requeridos están presentes
if (empty($data["nombre"]) || empty($data["categoria"]) || empty($data["descripcion"]) || empty($data["stock"]) || empty($data["precio"])) {
    http_response_code(400);
    echo json_encode(array("message" => "Faltan datos requeridos"));
    exit;
}

// Incluir archivo de conexión a la base de datos SQLite
include 'conexion.php';

// Preparar los datos del producto
$producto = [
    "nombre" => $data["nombre"],
    "categoria" => $data["categoria"],
    "descripcion" => $data["descripcion"],
    "stock" => $data["stock"],
    "precio" => $data["precio"]
];

try {
    // Preparar la consulta SQL
    $query = "INSERT INTO productos (nombre, categoria, descripcion, stock, precio) VALUES (:nombre, :categoria, :descripcion, :stock, :precio)";
    $statement = $conex->prepare($query);

    // Ejecutar la consulta con los datos del producto
    $result = $statement->execute($producto);

    if ($result) {
        http_response_code(200);
        echo json_encode(array("message" => "Producto insertado correctamente"));
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Error al insertar producto"));
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(array("message" => "Error en la base de datos: " . $e->getMessage()));
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(array("message" => "Error en el servidor: " . $e->getMessage()));
}
?>