<?php

$headquarters_file = file_get_contents('../data/db/headquarters.json');
$headquarters_file_data = json_decode($headquarters_file,true);

$rooms_file = file_get_contents('../data/db/rooms.json');
$rooms_file_data = json_decode($rooms_file,true);

$teachers_file = file_get_contents('../data/db/teachers.json');
$teachers_file_data = json_decode($teachers_file,true);

$courses_file = file_get_contents('../data/db/courses.json');
$courses_file_data = json_decode($courses_file,true);


if(isset($_GET['action'])){
    $action = $_GET['action'];

    if($action=='getCourse'){
        $course_id = (int)$_POST['courseid'];
        $course_data = array();

        foreach($courses_file_data as $c){
            if($c['id']==$course_id){
                $course_data = $c;
                break;
            }
        }

        if($course_data!==[]){
            foreach($teachers_file_data as $t){
                if($course_data['facilitadorid']==$t['id']){
                    $course_data['facilitador'] = $t['nombre'].' '.$t['apellido'];
                    break;
                }
            }
            foreach($headquarters_file_data as $h){
                if($course_data['sedeid']==$h['id']){
                    $course_data['sede'] = $h['nombre'];
                    $course_data['direccion'] = $h['direccion'];
                }
            }
            foreach($rooms_file_data as $r){
                if($course_data['aulaid']==$r['id']){
                    $course_data['aula'] = $r['nombre'];
                }
            }
        }
        
        exit('{"status":"success","data":'.json_encode($course_data).'}');
    }
}else{
    exit('{"status":"error","data":"action not defined"}');
}