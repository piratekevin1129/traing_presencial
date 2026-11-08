<?php

session_start();

$tipos_trabajador = array(
    'e'=>'Estudiante',
    'c'=>'Contratista'
);

$tipos_documento = array(
    'cc'=>'Cédula de ciudadanía',
    'ce'=>'Cédula extranjera'
);

$users_file = file_get_contents('../../data/db/users.json');
$users_file_data = json_decode($users_file,true);

$courses_users_file = file_get_contents('../../data/db/courses_users.json');
$courses_users_file_data = json_decode($courses_users_file,true);

if(isset($_GET['action'])){
    $action = $_GET['action'];

    if($action=='login'){
        //buscar cédula del usuario
        $student_data = array();
        $students_ids = array_column($users_file_data, 'documento');
        $student_ind = array_search((int)$_POST['cedula'], $students_ids);

        if(isset($_POST['courseid'])){
            $course_id = $_POST['courseid'];
            if($student_ind !== false) {
                $student_data = $users_file_data[$student_ind];
                $student_courses = array();
                //mirar si tiene cursos asignados
                foreach($courses_users_file_data as $cu){
                    if($cu['id']==$course_id){
                        foreach($cu['users'] as $cu_u){
                            if($student_data['id']==$cu_u['id']){
                                array_push($student_courses,$cu['id']);
                                break;
                            }
                        }
                        break;
                    }
                }
                $student_data['courses'] = $student_courses;
                $_SESSION['user_id'] = $student_data['id'];
                $_SESSION['name'] = $student_data['nombre']." ".$student_data['apellido'];
                $_SESSION['document'] = $student_data['documento'];
                $_SESSION['course_id'] = $_POST['courseid'];
                
                exit('{"status":"success","data":'.json_encode($student_data).'}');
            } else {
                exit('{"status":"error","data":"No se encontró el usuario o no está registrado"}');
            }
        }else{
            exit('{"status":"error","data":"curso no definido"}');
        }
    }else{
        exit('{"status":"error","data":"action not found"}');    
    }
}else{
    exit('{"status":"error","data":"action not defined"}');
}