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
	exit("Falta insertar el nombre a nuevo"); #Terminar el script definitivamente
}

if (empty($_POST["categoria"])) {
    http_response_code(400);
	exit("falta insertar la categoria nueva"); #Terminar el script definitivamente
}
if (empty($_POST["descripcion"])) {
    http_response_code(400);
	exit("falta insertar la descripcion nueva"); #Terminar el script definitivamente
}
if (empty($_POST["stock"])) {
    http_response_code(400);
	exit("falta insertar el stock nuevo"); #Terminar el script definitivamente
}
if (empty($_POST["precio"])) {
    http_response_code(400);
	exit("falta insertar el precio nuevo"); #Terminar el script definitivamente
}
//
$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$producto=[
    "id"=> $_POST["id"],
    "nombre"=> $_POST["nombre"],
    "categoria"=> $_POST["categoria"],
    "descripcion"=> $_POST["descripcion"],
    "stock"=> $_POST["stock"],
    "precio"=> $_POST["precio"]
];
try{
    # preparando la consulta
    $sentencia = $conex->prepare("update productos set nombre=:nombre, categoria=:categoria, descripcion=:descripcion, stock=:stock, precio=:precio where id=:id;");
    $resultado = $sentencia->execute($producto);
    http_response_code(200);
    echo "datos actualizados";

}catch(PDOException $exc){
    http_response_code(400);
    echo "Lo siento, ocurrió un error:".$exc->getMessage();
}

?>