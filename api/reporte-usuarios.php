<?php 
$tipos_trabajador = array(
    'e'=>'Estudiante',
    'c'=>'Contratista'
);

$tipos_documento = array(
    'cc'=>'Cédula de ciudadanía',
    'ce'=>'Cédula extranjera'
);

$users_file = file_get_contents('../data/db/users.json');
$users_file_data = json_decode($users_file,true);

//////////////////////////////

$filename = "reporte_usuarios".date('Y-m-d').".xls";
/*header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Cache-Control: max-age=0");
echo "\xEF\xBB\xBF";*/

$html = '';

$html.='<table style="font-family: Arial;" border="1" cellspacing="0">';
$html.='<tr>';
    $html.='<td bgcolor="#FAFFE5">Id</td>';
    $html.='<td bgcolor="#FAFFE5">Tipo de usuario</td>';
    $html.='<td bgcolor="#FAFFE5">Nombres</td>';
    $html.='<td bgcolor="#FAFFE5">Apellidos</td>';
    $html.='<td bgcolor="#FAFFE5">Tipo de documento</td>';
    $html.='<td bgcolor="#FAFFE5">Documento</td>';
    $html.='<td bgcolor="#FAFFE5">Ciudad</td>';
    $html.='<td bgcolor="#FAFFE5">Empresa</td>';
    $html.='<td bgcolor="#FAFFE5">Correo</td>';
    $html.='<td bgcolor="#FAFFE5">Fecha de registro</td>';
    $html.='<td bgcolor="#FAFFE5">Estado</td>';
$html.='</tr>';

foreach($users_file_data as $user_data){
    $html.='<tr>';
        $html.='<td>'.$user_data['id'].'</td>';
        $html.='<td>'.$tipos_trabajador[$user_data['tipou']].'</td>';
        $html.='<td>'.$user_data['nombre'].'</td>';
        $html.='<td>'.$user_data['apellido'].'</td>';
        $html.='<td>'.$tipos_documento[$user_data['tipod']].'</td>';
        $html.='<td>'.$user_data['documento'].'</td>';
        $html.='<td>'.$user_data['ciudad'].'</td>';
        $html.='<td>'.$user_data['empresa'].'</td>';
        $html.='<td>'.$user_data['correo'].'</td>';
        $html.='<td>'.$user_data['fecharegistro'].'</td>';
        if($user_data['status']==0){
            $html.='<td>Activo</td>';
        }else{
            $html.='<td>Eliminado</td>';
        }
    $html.='</tr>';

}

$html.='</table>';
echo $html;

?>