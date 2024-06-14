<?php
include 'vars.php';

$conex = new PDO("sqlite:" . $nombre_fichero); 

// Obtener datos de la tabla de productos
$stmt_productos = $conex->prepare('SELECT * FROM productos;');
$stmt_productos->execute();
$productos = $stmt_productos->fetchAll(PDO::FETCH_ASSOC);

// Cerrar las consultas y la conexión
$stmt_productos = null;
$conex = null;

// Responder con los datos obtenidos
$response_data = array(
    'productos' => $productos
);

http_response_code(200);
echo json_encode($response_data);
?>