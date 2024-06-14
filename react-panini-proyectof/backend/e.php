<?php
	$conex = new PDO("sqlite:./alumnos.sqlite3");
	$stm = $conex -> prepare ("select * from alumnos");
	$stm -> execute();
	$data = $stm -> fetchALL(PDO::FETCH_ASSOC);
echo json_encode($data)
?>