<?php 

$headquarters_file = file_get_contents(__DIR__.'/db/headquarters.json');
$headquarters_file_data = json_decode($headquarters_file,true);

$headquarters = array();

foreach($headquarters_file_data as $hd){
    array_push($headquarters,array(
        'id'=>$hd['id'],
        'nombre'=>$hd['nombre'],
        'departamento'=>$hd['departamento'],
        'ciudad'=>$hd['ciudad'],
        'direccion'=>$hd['direccion'],
        'aulas'=>[]
    ));
}

?>