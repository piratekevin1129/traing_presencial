<?php

$headquarters_file = file_get_contents('../../data/db/headquarters.json');
$headquarters_file_data = json_decode($headquarters_file,true);

$rooms_file = file_get_contents('../../data/db/rooms.json');
$rooms_file_data = json_decode($rooms_file,true);

if(isset($_GET['action'])){
    $action = $_GET['action'];

    if($action=='saveHeadquarters'){
        if(isset($_POST['headquarters'])){
            $datos = json_decode($_POST['headquarters'],true);
            //verificar si existe
            $headquarters_names = array_column($headquarters_file_data, 'nombre');

            $current_id = 0;
            if(count($headquarters_file_data)>0){
                $current_id = (int)$headquarters_file_data[count($headquarters_file_data)-1]['id'];
            }
            $new_id = ($current_id+1);
            $ids_collection = array();

            foreach($datos as $d){
                $headquarters_ind = array_search((string)$d['nombre'], $headquarters_names);
                if($headquarters_ind===false){
                    
                    array_push($headquarters_file_data,array(
                        'id'=>$new_id,
                        'nombre'=>$d['nombre'],
                        'departamento'=>$d['departamento'],
                        'ciudad'=>$d['ciudad'],
                        'direccion'=>$d['direccion']
                    ));
                    array_push($ids_collection,$new_id);
                    $new_id++;
                }else{
                    $headquarters_file_data[$headquarters_ind]['departamento'] = $d['departamento'];
                    $headquarters_file_data[$headquarters_ind]['ciudad'] = $d['ciudad'];
                    $headquarters_file_data[$headquarters_ind]['direccion'] = $d['direccion'];
                    array_push($ids_collection,$headquarters_file_data[$headquarters_ind]['id']);
                }
            }
            $headquarters_file_txt = json_encode($headquarters_file_data);
            if(file_put_contents('../../data/db/headquarters.json',$headquarters_file_txt)){
                exit('{"status":"success","data":'.json_encode($ids_collection).'}');
            }else{
                exit('{"status":"error","data":"error guardando el archivo"}');
            }
        }else{
            exit('{"status":"error","data":"no hay datos de las sedes"}');
        }
    }else if($action=='updateHeadquarters'){
        if(isset($_POST['headquarters'])){
            $headquarters_data = json_decode($_POST['headquarters'],true);

            foreach($headquarters_data as $h){
                $indx = -1;
                foreach($headquarters_file_data as $ind => $hd){
                    if($hd['id']==$h['id']){
                        $indx = $ind;
                        break;
                    }
                }
    
                if($indx!=-1){
                    $headquarters_file_data[$indx]['nombre'] = $h['nombre'];
                    $headquarters_file_data[$indx]['departamento'] = $h['departamento'];
                    $headquarters_file_data[$indx]['ciudad'] = $h['ciudad'];
                    $headquarters_file_data[$indx]['direccion'] = $h['direccion'];
                }
            }
    
            $headquarters_file_txt = json_encode($headquarters_file_data);
            if(file_put_contents('../../data/db/headquarters.json',$headquarters_file_txt)){
                exit('{"status":"success"}');
            }else{
                exit('{"status":"error","data":"error guardando el archivo"}');
            }
        }else{
            exit('{"status":"error","data":"no hay datos de las sedes"}');
        }
    }else if($action=='deleteHeadquarter'){
        //buscar indice
        $indx = -1;
        foreach($headquarters_file_data as $ind => $hd){
            if($hd['id']==$_POST['id']){
                $indx = $ind;
            }
        }

        if($indx!=-1){
            array_splice($headquarters_file_data,$indx,1);
            $new_aulas = array();
            foreach($rooms_file_data as $r){
                if($r['sedeid']!=$_POST['id']){
                    array_push($new_aulas,array(
                        'id'=>$r['id'],
                        'nombre'=>$r['nombre'],
                        'extra'=>$r['extra'],
                        'sedeid'=>$r['sedeid']
                    ));
                }
            }
            $continue_sedes = false;
            if(count($new_aulas)==$rooms_file_data){
                //no hay que modificar nada
                $continue_sedes = true;
            }else{
                $rooms_file_txt = json_encode($rooms_file_data);
                if(file_put_contents('../../data/db/rooms.json',$rooms_file_txt)){
                    $continue_sedes = true;
                }
            }

            if($continue_sedes){
                $headquarters_file_txt = json_encode($headquarters_file_data);
                if(file_put_contents('../../data/db/headquarters.json',$headquarters_file_txt)){
                    exit('{"status":"success"}');
                }else{
                    exit('{"status":"error","data":"error guardando el archivo de sedes"}');
                }
            }else{
                exit('{"status":"error","data":"error guardando el archivo de aulas"}');
            }
        }else{
            exit('{"status":"error","data":"no se encontró la sede"}');
        }

    }else{
        exit('{"status":"error","data":"action not found"}');    
    }
}else{
    exit('{"status":"error","data":"action not defined"}');
}