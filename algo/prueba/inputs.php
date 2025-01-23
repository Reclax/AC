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
<form action="calcular.php" method="post">

<input type="hidden" id="cantidad" name="cantidad" value="<?php echo($_POST['cantidad'])?>">
<?php
for ($i=0; $i<$_POST['cantidad'] ; $i++) { 
    echo("<p>Ingrese Numero ".($i+1)."</p>");
    echo("<input type=\"number\" id=\"numero".$i."\" name=\"numero".$i."\">");
    echo("<br>");
}
?>
<button type="submit">Enviar</button>
</form>


    <a href="cerrar.php">Cerrar Sesion</a>
</body>
</html>