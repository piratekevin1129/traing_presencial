<?php
$subject = "Charla presencial";
$description = "Charla sobre salud y seguridad en el trabajo.";
$location = "Sede 1 piso 2, aula 3";
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