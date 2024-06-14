<?php
include 'vars.php';

$conex = new PDO("sqlite:" . $nombre_fichero); 

// Obtener datos de la tabla de distribuidores
$stmt_distribuidores = $conex->prepare('SELECT * FROM distribuidores;');
$stmt_distribuidores->execute();
$distribuidores = $stmt_distribuidores->fetchAll(PDO::FETCH_ASSOC);

// Cerrar las consultas y la conexión
$stmt_productos = null;
$stmt_distribuidores = null;
$stmt_ventas = null;
$conex = null;

// Responder con los datos obtenidos
$response_data = array(
    'distribuidores' => $distribuidores
);

http_response_code(200);
echo json_encode($response_data);
?>