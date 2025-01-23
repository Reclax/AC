<?php
session_start();
$_SESSION["logueado"]=false;
echo '<script type="text/javascript">';
echo "window.location.href = 'index.php?action=".$_SESSION['action']."';";
echo '</script>';
exit();
?>