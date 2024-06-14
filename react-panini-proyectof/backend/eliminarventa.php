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

// Verificar si el método es DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Obtener el ID de la venta a eliminar
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if ($id === null) {
        // Si no se proporciona el ID, responder con un mensaje de error
        http_response_code(400); // Bad Request
        echo json_encode(array('message' => 'No se proporcionó el ID de la venta.'));
        exit();
    }

    // Configuración de la base de datos SQLite (puedes ajustarla según tu configuración)
    $dbFile = 'basededatos.sqlite3'; // Nombre del archivo SQLite
    $dsn = 'sqlite:' . $dbFile; // Data Source Name (DSN)
    
    // Intentar establecer la conexión con la base de datos SQLite
    try {
        $pdo = new PDO($dsn);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Error al conectar con la base de datos: ' . $e->getMessage()));
        exit();
    }

    // Preparar la consulta para eliminar la venta
    $sql = "DELETE FROM ventas WHERE id = :id";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Verificar si se eliminó algún registro
        if ($stmt->rowCount() > 0) {
            // Si se eliminó al menos un registro, responder con un mensaje de éxito
            http_response_code(200); // OK
            echo json_encode(array('message' => 'Venta eliminada correctamente'));
        } else {
            // Si no se encontró la venta con el ID proporcionado, responder con un mensaje de error
            http_response_code(404); // Not Found
            echo json_encode(array('message' => 'No se encontró la venta con el ID proporcionado'));
        }
    } catch (PDOException $e) {
        // Si hay un error en la ejecución de la consulta, responder con un mensaje de error
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Error al eliminar la venta: ' . $e->getMessage()));
    }
} else {
    // Si el método no es DELETE, responder con un error de método no permitido
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('message' => 'Método no permitido. Solo se permite DELETE.'));
}
?>