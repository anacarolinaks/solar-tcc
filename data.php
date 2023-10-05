<?php

//w --> 0 (para domingo) até 6 (para sábado)
//N --> 1 (para Segunda) até 7 (para Domingo)
$data = date("Y-m-d");
$diaSemana = date("N", $data);
$i=0;
//Volta a data até encontrar a segunda
while ($diaSemana > 1) {
     $data = date('Y-m-d', strtotime($data . ' - 1 days'));
     $diaSemana = date("w", strtotime($data));
}

//Exibe os dias da semana após segunda
for($i = 0; $i<5 ; $i++){
     //echo date('Y-m-d', strtotime("$data  +  $i days"))."<br>";
     $data = date('Y-m-d', strtotime("$data  + 1 days"));
     echo "$data <br>";
}

?>
