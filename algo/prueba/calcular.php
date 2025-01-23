<?php
echo "Array Invertido";
echo "<br>";
for ($i = $_POST['cantidad']-1; $i >= 0; $i--) {
    echo $_POST['numero'. $i] ;
    echo "<br>";
}

echo "promedio";
echo "<br>";
$promedio=0;
for ($i = $_POST['cantidad']-1; $i >= 0; $i--) {
    $promedio=$promedio+$_POST['numero'. $i] ;
}

echo ($promedio/$_POST['cantidad']);
?>