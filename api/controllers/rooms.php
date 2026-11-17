<?php

$rooms_file = file_get_contents('../../data/db/rooms.json');
$rooms_file_data = json_decode($rooms_file,true);

if(isset($_GET['action'])){
    $action = $_GET['action'];

    if($action=='saveRooms'){
        if(isset($_POST['rooms'])){
            $datos = json_decode($_POST['rooms'],true);
            //verificar si existe
            $rooms_names = array_column($rooms_file_data, 'nombre');

            $current_id = 0;
            if(count($rooms_file_data)>0){
                $current_id = (int)$rooms_file_data[count($rooms_file_data)-1]['id'];
            }
            $new_id = ($current_id+1);
            $ids_collection = array();

            foreach($datos as $d){
                $rooms_ind = array_search((string)$d['nombre'], $rooms_names);
                if($rooms_ind===false){
                    
                    array_push($rooms_file_data,array(
                        'id'=>$new_id,
                        'nombre'=>$d['nombre'],
                        'extra'=>$d['extra'],
                        'sedeid'=>(int)$d['sedeid']
                    ));
                    array_push($ids_collection,$new_id);
                    $new_id++;
                }else{
                    $rooms_file_data[$rooms_ind]['extra'] = $d['extra'];
                    $rooms_file_data[$rooms_ind]['sedeid'] = (int)$d['sedeid'];
                    array_push($ids_collection,$rooms_file_data[$rooms_ind]['id']);
                }
            }
            $rooms_file_txt = json_encode($rooms_file_data);
            if(file_put_contents('../../data/db/rooms.json',$rooms_file_txt)){
                exit('{"status":"success","data":'.json_encode($ids_collection).'}');
            }else{
                exit('{"status":"error","data":"error guardando el archivo"}');
            }
        }else{
            exit('{"status":"error","data":"no hay datos de las aulas"}');
        }
    }else if($action=='updateRooms'){
        if(isset($_POST['rooms'])){
            $rooms_data = json_decode($_POST['rooms'],true);

            foreach($rooms_data as $r){
                $indx = -1;
                foreach($rooms_file_data as $ind => $rd){
                    if($rd['id']==$r['id']){
                        $indx = $ind;
                        break;
                    }
                }
    
                if($indx!=-1){
                    $rooms_file_data[$indx]['nombre'] = $r['nombre'];
                    $rooms_file_data[$indx]['extra'] = $r['extra'];
                    $rooms_file_data[$indx]['sedeid'] = (int)$r['sedeid'];
                }
            }
    
            $rooms_file_txt = json_encode($rooms_file_data);
            if(file_put_contents('../../data/db/rooms.json',$rooms_file_txt)){
                exit('{"status":"success"}');
            }else{
                exit('{"status":"error","data":"error guardando el archivo"}');
            }
        }else{
            exit('{"status":"error","data":"no hay datos de las aulas"}');
        }
    }else if($action=='deleteRoom'){
        //buscar indice
        $indx = -1;
        foreach($rooms_file_data as $ind => $hd){
            if($hd['id']==$_POST['id']){
                $indx = $ind;
            }
        }

        if($indx!=-1){
            array_splice($rooms_file_data,$indx,1);
            
            $rooms_file_txt = json_encode($rooms_file_data);
            if(file_put_contents('../../data/db/rooms.json',$rooms_file_txt)){
                exit('{"status":"success"}');
            }else{
                exit('{"status":"error","data":"error guardando el archivo de aulas"}');
            }
            
        }else{
            exit('{"status":"error","data":"no se encontró el aula"}');
        }

    }else{
        exit('{"status":"error","data":"action not found"}');    
    }
}else{
    exit('{"status":"error","data":"action not defined"}');
}