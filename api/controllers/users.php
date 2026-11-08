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
    }
    else if($action=='saveUser'){
        $current_id = (int)$users_file_data[count($users_file_data)-1]['id'];
        $new_id = ($current_id+1);
        array_push($users_file_data,array(
            'id'=>$new_id,
            'tipou'=>$_POST['tipou'],
            'nombre'=>$_POST['nombre'],
            'apellido'=>$_POST['apellido'],
            'tipod'=>$_POST['tipod'],
            'documento'=>$_POST['documento'],
            'ciudad'=>$_POST['ciudad'],
            'empresa'=>$_POST['empresa'],
            'correo'=>$_POST['correo']
        ));

        $users_file_txt = json_encode($users_file_data);
        if(file_put_contents('../data/db/users.json',$users_file_txt)){
            exit('{"status":"success"}');
        }else{
            exit('{"status":"error","data":"error guardando el archivo"}');
        }
    }
    else if($action=='updateUser'){
        //buscar indice
        $indx = -1;
        foreach($users_file_data as $ind => $ud){
            if($ud['id']==$_POST['id']){
                $indx = $ind;
            }
        }

        if($indx!=-1){
            $users_file_data[$indx] = array(
                'id'=>$_POST['id'],
                'tipou'=>$_POST['tipou'],
                'nombre'=>$_POST['nombre'],
                'apellido'=>$_POST['apellido'],
                'tipod'=>$_POST['tipod'],
                'documento'=>$_POST['documento'],
                'ciudad'=>$_POST['ciudad'],
                'empresa'=>$_POST['empresa'],
                'correo'=>$_POST['correo']
            );
        }

        $users_file_txt = json_encode($users_file_data);
        if(file_put_contents('../data/db/users.json',$users_file_txt)){
            exit('{"status":"success"}');
        }else{
            exit('{"status":"error","data":"error guardando el archivo"}');
        }
    }
    else if($action=='deleteUser'){
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
        if(file_put_contents('../data/db/users.json',$users_file_txt)){
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