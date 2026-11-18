<?php

/*if(isset($_GET['action'])){
    $action = $_GET['action'];

    if($action=='mailUsers'){
        
    }
}else{
    exit('{"status":"error","data":"action not defined"}');
}*/


// Tus datos de configuración
$apiKey = '';
$fromEmail = 'notificaciones@traing.co';
$fromName = 'Notificaciones traing';
$toEmail = 'keevinn1@outlook.com';
$toName = 'Usuari@';

$subject = 'Registro en DEV.TRAING PRESENCIAL';
$htmlContent = '<strong>Hola,</strong> Usted ha sido registrado en TRAING.';

// Construir el cuerpo de la petición en formato JSON según la documentación de SendGrid
$data = [
    "personalizations" => [
        [
            "to" => [
                [
                    "email" => $toEmail,
                    "name" => $toName
                ]
            ]
        ]
    ],
    "from" => [
        "email" => $fromEmail,
        "name" => $fromName
    ],
    "subject" => $subject,
    "content" => [
        /*[
            "type" => "text/plain",
            "value" => $plainTextContent
        ],*/
        [
            "type" => "text/html",
            "value" => $htmlContent
        ]
    ]
];

$jsonPayload = json_encode($data);

// Inicializar cURL
$ch = curl_init('https://api.sendgrid.com/v3/mail/send');

// Configurar las opciones de cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
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

?>