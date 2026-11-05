<?php

$tipos_trabajador = array(
    'e'=>'Estudiante',
    'c'=>'Contratista'
);

$tipos_documento = array(
    'cc'=>'Cédula de ciudadanía',
    'ce'=>'Cédula extranjera'
);

$users_file = file_get_contents('../data/db/users.json');
$users_file_data = json_decode($users_file,true);

$courses_file = file_get_contents('../data/db/courses.json');
$courses_file_data = json_decode($courses_file,true);

$courses_users_file = file_get_contents('../data/db/courses_users.json');
$courses_users_file_data = json_decode($courses_users_file,true);


if(isset($_GET['action'])){
    $action = $_GET['action'];

    if($action=='getUsersByCourse'){
        $course_id = (int)$_POST['courseid'];
        $usuarios = array();
        foreach($courses_users_file_data as $cu){
            if($cu['id']==$course_id){
                $course_users = $cu['users'];
                foreach($course_users as $cu2){
                    $indx = array_search($cu2['id'], array_column($users_file_data,'id'));
                    if ($indx !== false) {
                        $user_data = $users_file_data[$indx];
                        array_push($usuarios,array(
                            'tipou'=>$tipos_trabajador[$user_data['tipou']],
                            'nombre'=>$user_data['nombre'],
                            'apellido'=>$user_data['apellido'],
                            'documento'=>$user_data['documento'],
                            'ciudad'=>$user_data['ciudad'],
                            'empresa'=>$user_data['empresa'],
                            'correo'=>$user_data['correo'],
                            'estado'=>$cu2['status']
                        ));
                    }
                }
                break;
            }
        }
        
        exit('{"status":"success","data":'.json_encode($usuarios).'}');
    }else if($action=='getCoursesByUser'){
        $user_id = (int)$_POST['userid'];
        $courses = array();
        foreach($courses_users_file_data as $cu){
            foreach($cu['users'] as $cu_u){
                if($cu_u['id']==$user_id){
                    array_push($courses,array(
                        'id'=>$cu['id'],
                        'nombre'=>'',
                        'status'=>$cu_u['status'],
                        'horaentrada'=>$cu_u['horaentrada'],
                        'horasalida'=>$cu_u['horasalida']
                    ));
                    break;
                }
            }
        }

        foreach($courses as $indx => $c){
            foreach($courses_file_data as $cfd){
                if($c['id']==$cfd['id']){
                    $courses[$indx]['nombre'] = $cfd['nombre'];
                }
            }
        }

        exit('{"status":"success","data":'.json_encode($courses).'}');
    }
}else{
    exit('{"status":"error","data":"action not defined"}');
}