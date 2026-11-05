<?php 
$rooms = array(
    array(1,'Aula 1','Sede Molinos','Piso 1 al fondo'),
    array(2,'Aula 1','Sede Punto clave','Piso 2 - al lado de las escaleras'),
    array(3,'Aula 1','Sede Envigado','Torre Norte, Piso 3')
);


$rooms_file = file_get_contents(__DIR__.'/db/rooms.json');
$rooms_file_data = json_decode($rooms_file,true);

$rooms = array();

foreach($rooms_file_data as $rd){
    array_push($rooms,array(
        'id'=>$rd['id'],
        'nombre'=>$rd['nombre'],
        'extra'=>$rd['extra'],
        'sedeid'=>$rd['sedeid'],
        'sede'=>""
    ));
}
?>