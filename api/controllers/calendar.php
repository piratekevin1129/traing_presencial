<?php
require('../env.php');

$teachers_file = file_get_contents('../../data/db/teachers.json');
$teachers_file_data = json_decode($teachers_file,true);

$headquarters_file = file_get_contents('../../data/db/headquarters.json');
$headquarters_file_data = json_decode($headquarters_file,true);

$rooms_file = file_get_contents('../../data/db/rooms.json');
$rooms_file_data = json_decode($rooms_file,true);

if(isset($_GET['action'])){
    $action = $_GET['action'];

    if($action=='agendarFacilitador'){
        if(isset($_POST['datos'])){
            $errors = array();
            $eventos_data = json_decode($_POST['datos']);
            $calendarios = array();

            $teachers_ids = array_column($teachers_file_data, 'id');
            
            foreach($eventos_data as $evento){
                $teachers_ind = array_search((string)$evento['f'], $teachers_ids);
                
                if($teachers_ind!==false){
                    $teacher_data = $teachers_file_data[$teachers_ind];
                    $teacher_email = $teacher_data['correo'];
                    $charlas = $evento['ch'];
                    $titulo = $evento['t'];
                    $descripcion = "Charla generada desde TRAING PRESENCIAL";
                    
                    //construir archivo
                    $ics = "BEGIN:VCALENDAR\r\n";
                    $ics .= "VERSION:2.0\r\n";
                    $ics .= "PRODID:-//Traing Presencial//Calendario//ES\r\n";
                    $ics .= "CALSCALE:GREGORIAN\r\n";
                    $ics .= "METHOD:PUBLISH\r\n";

                    foreach($charlas as $ch){
                        $ics .= "BEGIN:VEVENT\r\n";
                        $ics .= "UID:" . uniqid() . "@traingpresencial\r\n";
                        
                        $date = new DateTime('now', new DateTimeZone('America/Bogota'));
                        $fecha = $date->format('Ymd\THis');
                        $ics .= "DTSTAMP:" . $fecha . "\r\n";
                        
                        $inicio1 = (string)$ch['dat']['a']."-".$ch['dat']['m']."-".$ch['dat']['d']." ".$ch['dat']['h'].":".$ch['dat']['i'].":".$ch['dat']['s'];
                        $inicio = new DateTime($inicio1, new DateTimeZone('America/Bogota'));
                        $ics .= "DTSTART;TZID=America/Bogota:".$inicio->format('Ymd\THis')."\r\n";

                        $fin1 = (string)$ch['det']['a']."-".$ch['det']['m']."-".$ch['det']['d']." ".$ch['det']['h'].":".$ch['det']['i'].":".$ch['det']['s'];
                        $fin = new DateTime($fin1, new DateTimeZone('America/Bogota'));
                        $ics .= "DTEND;TZID=America/Bogota:".$fin->format('Ymd\THis')."\r\n";

                        $ics .= "SUMMARY:" . $titulo . "\r\n";
                        $ics .= "DESCRIPTION:" . $descripcion . "\r\n";

                        $ubicacion = '';
                        $aula_id = $ch['aula'];
                        $headquarters_ids = array_column($headquarters_file_data, 'id');
                        $headquarters_ind = array_search((int)$ch['sede'], $headquarters_ids);
                        if($headquarters_ind!==false){
                            $headquarters_data = $headquarters_file_data[$headquarters_ind];
                            $ubicacion.=$headquarters_data['direccion']." (".$headquarters_data['departamento']." - ".$headquarters_data['ciudad']."). ";
                        }
                        $rooms_ids = array_column($rooms_file_data, 'id');
                        $rooms_ind = array_search((int)$ch['aula'], $rooms_ids);
                        if($rooms_ind!==false){
                            $rooms_data = $rooms_file_data[$rooms_ind];
                            $ubicacion.=" ".$rooms_data['nombre'].", ".$rooms_data['extra'];
                        }

                        $ics .= "LOCATION:$ubicacion\r\n";
                        $ics .= "END:VEVENT\r\n";
                    }

                    $ics .= "END:VCALENDAR\r\n";

                    //preparar correo
                    $ics_64 = base64_encode($ics);

                    $contents = [
                        "personalizations" => [
                            [
                                'to' => [
                                    [
                                        'email' => $teacher_email
                                    ]
                                ]
                            ]
                        ],
                        "from" => [
                            "email" => "notificaciones@traing.co",
                            "name" => "Notificaciones traing"
                        ],
                        "subject" => "Registro en DEV.TRAING PRESENCIAL",
                        "content" => [
                            [
                                "type" => "text/html",
                                "value" => "Usted ha sido asignado para dar la charla en los siguientes eventos. Por favor descargue el archivo adjunto e impórtelo a su calendario para conocer toda la información"
                            ]
                        ],
                        "attachments" => [
                            [
                                "content" => $ics_64,
                                "type" => 'text/calendar',
                                "filename" => 'calendario_traing_presencial.ics',
                                "disposition" => "attachment"
                            ]
                        ]
                    ];

                    //enviar correo
                    $payload = json_encode($contents);

                    // Inicializar cURL
                    $service = curl_init('https://api.sendgrid.com/v3/mail/send');

                    // Configurar las opciones de cURL
                    curl_setopt($service, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($service, CURLOPT_CUSTOMREQUEST, 'POST');
                    curl_setopt($service, CURLOPT_POSTFIELDS, $payload);
                    curl_setopt($service, CURLOPT_HTTPHEADER, [
                        'Authorization: Bearer ' . $apiKey,
                        'Content-Type: application/json'
                    ]);

                    // Ejecutar la petición
                    $response = curl_exec($ch);
                    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    $curlError = curl_error($ch);

                    // Cerrar la sesión de cURL
                    curl_close($ch);

                    // Manejar la respuesta
                    if ($curlError) {
                        exit('{"status":"error","data":"'.$curlError.'"}');
                    } else {
                        // SendGrid responde con códigos 200 al 299 en caso de éxito (típicamente 202 Accepted)
                        if ($httpCode >= 200 && $httpCode < 300) {
                            exit('{"status":"success","data":"'.$httpCode.'"}');
                        } else {
                            exit('{"status":"error","data":{"http":"'.$httpCode.'","response":"'.$response.'"}}');
                        }
                    }

                }else{
                    array_push($errors,'Este facilitador no se encontró: '.$evento['f']);
                }
            }

        }
    }
}else{
    exit('{"status":"error","data":"action not defined"}');
}

$subject = $_POST['curso'];
$description = "Charla generada desde TRAING PRESENCIAL";
$location = "";
$start = "20261027T150000Z"; //AAAAMMDDThhmmssZ
$end = "20261027T160000Z";
$uid = md5(uniqid(mt_rand(), true)) . "@traing.com";
$dtstamp = gmdate('Ymd\THis\Z');

$icsContent = "BEGIN:VCALENDAR\r\n" .
              "VERSION:2.0\r\n" .
              "PRODID:-//TRAING//Traing presencial//ES\r\n" .
              "METHOD:REQUEST\r\n" .
              "BEGIN:VEVENT\r\n" .
              "UID:$uid\r\n" .
              "DTSTAMP:$dtstamp\r\n" .
              "DTSTART:$start\r\n" .
              "DTEND:$end\r\n" .
              "SUMMARY:$subject\r\n" .
              "DESCRIPTION:$description\r\n" .
              "LOCATION:$location\r\n" .
              "STATUS:CONFIRMED\r\n" .
              "END:VEVENT\r\n" .
              "END:VCALENDAR\r\n";

// Puedes guardar este contenido como archivo .ics o adjuntarlo en un email con Content-Type: text/calendar

// 3. DEFINIR EL NOMBRE DEL ARCHIVO
// Guardará el archivo en la misma carpeta donde ejecutes este script PHP
$filename = "evento_" . time() . ".ics"; 

// 4. GUARDAR EL ARCHIVO EN EL DISCO
// file_put_contents crea el archivo automáticamente si no existe y escribe el texto
if (file_put_contents($filename, $icsContent) !== false) {
    echo "success";
} else {
    echo "error";
}
?>