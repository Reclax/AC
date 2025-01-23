<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visual</title>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" type="text/css" href="jquery-easyui/themes/bootstrap/easyui.css">
    <link rel="stylesheet" type="text/css" href="jquery-easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="jquery-easyui/themes/color.css">
    <link rel="stylesheet" type="text/css" href="jquery-easyui/demo/demo.css">
    <script type="text/javascript" src="jquery-easyui/jquery.min.js"></script>
    <script type="text/javascript" src="jquery-easyui/jquery.easyui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <img src="images/header.png" alt="" height="90%" width="auto">
    </header>
    <nav>
        <ul>
        <li><a href="index.php?action=inicio">Inicio</a></li>
                <li><a href="index.php?action=nosotros">Nosotros</a></li>
                <li><a href="index.php?action=servicios">Servicios</a></li>
                <li><a href="index.php?action=contactanos">Contactanos</a></li>
                <?php
                if($_SESSION["logueado"]){
                    echo('<li><a href="index.php?action=salir">Cerrar Sesion</a></li>');
                }else{
                    echo('<li><a href="index.php?action=login">Iniciar Sesion</a></li>');
                }
                ?>
        </ul>
    </nav>
    <?php
                require_once "controllers/controller.php";
                require_once "models/model.php";
                $mvc=new MvcController();
                $mvc->enlacesPaginasController();
            ?>
    

    <footer> derechos reservados by @yo</footer>

    
</body>

</html>