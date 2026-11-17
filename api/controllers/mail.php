<?php

if(isset($_GET['action'])){
    $action = $_GET['action'];

    if($action=='mailUsers'){
        
    }
}else{
    exit('{"status":"error","data":"action not defined"}');
}


// Tus datos de configuración
$apiKey = 'TU_API_KEY'; // O puedes usar getenv('SENDGRID_API_KEY')
$fromEmail = 'tu-correo@tudominio.com';
$fromName = 'Tu Nombre o Empresa';
$toEmail = 'destinatario@correo.com';
$toName = 'Nombre del Destinatario';

$subject = 'Correo de prueba con cURL y SendGrid';
$plainTextContent = 'Hola, este es un correo de prueba enviado usando cURL en PHP.';
$htmlContent = '<strong>Hola,</strong> este es un correo de prueba enviado usando la API de SendGrid con <em>cURL</em> en PHP.';

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
        [
            "type" => "text/plain",
            "value" => $plainTextContent
        ],
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
    echo "Error de cURL: " . $curlError;
} else {
    // SendGrid responde con códigos 200 al 299 en caso de éxito (típicamente 202 Accepted)
    if ($httpCode >= 200 && $httpCode < 300) {
        echo "¡Correo enviado con éxito! Código HTTP: " . $httpCode;
    } else {
        echo "Error al enviar el correo. Código HTTP: " . $httpCode . "<br>";
        echo "Respuesta de la API: " . $response;
    }
}

?>