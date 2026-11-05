<?php 
$tipos_documento_t = array(
    'cc'=>'Cédula de ciudadanía',
    'ce'=>'Cédula extranjera'
);

$teachers_file = file_get_contents(__DIR__.'/db/teachers.json');
$teachers_file_data = json_decode($teachers_file,true);

$teachers = array();

foreach($teachers_file_data as $td){
    array_push($teachers,array(
        'id'=>$td['id'],
        'nombre'=>$td['nombre'],
        'apellido'=>$td['apellido'],
        'tipod'=>$td['tipod'],
        'documento'=>$td['documento'],
        'ciudad'=>$td['ciudad'],
        'empresa'=>$td['empresa'],
        'correo'=>$td['correo']
    ));
}
?>