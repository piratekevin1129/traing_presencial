<?php

$tipos_documento_t = array(
    'cc'=>'Cédula de ciudadanía',
    'ce'=>'Cédula extranjera'
);

$teachers_file = file_get_contents('../../data/db/teachers.json');
$teachers_file_data = json_decode($teachers_file,true);

if(isset($_GET['action'])){
    $action = $_GET['action'];

    if($action=='saveFacilitador'){
        $current_id = (int)$teachers_file_data[count($teachers_file_data)-1]['id'];
        $new_id = ($current_id+1);
        array_push($teachers_file_data,array(
            'id'=>$new_id,
            'nombre'=>$_POST['nombre'],
            'apellido'=>$_POST['apellido'],
            'tipod'=>$_POST['tipod'],
            'documento'=>$_POST['documento'],
            'ciudad'=>$_POST['ciudad'],
            'empresa'=>$_POST['empresa'],
            'correo'=>$_POST['correo']
        ));

        $teachers_file_txt = json_encode($teachers_file_data);
        if(file_put_contents('../../data/db/teachers.json',$teachers_file_txt)){
            exit('{"status":"success"}');
        }else{
            exit('{"status":"error","data":"error guardando el archivo"}');
        }
    }
    else if($action=='updateFacilitador'){
        //buscar indice
        $indx = -1;
        foreach($teachers_file_data as $ind => $td){
            if($td['id']==$_POST['id']){
                $indx = $ind;
            }
        }

        if($indx!=-1){
            $teachers_file_data[$indx] = array(
                'id'=>$_POST['id'],
                'nombre'=>$_POST['nombre'],
                'apellido'=>$_POST['apellido'],
                'tipod'=>$_POST['tipod'],
                'documento'=>$_POST['documento'],
                'ciudad'=>$_POST['ciudad'],
                'empresa'=>$_POST['empresa'],
                'correo'=>$_POST['correo']
            );
        }

        $teachers_file_txt = json_encode($teachers_file_data);
        if(file_put_contents('../../data/db/teachers.json',$teachers_file_txt)){
            exit('{"status":"success"}');
        }else{
            exit('{"status":"error","data":"error guardando el archivo"}');
        }
    }
    else if($action=='deleteFacilitador'){
        //buscar indice
        $indx = -1;
        foreach($teachers_file_data as $ind => $td){
            if($td['id']==$_POST['id']){
                $indx = $ind;
            }
        }

        if($indx!=-1){
            array_splice($teachers_file_data,$indx,1);
        }

        $teachers_file_txt = json_encode($teachers_file_data);
        if(file_put_contents('../../data/db/teachers.json',$teachers_file_txt)){
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