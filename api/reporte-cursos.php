<?php 
$headquarters_file = file_get_contents('../data/db/headquarters.json');
$headquarters_file_data = json_decode($headquarters_file,true);

$rooms_file = file_get_contents('../data/db/rooms.json');
$rooms_file_data = json_decode($rooms_file,true);

$teachers_file = file_get_contents('../data/db/teachers.json');
$teachers_file_data = json_decode($teachers_file,true);

$courses_file = file_get_contents('../data/db/courses.json');
$courses_file_data = json_decode($courses_file,true);

$courses_users_file = file_get_contents('../data/db/courses_users.json');
$courses_users_file_data = json_decode($courses_users_file,true);

//////////////////////////////

$filename = "reporte_".date('Y-m-d').".xls";
/*header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Cache-Control: max-age=0");
echo "\xEF\xBB\xBF";*/

foreach($courses_file_data as $curso_data){
    $curso_data['usuarios'] = 0;
    $curso_data['ingresos'] = 0;
    $curso_data['salidas'] = 0;

    $courses_users_ids = array_column($courses_users_file_data, 'id');
    $courses_users_ind = array_search((int)$curso_data['id'], $courses_users_ids);

    if($courses_users_ind>-1){
        $courses_users_data = $courses_users_file_data[$courses_users_ind];
        $ingresos = 0;
        $salidas = 0;

        foreach($courses_users_data['users'] as $cud){
            if($cud['status']==1){
                $ingresos++;
            }else if($cud['status']==2){
                $ingresos++;
                $salidas++;
            }
        }
        $total_usuarios = count($courses_users_data['users']);
        $curso_data['usuarios'] = $total_usuarios;
        $curso_data['ingresos'] = $ingresos;
        $curso_data['salidas'] = $salidas;
    }

    foreach($teachers_file_data as $t){
        if($t['id']==$curso_data['facilitadorid']){
            $curso_data['facilitador'] = $t['nombre'].' '.$t['apellido'];
            break;
        }
    }

    foreach($headquarters_file_data as $h){
        if($h['id']==$curso_data['sedeid']){
            $curso_data['sede'] = $h['nombre'];
            $curso_data['direccion'] = $h['direccion'];
            break;
        }
    }

    foreach($rooms_file_data as $r){
        if($r['id']==$curso_data['aulaid']){
            $curso_data['aula'] = $r['nombre'];
            break;
        }
    }

    $fecha_format = explode(' ',$curso_data['fechaformat']);
    $fecha = $fecha_format[0];
    $hora = $fecha_format[1];

    $html = '';

    $html.='<table style="font-family: Arial;" border="1" cellspacing="0">';
        $html.='<tr>';
            $html.='<td bgcolor="#FAFFE5">Id</td>';
            $html.='<td bgcolor="#FAFFE5">Nombre</td>';
            $html.='<td bgcolor="#FAFFE5">Descripcion</td>';
            $html.='<td bgcolor="#FAFFE5">Usuarios matriculados</td>';
            $html.='<td bgcolor="#FAFFE5">Ingresos</td>';
            $html.='<td bgcolor="#FAFFE5">Salidas</td>';
            $html.='<td bgcolor="#FAFFE5">Facilitador</td>';
            $html.='<td bgcolor="#FAFFE5">Fecha</td>';
            $html.='<td bgcolor="#FAFFE5">Hora</td>';
            $html.='<td bgcolor="#FAFFE5">Hora de inicio</td>';
            $html.='<td bgcolor="#FAFFE5">Hora de salida</td>';
            $html.='<td bgcolor="#FAFFE5">Sede</td>';
            $html.='<td bgcolor="#FAFFE5">Aula</td>';
            $html.='<td bgcolor="#FAFFE5">Dirección</td>';
        $html.='</tr>';
        $html.='<tr>';
            $html.='<td>'.$curso_data['id'].'</td>';
            $html.='<td>'.$curso_data['nombre'].'</td>';
            $html.='<td>'.$curso_data['descripcion'].'</td>';
            $html.='<td>'.$curso_data['usuarios'].'</td>';
            $html.='<td>'.$curso_data['ingresos'].'</td>';
            $html.='<td>'.$curso_data['salidas'].'</td>';
            $html.='<td>'.$curso_data['facilitador'].'</td>';
                
            $html.='<td>'.$fecha.'</td>';
            $html.='<td>'.$hora.'</td>';
            $html.='<td>'.$curso_data['inicio'].'</td>';
            $html.='<td>'.$curso_data['fin'].'</td>';
            $html.='<td>'.$curso_data['sede'].'</td>';
            $html.='<td>'.$curso_data['aula'].'</td>';
            $html.='<td>'.$curso_data['direccion'].'</td>';
        $html.='</tr>';
    $html.='</table>';

    echo $html;
}

?>