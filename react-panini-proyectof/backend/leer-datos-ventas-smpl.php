<?php
include 'vars.php';

$conex = new PDO("sqlite:" . $nombre_fichero); 

// Obtener datos de la tabla de ventas
$stmt_ventas = $conex->prepare('SELECT * FROM ventas;');
$stmt_ventas->execute();
$ventas = $stmt_ventas->fetchAll(PDO::FETCH_ASSOC);

// Cerrar las consultas y la conexión
$stmt_ventas = null;
$conex = null;

// Responder con los datos obtenidos
$response_data = array(
    'ventas' => $ventas
);

http_response_code(200);
echo json_encode($response_data);
?>