<?php 

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