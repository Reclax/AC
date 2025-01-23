<?php
session_start();
if (isset($_SESSION["activo"]) && $_SESSION["activo"]){
    header("Location: home.php");
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="entrar.php" method="post">
        <input type="text" id="usuario" name="usuario">
        <input type="text" id="clave" name="clave">
        <button type="submit">Iniciar Sesion</button>
        <?php
        if(isset($_GET["error"])){
            echo("<p>Usuario o Contraseña Incorrectos </p>");
        }
        ?>
    </form>
</body>
</html>