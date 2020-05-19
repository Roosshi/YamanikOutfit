<?php
include "configs/config.php";
include "configs/funciones.php";

if (!isset($p)) {
    $p = "principal";
} else {
    $p = $p;
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome/css/all.css" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="fontawesome/js/all.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
    <link rel="stylesheet" href="css/estilo.css">
    <title>Yamanik</title>

</head>

<body>
    <div class="logo">
        <a href="/">
            <img src="img/principal/logo2.png" alt="Logotipo de Bienes y Raices">
        </a>
    </div>

    <div class="header">
        Yamanik Outfit
    </div>

    <div class="menu">
        <a href="?p=principal">Principal</a>
        <a href="?p=productos">Productos</a>
        <a href="?p=ofertas">Ofertas</a>
        <a href="?p=carrito">Carrito</a>
        <a href="?p=miscompras">Mis compras</a>
        <!-- 
        <a href="?p=admin">Administrador</a> 
        -->
        <?php
        if (isset($_SESSION['id_cliente'])) {
        ?>
            <a class="pull-right subir" href="?p=salir">Salir</a>
            <a class="pull-right subir" href="#"><?= nombre_cliente($_SESSION['id_cliente']) ?></a>

        <?php
        }
        ?>
    </div>

    <div class="cuerpo">
        <?php
        if (file_exists("modulos/" . $p . ".php")) {
            include "modulos/" . $p . ".php";
        } else {
            echo "<i>No se ha encontrado el modulo <b>" . $p . "</b> <a href='./'>Regresar</a></i>";
        }

        ?>
    </div>

    <div class="footer">
        Copyright Yamanik &copy; <?= date("Y") ?>
    </div>
</body>

</html>