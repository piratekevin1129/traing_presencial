<?php 
$tipos_trabajador = array(
    'e'=>'Estudiante',
    'c'=>'Contratista'
);

$tipos_documento = array(
    'cc'=>'Cédula de ciudadanía',
    'ce'=>'Cédula extranjera'
);

$users_file = file_get_contents((__DIR__).'/db/users.json');
$users_file_data = json_decode($users_file,true);

$users = array();

foreach($users_file_data as $ud){
    array_push($users,array(
        'id'=>$ud['id'],
        'tipou'=>$ud['tipou'],
        'nombre'=>$ud['nombre'],
        'apellido'=>$ud['apellido'],
        'tipod'=>$ud['tipod'],
        'documento'=>$ud['documento'],
        'ciudad'=>$ud['ciudad'],
        'empresa'=>$ud['empresa'],
        'correo'=>$ud['correo']
    ));
}

?>