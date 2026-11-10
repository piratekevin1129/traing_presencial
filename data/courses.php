<?php 

$courses_file = file_get_contents(__DIR__.'/db/courses.json');
$courses_file_data = json_decode($courses_file,true);

$courses = array();

foreach($courses_file_data as $cd){
    array_push($courses,array(
        'id'=>$cd['id'],
        'nombre'=>$cd['nombre'],
        'descripcion'=>$cd['descripcion'],
        'img'=>$cd['img'],
        'fecha'=>$cd['fecha'],
        'fechaformat'=>$cd['fechaformat'],
        'sedeid'=>$cd['sedeid'],
        'sede'=>"",
        'aulaid'=>$cd['aulaid'],
        'aula'=>"",
        'direccion'=>"",
        'facilitadorid'=>$cd['facilitadorid'],
        'facilitador'=>"",
        'registrados'=>0,
        'certificados'=>0,
        'status'=>$cd['status'],
        'tiempo'=>$cd['tiempo'],
        'tiempo2'=>$cd['tiempo2'],
        'encargados'=>$cd['encargados']
    ));
}

function findCourse($id){
    global $courses;
    $ind = -1;
    foreach($courses as $c=>$course){
        if($course['id']==$id){
            $ind = $c;
            break;
        }
    }
    return $ind;
}
?>