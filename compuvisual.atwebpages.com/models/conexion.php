<?php
class Conexion{
    public function conectar(){
        $servername ="fdb1029.awardspace.net";
        $username = "4572472_compuvisual";
        $password = "!JYTT/8]5+c%n,AD";
        $db = "4572472_compuvisual";
        $conn = mysqli_connect($servername,$username,$password,$db);
        if (!$conn) {
            echo"Error de conexion ".mysqli_connect_error();
        }
        else{
            return $conn;
        }        
    }
}

?>