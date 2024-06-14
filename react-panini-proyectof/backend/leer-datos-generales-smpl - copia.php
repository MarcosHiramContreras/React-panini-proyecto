<?php
include 'vars.php';

$conex = new PDO("sqlite:" . $nombre_fichero); 

// Obtener datos de la tabla de productos
$stmt_productos = $conex->prepare('SELECT * FROM productos;');
$stmt_productos->execute();
$productos = $stmt_productos->fetchAll(PDO::FETCH_ASSOC);

// Obtener datos de la tabla de distribuidores
$stmt_distribuidores = $conex->prepare('SELECT * FROM distribuidores;');
$stmt_distribuidores->execute();
$distribuidores = $stmt_distribuidores->fetchAll(PDO::FETCH_ASSOC);

// Obtener datos de la tabla de ventas
$stmt_ventas = $conex->prepare('SELECT * FROM ventas;');
$stmt_ventas->execute();
$ventas = $stmt_ventas->fetchAll(PDO::FETCH_ASSOC);

// Cerrar las consultas y la conexión
$stmt_productos = null;
$stmt_distribuidores = null;
$stmt_ventas = null;
$conex = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Generales</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>

<div class="w3-container">
    <h2>Datos Generales</h2>

    <div class="w3-row">
        <div class="w3-col m4">
            <h3>Productos</h3>
            <table class="w3-table-all">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Descripción</th>
                        <th>Stock</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= $producto['id'] ?></td>
                        <td><?= $producto['nombre'] ?></td>
                        <td><?= $producto['categoria'] ?></td>
                        <td><?= $producto['descripcion'] ?></td>
                        <td><?= $producto['stock'] ?></td>
                        <td><?= $producto['precio'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="w3-col m4">
            <h3>Distribuidores</h3>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Correo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include 'vars.php';

                    $conex = new PDO("sqlite:" . $nombre_fichero); 
                    $stmt_distribuidores = $conex->prepare('SELECT * FROM distribuidores;');
                    $stmt_distribuidores->execute();
                    $distribuidores = $stmt_distribuidores->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($distribuidores as $distribuidor) {
                        echo "<tr>";
                        echo "<td>{$distribuidor['id']}</td>";
                        echo "<td>{$distribuidor['nombre']}</td>";
                        echo "<td>{$distribuidor['telefono']}</td>";
                        echo "<td>{$distribuidor['direccion']}</td>";
                        echo "<td>{$distribuidor['correo']}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="w3-col m4">
            <h3>Ventas</h3>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'vars.php';

                $conex = new PDO("sqlite:" . $nombre_fichero); 
                $stmt_ventas = $conex->prepare('SELECT * FROM ventas;');
                $stmt_ventas->execute();
                $ventas = $stmt_ventas->fetchAll(PDO::FETCH_ASSOC);
                foreach ($ventas as $venta) {
                    echo "<tr>";
                    echo "<td>{$venta['id']}</td>";
                    echo "<td>{$venta['nombre']}</td>";
                    echo "<td>{$venta['categoria']}</td>";
                    echo "<td>{$venta['precio']}</td>";
                    echo "<td>{$venta['cantidad']}</td>";
                    echo "<td>{$venta['total']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>