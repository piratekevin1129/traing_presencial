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
        if(isset($_POST['courseid'])){
            //buscar cédula del usuario
            $student_data = array();
            $students_ids = array_column($users_file_data, 'documento');
            $student_ind = array_search((int)$_POST['cedula'], $students_ids);

            //buscar matriculados del curso
            $courses_users_ids = array_column($courses_users_file_data, 'id');
            $course_users_ind = array_search((int)$_POST['courseid'], $courses_users_ids);

            if($student_ind !== false && $course_users_ind !== false) {
                $student_data = $users_file_data[$student_ind];
                $courses_users_data = $courses_users_file_data[$course_users_ind];

                $usuario_registrado = false;
                foreach($courses_users_data['users'] as $cu_u){
                    if($student_data['id']==$cu_u['id']){
                        $usuario_registrado = true;
                        break;
                    }
                }
                
                if($usuario_registrado){
                    $_SESSION['user_id'] = $student_data['id'];
                    $_SESSION['name'] = $student_data['nombre']." ".$student_data['apellido'];
                    $_SESSION['document'] = $student_data['documento'];
                    $_SESSION['course_id'] = $_POST['courseid'];
                }
                
                exit('{"status":"success","data":'.json_encode($student_data).'}');
            } else {
                exit('{"status":"error","data":"No se encontró el usuario o no está registrado"}');
            }
        }else{
            exit('{"status":"error","data":"curso no definido"}');
        }
    }else{
        if($action=='confirmEntry'||$action=='checkStatus'||$action=='confirmExit'){
            $course_id = $_SESSION['course_id'];
            $student_id = $_SESSION['user_id'];

            //buscar
            $courses_users_ids = array_column($courses_users_file_data, 'id');
            $course_users_ind = array_search((int)$_SESSION['course_id'], $courses_users_ids);

            if($course_users_ind !== false){
                $courses_users_data_ind = -1;
                foreach($courses_users_file_data[$course_users_ind]['users'] as $indx => $cu_u){
                    if($cu_u['id']==$student_id){
                        $courses_users_data_ind = $indx;
                        break;
                    }
                }
                if($courses_users_data_ind>=0){
                    // Formatear la fecha
                    $date = new DateTime('now', new DateTimeZone('America/Bogota'));
                    $fecha = $date->format('Y-m-d');
                    $fecha2 = $date->format('H:i:s');

                    if($action=='confirmEntry'){
                        $courses_users_file_data[$course_users_ind]['users'][$courses_users_data_ind]['status'] = 1;
                        $courses_users_file_data[$course_users_ind]['users'][$courses_users_data_ind]['horaentrada'] = $fecha.' '.$fecha2;

                        $courses_users_file_txt = json_encode($courses_users_file_data);
                        if(file_put_contents('../../data/db/courses_users.json',$courses_users_file_txt)){
                            exit('{"status":"success","data":{"horaentrada":"'.$fecha2.'"}}');
                        }else{
                            exit('{"status":"error","data":"error confirmando el ingreso"}');
                        }
                    }else if($action=='confirmExit'){
                        $courses_users_file_data[$course_users_ind]['users'][$courses_users_data_ind]['status'] = 2;
                        $courses_users_file_data[$course_users_ind]['users'][$courses_users_data_ind]['horasalida'] = $fecha.' '.$fecha2;

                        $courses_users_file_txt = json_encode($courses_users_file_data);
                        if(file_put_contents('../../data/db/courses_users.json',$courses_users_file_txt)){
                            exit('{"status":"success","data":{"horasalida":"'.$fecha2.'"}}');
                        }else{
                            exit('{"status":"error","data":"error confirmando el ingreso"}');
                        }
                    }else if($action=='checkStatus'){
                        $status = $courses_users_file_data[$course_users_ind]['users'][$courses_users_data_ind]['status'];
                        $horaentrada = $courses_users_file_data[$course_users_ind]['users'][$courses_users_data_ind]['horaentrada'];
                        $horasalida = $courses_users_file_data[$course_users_ind]['users'][$courses_users_data_ind]['horasalida'];
                        $horaentrada2 = '';
                        if(!empty($horaentrada)){
                            $horaentrada2 = explode(" ",$horaentrada)[1];
                        }
                        $horasalida2 = '';
                        if(!empty($horasalida)){
                            $horasalida2 = explode(" ",$horasalida)[1];
                        }
                        
                        exit('{"status":"success","data":'.json_encode(array('status'=>$status,'horaentrada'=>$horaentrada2,'horasalida'=>$horasalida2)).'}');
                    }
                }else{
                    exit('{"status":"error","data":"usuario no encontrado '.$courses_users_data_ind.'"}');
                }
            }else{
                exit('{"status":"error","data":"curso no encontrado"}');
            }
        }else{
            exit('{"status":"error","data":"action not found"}');    
        }
    }
}else{
    exit('{"status":"error","data":"action not defined"}');
}