<?php
include 'vars.php';

#verificar si vienen losparametros requeridos
if (empty($_POST["nombre"])) {
    http_response_code(400);
	exit("Falta insertar el nombre"); #Terminar el script definitivamente
}

if (empty($_POST["categoria"])) {
    http_response_code(400);
	exit("falta insertar la categoria"); #Terminar el script definitivamente
}
if (empty($_POST["precio"])) {
    http_response_code(400);
	exit("falta insertar el precio"); #Terminar el script definitivamente
}
if (empty($_POST["cantidad"])) {
    http_response_code(400);
	exit("falta insertar la cantidad"); #Terminar el script definitivamente
}
if (empty($_POST["total"])) {
    http_response_code(400);
	exit("falta insertar el total de la venta"); #Terminar el script definitivamente
}
//
$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$venta=[
    "nombre"=> $_POST["nombre"],
    "categoria"=> $_POST["categoria"],
    "precio"=> $_POST["precio"],
    "cantidad"=> $_POST["cantidad"],
    "total"=> $_POST["total"]
];
try{
    # preparando la consulta
    $sentencia = $conex->prepare("insert into ventas(nombre, categoria, precio, cantidad, total) values(:nombre, :categoria, :precio, :cantidad, :total);");
    $resultado = $sentencia->execute($venta);
    http_response_code(200);
    echo "datos insertados";

}catch(PDOException $exc){
    http_response_code(400);
    echo "Lo siento, ocurrió un error:".$exc->getMessage();
}

?>