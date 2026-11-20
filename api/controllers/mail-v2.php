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

//ARCHIVO ADJUNTO
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
            "type" => "text/html",
            "value" => $htmlContent
        ]
    ],
    // Sección de archivos adjuntos
    "attachments" => [
        [
            "content" => $fileBase64,
            "filename" => $fileName,
            "type" => $mimeType,
            "disposition" => "attachment"
        ]
    ]
];

//MULTIPLES PERSONAS
$apiKey = getenv('SENDGRID_API_KEY') ?: 'TU_API_KEY_DE_SENDGRID';

$usuarios = [
    ['email' => 'ana@ejemplo.com', 'nombre' => 'Ana'],
    ['email' => 'carlos@ejemplo.com', 'nombre' => 'Carlos'],
    ['email' => 'laura@ejemplo.com', 'nombre' => 'Laura'],
];

// Creamos una "personalization" por cada destinatario para que no vean entre sí
$personalizations = [];
foreach ($usuarios as $usuario) {
    $personalizations[] = [
        'to' => [
            [
                'email' => $usuario['email'],
                'name'  => $usuario['nombre'],
            ],
        ],
        // Opcional: si usas Dynamic Templates con Handlebars (ej. {{nombre}})
        'dynamic_template_data' => [
            'nombre' => $usuario['nombre'],
        ],
    ];
}

$payload = [
    'personalizations' => $personalizations,
    'from' => [
        'email' => 'notificaciones@tudominio.com', // Debe estar verificado en SendGrid
        'name'  => 'Tu Aplicación',
    ],
    'subject' => 'Novedades importantes de la plataforma',
    'content' => [
        [
            'type'  => 'text/html',
            'value' => '<p>Hola, tenemos novedades para ti. Gracias por usar nuestro servicio.</p>',
        ],
    ],
];

$ch = curl_init('https://api.sendgrid.com/v3/mail/send');

curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => [
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json',
    ],
    CURLOPT_POSTFIELDS     => json_encode($payload, JSON_UNESCAPED_UNICODE),
    CURLOPT_TIMEOUT        => 30,
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);

curl_close($ch);

if ($curlError) {
    echo "Error de cURL: {$curlError}\n";
} elseif ($httpCode >= 200 && $httpCode < 300) {
    // SendGrid suele responder 202 Accepted cuando encola el envío correctamente
    echo "Correos aceptados por SendGrid (HTTP {$httpCode}).\n";
} else {
    echo "Error de SendGrid (HTTP {$httpCode}): {$response}\n";
}

<?php

$payloadGrupal = [
    'personalizations' => [
        [
            // Destinatario principal visible (puede ser tu buzón o un correo genérico)
            'to' => [
                ['email' => 'avisos@tudominio.com', 'name' => 'Lista de difusión'],
            ],
            // Copia oculta para todos los usuarios
            'bcc' => [
                ['email' => 'usuario1@ejemplo.com'],
                ['email' => 'usuario2@ejemplo.com'],
                ['email' => 'usuario3@ejemplo.com'],
            ],
        ],
    ],
    'from' => [
        'email' => 'notificaciones@tudominio.com',
        'name'  => 'Tu Aplicación',
    ],
    'subject' => 'Aviso de mantenimiento programado',
    'content' => [
        [
            'type'  => 'text/plain',
            'value' => 'El sistema estará en mantenimiento este domingo de 2:00 a 4:00 AM.',
        ],
    ],
];