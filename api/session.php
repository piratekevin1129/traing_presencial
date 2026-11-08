<?php 
session_start();

$valid_session = false;

if(
    isset($_SESSION['user_id'])&&
    isset($_SESSION['name'])&&
    isset($_SESSION['document'])&&
    isset($_SESSION['course_id'])
){
    $valid_session = true;
}
 
function exitPage(){
    //echo __DIR__;
    header("Location: ../student/prelogin.php");
    exit();
}
?>