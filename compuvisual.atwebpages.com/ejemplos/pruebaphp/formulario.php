<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="funciones.php" method="post">
        
<?php
$cantidad=$_POST["cantidad"];
for($i=0;$i<$cantidad;$i++){
    echo('
    <label for="numero'.$i.'">Ingrese el numero '.($i+1).'</label>
    <input type="text" id="numero'.$i.'" name="numero'.$i.'"><br>
    ');
}
echo('
    <input type="hidden" id=cantidad" name="cantidad" value='.$cantidad.'>
    <button type="submit">Ingresar</button>
');
?>

    </form>
</body>
</html>