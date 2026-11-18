<?php
require('../env.php');

$tipos_documento_t = array(
    'cc'=>'Cédula de ciudadanía',
    'ce'=>'Cédula extranjera'
);

$teachers_file = file_get_contents('../../data/db/teachers.json');
$teachers_file_data = json_decode($teachers_file,true);

if(isset($_GET['action'])){
    $action = $_GET['action'];

    if($action=='saveTeachers'){
        $datos = json_decode($_POST['teachers'],true);
        //verificar si existe
        $teachers_docs = array_column($teachers_file_data, 'documento');
        
        $current_id = 0;
        if(count($teachers_file_data)>0){
            $current_id = (int)$teachers_file_data[count($teachers_file_data)-1]['id'];
        }
        $new_id = ($current_id+1);
        $ids_collection = array();

        foreach($datos as $d){
            $teachers_ind = array_search((string)$d['documento'], $teachers_docs);
            if($teachers_ind===false){
                $date = new DateTime('now', new DateTimeZone('America/Bogota'));
                $fecha = $date->format('Y-m-d H:i:s');
                array_push($teachers_file_data,array(
                    'id'=>$new_id,
                    'nombre'=>$d['nombre'],
                    'apellido'=>$d['apellido'],
                    'tipod'=>$d['tipo_documento'],
                    'documento'=>(string)$d['documento'],
                    'ciudad'=>$d['ciudad'],
                    'empresa'=>$d['empresa'],
                    'correo'=>$d['correo_electronico'],
                    'fecharegistro'=>$fecha,
                    'status'=>0
                ));
                array_push($ids_collection,$new_id);
                $new_id++;
            }else{
                $teachers_file_data[$teachers_ind]['nombre'] = $d['nombre'];
                $teachers_file_data[$teachers_ind]['apellido'] = $d['apellido'];
                $teachers_file_data[$teachers_ind]['tipod'] = $d['tipo_documento'];
                $teachers_file_data[$teachers_ind]['documento'] = (string)$d['documento'];
                $teachers_file_data[$teachers_ind]['ciudad'] = $d['ciudad'];
                $teachers_file_data[$teachers_ind]['empresa'] = $d['empresa'];
                $teachers_file_data[$teachers_ind]['correo'] = $d['correo_electronico'];
                $teachers_file_data[$teachers_ind]['status'] = 0;
                array_push($ids_collection,$teachers_file_data[$teachers_ind]['id']);
            }
        }

        $teachers_file_txt = json_encode($teachers_file_data);
        if(file_put_contents($path.'data/db/teachers.json',$teachers_file_txt)){
            exit('{"status":"success"}');
        }else{
            exit('{"status":"error","data":"error guardando el archivo"}');
        }
    }else if($action=='updateTeachers'){
        if(isset($_POST['teachers'])){
            $teachers_data = json_decode($_POST['teachers'],true);

            foreach($teachers_data as $t){
                $indx = -1;
                foreach($teachers_file_data as $ind => $td){
                    if($td['id']==$t['id']){
                        $indx = $ind;
                        break;
                    }
                }

                if($indx!=-1){
                    $teachers_file_data[$indx]['nombre'] = $t['nombre'];
                    $teachers_file_data[$indx]['apellido'] = $t['apellido'];
                    $teachers_file_data[$indx]['tipod'] = $t['tipo_documento'];
                    $teachers_file_data[$indx]['documento'] = (string)$t['documento'];
                    $teachers_file_data[$indx]['ciudad'] = $t['ciudad'];
                    $teachers_file_data[$indx]['empresa'] = $t['empresa'];
                    $teachers_file_data[$indx]['correo'] = $t['correo_electronico'];
                }
            }

            $teachers_file_txt = json_encode($teachers_file_data);
            if(file_put_contents($path.'data/db/teachers.json',$teachers_file_txt)){
                exit('{"status":"success"}');
            }else{
                exit('{"status":"error","data":"error guardando el archivo"}');
            }
        }else{
            exit('{"status":"error","data":"no hay datos de los facilitadores"}');
        }
    }else if($action=='deleteTeacher'){
        //buscar indice
        $indx = -1;
        foreach($teachers_file_data as $ind => $td){
            if($td['id']==$_POST['id']){
                $indx = $ind;
                break;
            }
        }

        if($indx!=-1){
            $teachers_file_data[$indx]['status'] = 1;
            //array_splice($teachers_file_data,$indx,1);
        }

        $teachers_file_txt = json_encode($teachers_file_data);
        if(file_put_contents($path.'data/db/teachers.json',$teachers_file_txt)){
            exit('{"status":"success"}');
        }else{
            exit('{"status":"error","data":"error guardando el archivo"}');
        }
    }else{
        exit('{"status":"error","data":"action not found"}');    
    }
}else{
    exit('{"status":"error","data":"action not defined"}');
}