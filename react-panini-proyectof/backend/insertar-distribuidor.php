<?php
include 'vars.php';

#verificar si vienen losparametros requeridos
if (empty($_POST["nombre"])) {
    http_response_code(400);
	exit("Falta insertar el nombre"); #Terminar el script definitivamente
}

if (empty($_POST["telefono"])) {
    http_response_code(400);
	exit("falta insertar el telefono"); #Terminar el script definitivamente
}
if (empty($_POST["direccion"])) {
    http_response_code(400);
	exit("falta insertar la direccion"); #Terminar el script definitivamente
}
if (empty($_POST["correo"])) {
    http_response_code(400);
	exit("falta insertar el correo"); #Terminar el script definitivamente
}
//
$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$distribuidor=[
    "nombre"=> $_POST["nombre"],
    "telefono"=> $_POST["telefono"],
    "direccion"=> $_POST["direccion"],
    "correo"=> $_POST["correo"]
];
try{
    # preparando la consulta
    $sentencia = $conex->prepare("insert into distribuidores(nombre, telefono, direccion, correo) values(:nombre, :telefono, :direccion, :correo);");
    $resultado = $sentencia->execute($distribuidor);
    http_response_code(200);
    echo "datos insertados";

}catch(PDOException $exc){
    http_response_code(400);
    echo "Lo siento, ocurrió un error:".$exc->getMessage();
}

?>