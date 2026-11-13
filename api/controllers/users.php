<?php

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

if(isset($_GET['action'])){
    $action = $_GET['action'];

    if($action=='getUser'){
        $users_ids = array_column($users_file_data, 'id');
        $user_ind = array_search((int)$_POST['userid'], $users_ids);

        if ($user_ind !== false) {
            exit('{"status":"success","data":'.json_encode($users_file_data[$user_ind]).'}');
        } else {
            exit('{"status":"error","data":"No se encontró información del usuario"}');
        }
    }else if($action=='saveUsers'){
        if(isset($_POST['users'])){
            $datos = json_decode($_POST['users'],true);
            //verificar si existe
            $users_docs = array_column($users_file_data, 'documento');

            $current_id = 0;
            if(count($users_file_data)>0){
                $current_id = (int)$users_file_data[count($users_file_data)-1]['id'];
            }
            $new_id = ($current_id+1);
            $ids_collection = array();

            foreach($datos as $d){
                $users_ind = array_search((string)$d['documento'], $users_docs);
                if($users_ind===false){
                    array_push($users_file_data,array(
                        'id'=>$new_id,
                        'tipou'=>$d['tipo_trabajador'],
                        'nombre'=>$d['nombre'],
                        'apellido'=>$d['apellido'],
                        'tipod'=>$d['tipo_documento'],
                        'documento'=>(string)$d['documento'],
                        'ciudad'=>$d['ciudad'],
                        'empresa'=>$d['empresa'],
                        'correo'=>$d['correo_electronico']
                    ));
                    array_push($ids_collection,$new_id);
                    $new_id++;
                }else{
                    $users_file_data[$users_ind]['tipou'] = $d['tipo_trabajador'];
                    $users_file_data[$users_ind]['nombre'] = $d['nombre'];
                    $users_file_data[$users_ind]['apellido'] = $d['apellido'];
                    $users_file_data[$users_ind]['tipod'] = $d['tipo_documento'];
                    $users_file_data[$users_ind]['documento'] = (string)$d['documento'];
                    $users_file_data[$users_ind]['ciudad'] = $d['ciudad'];
                    $users_file_data[$users_ind]['empresa'] = $d['empresa'];
                    $users_file_data[$users_ind]['correo_electronico'] = $d['correo_electronico'];
                    array_push($ids_collection,$users_file_data[$users_ind]['id']);
                }
            }
            $users_file_txt = json_encode($users_file_data);
            if(file_put_contents('../../data/db/users.json',$users_file_txt)){
                exit('{"status":"success","data":'.json_encode($ids_collection).'}');
            }else{
                exit('{"status":"error","data":"error guardando el archivo"}');
            }
        }else{
            exit('{"status":"error","data":"no hay datos de los usuarios"}');
        }
    }else if($action=='updateUsers'){
        if(isset($_POST['users'])){
            $users_ids = json_decode($_POST['users'],true);

            foreach($users_ids as $u){
                $indx = -1;
                foreach($users_file_data as $ind => $ud){
                    if($ud['id']==$u){
                        $indx = $ind;
                        break;
                    }
                }
    
                if($indx!=-1){
                    $users_file_data[$indx] = array(
                        'tipou'=>$u['tipo_trabajador'],
                        'nombre'=>$u['nombre'],
                        'apellido'=>$u['apellido'],
                        'tipod'=>$u['tipo_documento'],
                        'documento'=>$u['documento'],
                        'ciudad'=>$u['ciudad'],
                        'empresa'=>$u['empresa'],
                        'correo'=>$u['correo_electronico']
                    );
                }
            }
    
            $users_file_txt = json_encode($users_file_data);
            if(file_put_contents('../../data/db/users.json',$users_file_txt)){
                exit('{"status":"success"}');
            }else{
                exit('{"status":"error","data":"error guardando el archivo"}');
            }
        }else{
            exit('{"status":"error","data":"no hay datos de los usuarios"}');
        }
    }else if($action=='deleteUser'){
        //buscar indice
        $indx = -1;
        foreach($users_file_data as $ind => $ud){
            if($ud['id']==$_POST['id']){
                $indx = $ind;
            }
        }

        if($indx!=-1){
            array_splice($users_file_data,$indx,1);
        }

        $users_file_txt = json_encode($users_file_data);
        if(file_put_contents('../../data/db/users.json',$users_file_txt)){
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