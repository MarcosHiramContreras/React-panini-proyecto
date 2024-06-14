<?php
include 'vars.php';

#verificar si vienen losparametros requeridos
if (empty($_POST["id"])) {
    http_response_code(400);
	exit("Falta insertar el id a cambiar"); #Terminar el script definitivamente
}
#verificar si vienen losparametros requeridos
if (empty($_POST["nombre"])) {
    http_response_code(400);
	exit("Falta insertar el nuevo nombre"); #Terminar el script definitivamente
}
if (empty($_POST["categoria"])) {
    http_response_code(400);
	exit("falta insertar la nueva categoria"); #Terminar el script definitivamente
}
if (empty($_POST["precio"])) {
    http_response_code(400);
	exit("falta insertar el nuevo precio"); #Terminar el script definitivamente
}
if (empty($_POST["cantidad"])) {
    http_response_code(400);
	exit("falta insertar la nueva cantidad"); #Terminar el script definitivamente
}
if (empty($_POST["total"])) {
    http_response_code(400);
	exit("falta insertar el nuevo total de la venta"); #Terminar el script definitivamente
}
//
$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$venta=[
    "id" => $_POST["id"],
    "nombre"=> $_POST["nombre"],
    "categoria"=> $_POST["categoria"],
    "precio"=> $_POST["precio"],
    "cantidad"=> $_POST["cantidad"],
    "total"=> $_POST["total"]
];
try{
    # preparando la consulta
    $sentencia = $conex->prepare("update ventas set nombre=:nombre, categoria=:categoria, precio=:precio, cantidad=:cantidad, total=:total where id=:id;");
    $resultado = $sentencia->execute($venta);
    http_response_code(200);
    echo "datos actualizados";

}catch(PDOException $exc){
    http_response_code(400);
    echo "Lo siento, ocurrió un error:".$exc->getMessage();
}

?>