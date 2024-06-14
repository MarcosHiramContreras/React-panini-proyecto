<?php

// Conexión a la base de datos SQLite
$db = new SQLite3('basededatos.sqlite3');

// Obtener los datos del cuerpo de la solicitud (request body)
$data = json_decode(file_get_contents('php://input'), true);

// Extraer los datos del distribuidor
$id = $data['id'];
$nombre = $data['nombre'];
$telefono = $data['telefono'];
$direccion = $data['direccion'];
$correo = $data['correo'];

// Preparar la consulta SQL para actualizar el distribuidor
$stmt = $db->prepare('UPDATE distribuidores SET nombre = :nombre, telefono = :telefono, direccion = :direccion, correo = :correo WHERE id = :id');
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$stmt->bindValue(':nombre', $nombre, SQLITE3_TEXT);
$stmt->bindValue(':telefono', $telefono, SQLITE3_TEXT);
$stmt->bindValue(':direccion', $direccion, SQLITE3_TEXT);
$stmt->bindValue(':correo', $correo, SQLITE3_TEXT);

// Ejecutar la consulta
$result = $stmt->execute();

if ($result) {
    // Éxito al actualizar el distribuidor
    $response = array('message' => 'Distribuidor actualizado correctamente');
    http_response_code(200); // Código 200: OK
    echo json_encode($response);
} else {
    // Error al actualizar el distribuidor
    $response = array('message' => 'Error al intentar actualizar el distribuidor');
    http_response_code(500); // Código 500: Internal Server Error
    echo json_encode($response);
}

$db->close();
?>