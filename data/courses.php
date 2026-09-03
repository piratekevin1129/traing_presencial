<?php 
$courses = array(
    array(
        'id'=>1,
        'nombre'=>'Inducción - Energías Renovables (hidráulica- eólica- fotovoltaica)',
        'img'=>'thumbnail-1.jpg',
        'fecha'=>'12 de Julio de 2026 - 8:00pm',
        'sede'=>'Sede Hospital',
        'ubicacion'=>'Cra 57a #54a 14, Hospital Rosalpi, piso 2',
        'facilitador'=>'Natasha Gaviria',
        'registrados'=>20,
        'certificados'=>18,
        'inactivos'=>2
    ),
    array(
        'id'=>2,
        'nombre'=>'Reconociendo algunas serpientes venenosas presentes en Colombia',
        'img'=>'thumbnail-2.jpg',
        'fecha'=>'18 de Diciembre de 2026 - 1:00pm',
        'sede'=>'Sede Parque',
        'ubicacion'=>'Cra 57a #54a 14, al frente de la iglesia',
        'facilitador'=>'Silvia Anacona',
        'registrados'=>20,
        'certificados'=>18,
        'inactivos'=>2
    ),
    array(
        'id'=>3,
        'nombre'=>'Módulo 1: Fundamentos de los Derechos Humanos y Derecho Internacional Humanitario',
        'img'=>'thumbnail-3.jpg',
        'fecha'=>'29 de Noviembre de 2026 - 9:00am',
        'sede'=>'Sede Diamante',
        'ubicacion'=>'Cra 57a #54a 14, centro comercial, piso 3',
        'facilitador'=>'Kevin Gaviria',
        'registrados'=>20,
        'certificados'=>18,
        'inactivos'=>2
    )
);

function findCourse($id){
    global $courses;
    $ind = 0;
    foreach($courses as $c=>$course){
        if($course['id']==$id){
            $ind = $c;
        }
    }
    return $ind;
}
?>