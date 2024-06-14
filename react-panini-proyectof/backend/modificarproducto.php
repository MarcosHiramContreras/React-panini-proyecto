<?php
// Habilitar reporte de errores (solo para depuración)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Headers CORS
header('Access-Control-Allow-Origin: http://localhost:5174');
header('Access-Control-Allow-Methods: PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Max-Age: 86400');

// Incluir archivo de conexión
include 'conexion.php';

// Verificar método de solicitud
if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    http_response_code(405); // Método no permitido
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

// Obtener datos del cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['id'])) {
    http_response_code(400); // Solicitud incorrecta
    echo json_encode(['error' => 'Datos incorrectos']);
    exit;
}

$id = $data['id'];
$nombre = $data['nombre'];
$categoria = $data['categoria'];
$descripcion = $data['descripcion'];
$stock = $data['stock'];
$precio = $data['precio'];

// Preparar la consulta SQL
$query = "UPDATE productos SET nombre = ?, categoria = ?, descripcion = ?, stock = ?, precio = ? WHERE id = ?";

// Preparar la declaración SQL usando declaraciones preparadas
$stmt = $conex->prepare($query);

if (!$stmt) {
    http_response_code(500); // Error interno del servidor
    echo json_encode(['error' => 'Error al preparar la consulta: ' . $conex->error]);
    exit;
}

// Vincular parámetros
$stmt->bind_param('sssidi', $nombre, $categoria, $descripcion, $stock, $precio, $id);

// Ejecutar la consulta
if ($stmt->execute()) {
    $response = ['message' => 'Producto actualizado correctamente', 'id' => $id];
    echo json_encode($response);
} else {
    http_response_code(500); // Error interno del servidor
    echo json_encode(['error' => 'Error al actualizar el producto: ' . $stmt->error]);
}

// Cerrar la declaración y conexión
$stmt->close();
$conex->close();
?>