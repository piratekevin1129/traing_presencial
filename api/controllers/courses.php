<?php

$headquarters_file = file_get_contents('../../data/db/headquarters.json');
$headquarters_file_data = json_decode($headquarters_file,true);

$rooms_file = file_get_contents('../../data/db/rooms.json');
$rooms_file_data = json_decode($rooms_file,true);

$teachers_file = file_get_contents('../../data/db/teachers.json');
$teachers_file_data = json_decode($teachers_file,true);

$courses_file = file_get_contents('../../data/db/courses.json');
$courses_file_data = json_decode($courses_file,true);

$meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

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
    }else if($action=='initiateCourse'){
        $courses_ids = array_column($courses_file_data, 'id');
        $course_data_ind = array_search((int)$_POST['courseid'], $courses_ids);

        if($course_data_ind !== false){
            $courses_file_data[$course_data_ind]['status'] = 1;
            $courses_file_txt = json_encode($courses_file_data);

            if(file_put_contents('../../data/db/courses.json',$courses_file_txt)){
                //devolver el link
                exit('{"status":"success","data":""}');
            }else{
                exit('{"status":"error","data":"error confirmando el inicio"}');
            }
        }else{
            exit('{"status":"error","data":"no se encontró el curso"}');
        }
    }else if($action=='finishCourse'){
        $courses_ids = array_column($courses_file_data, 'id');
        $course_data_ind = array_search((int)$_POST['courseid'], $courses_ids);

        if($course_data_ind !== false){
            $courses_file_data[$course_data_ind]['status'] = 2;
            $courses_file_txt = json_encode($courses_file_data);

            if(file_put_contents('../../data/db/courses.json',$courses_file_txt)){
                //devolver el link
                exit('{"status":"success","data":""}');
            }else{
                exit('{"status":"error","data":"error confirmando la salida"}');
            }
        }else{
            exit('{"status":"error","data":"no se encontró el curso"}');
        }
    }else if($action=='saveCourses'){
        //mirar si trae copias
        $charlas_data = json_decode($_POST['charlas'],true);
        $descripcion_curso = $_POST['descripcion'];
        $tiempo_curso = (int)$_POST['tiempo'];
        $tiempo2_curso = $_POST['tiempo2'];
        $encargados_curso = json_decode($_POST['encargados'],true);
        $img = "";
        
        $initial_id = count($courses_file_data);
        $ids_collection = array();

        $img = $initial_id+1;
        
        foreach($charlas_data as $charla_data){
            $id_curso = ($initial_id+1);
            $nombre_curso = $_POST['nombre'];
            
            $ano = $charla_data['ano'];
            
            $mes1 = $charla_data['mes']+1;
            $mes = $mes1;
            if($mes1<10){
                $mes = '0'.$mes1;
            }
            
            $fecha1 = $charla_data['fecha'];
            $fecha = $fecha1;
            if($fecha1<10){
                $fecha = '0'.$fecha1;
            }

            $minutos1 = $charla_data['minutos'];
            $minutos = $minutos1;
            if($minutos1<10){
                $minutos = '0'.$minutos1;
            }
                
            $hora1 = $charla_data['hora'];
            $horario = $charla_data['horario'];
            if($horario=='pm'){
                $hora1+=12;
            }
            $hora = $hora1;
            if($hora1<10){
                $hora = '0'.$hora1;
            }

            $fecha_curso = $fecha.' de '.$meses[$charla_data['mes']].' de '.$ano.' - '.$hora.':'.$minutos.' '.$horario;
            $fechaformat_curso = $ano.'-'.$mes.'-'.$fecha.' '.$hora.':'.$minutos.':00';
            $sedeid_curso = (int)$charla_data['sede'];
            $aulaid_curso = (int)$charla_data['aula'];
            $facilitadorid_curso = (int)$charla_data['facilitador'];

            if(count($charlas_data)>1){
                //hay copias
                $nombre_curso.=' - '.$fecha.' de '.$meses[$charla_data['mes']];
            }

            array_push($courses_file_data,array(
                'id'=>$id_curso,
                'nombre'=>$nombre_curso,
                'descripcion'=>$descripcion_curso,
                'img'=>(string)$img,
                'fecha'=>$fecha_curso,
                'fechaformat'=>$fechaformat_curso,
                'sedeid'=>$sedeid_curso,
                'aulaid'=>$aulaid_curso,
                'facilitadorid'=>$facilitadorid_curso,
                'status'=>0,
                'tiempo'=>$tiempo_curso,
                'tiempo2'=>$tiempo2_curso,
                'encargados'=>$encargados_curso
            ));

            array_push($ids_collection,$id_curso);
            $initial_id++;
        }
        
        $courses_file_txt = json_encode($courses_file_data);
        if(file_put_contents('../../data/db/courses.json',$courses_file_txt)){
            //devolverle ids de los cursos para guardar los estudiantes
            exit('{"status":"success","data":'.json_encode($ids_collection).'}');
        }else{
            exit('{"status":"error","data":"error guardando el curso"}');
        }
    }else if($action=='saveCoursesImage'){
        if(
            isset($_FILES['curso-img']) &&
            $_FILES['curso-img']['error'] === UPLOAD_ERR_OK &&
            isset($_POST['curso-ids'])
        ) {
            //$ids = array_map('trim',explode(",",json_decode($_POST['curso-ids'])));
            $ids = $_POST['curso-ids'];
            $img_name = 'thumbnail';
                        
            $img_folder = '../../public/cursos/'.$ids.'/';

            if (!file_exists($img_folder)) {
                mkdir($img_folder, 0777, true);
            }
                
            $img_nombre = $_FILES['curso-img']['name'];
            $img_ext = pathinfo($img_nombre, PATHINFO_EXTENSION);
            
            $img_fullname = $img_name.'.'. $img_ext;
            $img_final = $img_folder.$img_fullname;
                
            if (move_uploaded_file($_FILES['curso-img']['tmp_name'], $img_final)) {
                exit('{"status":"success","data":""}');
            } else {
                exit('{"status":"error","data":"no se pudo guardar la imagen"}');
            }
        } else {
            exit('{"status":"error","data":"no se encontraron los datos para guardar la imagen"}');
        }
    }else if($action=='getQRByCourse'){
        
    }
}else{
    exit('{"status":"error","data":"action not defined"}');
}