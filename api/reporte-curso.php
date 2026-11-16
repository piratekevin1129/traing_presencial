<?php 

$courses_file = file_get_contents('../data/db/courses.json');
$courses_file_data = json_decode($courses_file,true);

$users_file = file_get_contents('../data/db/users.json');
$users_file_data = json_decode($users_file,true);

$courses_users_file = file_get_contents('../data/db/courses_users.json');
$courses_users_file_data = json_decode($courses_users_file,true);

//////////////////////////////

if($_GET['course_id']){
    $courses_ids = array_column($courses_file_data, 'id');
    $courses_ind = array_search((int)$_GET['course_id'], $courses_ids);

    $filename = "reporte_curso_".date('Y-m-d').".xls";
    if($courses_ind !== false){
        $filename = "reporte_curso_".$courses_file_data[$courses_ind]['nombre'].".xls";
    }
    /*header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Cache-Control: max-age=0");
    echo "\xEF\xBB\xBF";*/

    $html = '';

    $html.='<table style="font-family: Arial;" border="1" cellspacing="0">';
    $html.='<tr>';
        $html.='<td bgcolor="#FAFFE5">Id</td>';
        $html.='<td bgcolor="#FAFFE5">Nombre completo</td>';
        $html.='<td bgcolor="#FAFFE5">Documento</td>';
        $html.='<td bgcolor="#FAFFE5">Correo electrónico</td>';
        $html.='<td bgcolor="#FAFFE5">Ciudad</td>';
        $html.='<td bgcolor="#FAFFE5">Empresa</td>';
        $html.='<td bgcolor="#FAFFE5">Hora de registro</td>';
        $html.='<td bgcolor="#FAFFE5">Estado</td>';
        $html.='<td bgcolor="#FAFFE5">Hora de entrada</td>';
        $html.='<td bgcolor="#FAFFE5">Hora de salida</td>';
    $html.='</tr>';

    $courses_users_ids = array_column($courses_users_file_data, 'id');
    $courses_users_ind = array_search((int)$_GET['course_id'], $courses_users_ids);

    if($courses_users_ind !== false){
        $lista_usuarios = $courses_users_file_data[$courses_users_ind]['users'];
        
        $users_ids = array_column($users_file_data, 'id');

        foreach($lista_usuarios as $u){
            $users_ind = array_search((int)$u['id'], $users_ids);
    
            if($users_ind !== false){
                $user_data = $users_file_data[$users_ind];
                $html.='<tr>';
                    $html.='<td>'.$user_data['id'].'</td>';
                    $html.='<td>'.$user_data['nombre'].' '.$user_data['apellido'].'</td>';
                    $html.='<td>'.$user_data['documento'].'</td>';
                    $html.='<td>'.$user_data['correo'].'</td>';
                    $html.='<td>'.$user_data['ciudad'].'</td>';
                    $html.='<td>'.$user_data['empresa'].'</td>';
                    $html.='<td>'.$u['horaregistro'].'</td>';
                    if($u['status']==0){
                        $html.='<td>Sin iniciar</td>';
                    }else if($u['status']==1){
                        $html.='<td>Ingresó</td>';
                    }else if($u['status']==2){
                        $html.='<td>Finalizó</td>';
                    }
                    $html.='<td>'.$u['horaentrada'].'</td>';
                    $html.='<td>'.$u['horasalida'].'</td>';
                $html.='</tr>';
            }

        }

    $html.='</table>';
    echo $html;

    }else{
        echo '<table style="font-family: Arial;" border="1" cellspacing="0"><tr><td>No se encontró el curso</td></tr></table>';
    }

}else{
    echo '<table style="font-family: Arial;" border="1" cellspacing="0"><tr><td>No hay un curso definido</td></tr></table>';
}



?>