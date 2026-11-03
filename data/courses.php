<?php 

$courses_file = file_get_contents((__DIR__).'/db/courses.json');
$courses_file_data = json_decode($courses_file,true);

$courses = array();

foreach($courses_file_data as $cd){
    array_push($courses,array(
        'id'=>$cd['id'],
        'nombre'=>$cd['nombre'],
        'img'=>$cd['img'],
        'fecha'=>$cd['fecha'],
        'fechaformat'=>$cd['fechaformat'],
        'sede'=>$cd['sede'],
        'aula'=>$cd['aula'],
        'direccion'=>$cd['direccion'],
        'facilitador'=>$cd['facilitador'],
        'registrados'=>0,
        'certificados'=>0
    ));
}

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