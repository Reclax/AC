<?php
session_start();
if (!$_SESSION["activo"]){
    header("Location: index.php");
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
    <h1>hola</h1>

    <form action="inputs.php" method="post">
        <input type="number" id="cantidad" name="cantidad">
        <button type="submit">Enviar</button>
    </form>

    <a href="cerrar.php">Cerrar Sesion</a>
</body>
</html>