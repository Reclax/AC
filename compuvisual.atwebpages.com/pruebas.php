
    <?php
    $json='{
  "nombre":"Jonh Doe",
  "profesion":"Programador",
  "edad":25,
  "lenguajes":["PHP","Javascript","Dart"],
  "disponibilidadParaViajar":true,
  "rangoProfesional": {
      "aniosDeExperiencia": 12,
      "nivel": "Senior"
  }
}';
 $a=3;
 $b="hola";
print_r(gettype($a));
print_r("<br>");
print_r(gettype($b));
print_r("<br>");
$arrayName = array("1","2","3000");
print_r($arrayName[0]);
print_r("<br>");
$jona=array(
    "nombre"=>"Jhonatan",
    "apellido"=>"Lozada",
    "edad"=>22
);
print_r($jona['nombre']);
print_r("<br>");

$jonaObjeto=(object)[
    "nombre"=>"Jhonatan",
    "apellido"=>"Lozada",
    "edad"=>22
];
print_r($jonaObjeto->edad);
print_r("<br>");

$arrayJson= json_decode($json,true);
print_r($arrayJson["nombre"]);
?>

