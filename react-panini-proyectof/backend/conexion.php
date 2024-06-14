<?php
$nombre_fichero = './basededatos.sqlite3'; // Ruta al archivo SQLite

try {
    // Conexión a la base de datos SQLite usando PDO
    $conex = new PDO("sqlite:" . $nombre_fichero);
    $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Otros ajustes opcionales de PDO, si es necesario
} catch (PDOException $e) {
    // Manejo de errores
    http_response_code(500);
    echo json_encode(array("message" => "Error en la conexión a la base de datos: " . $e->getMessage()));
    exit();
}
?>