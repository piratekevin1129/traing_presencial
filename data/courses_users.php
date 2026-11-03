<?php 

$courses_users_file = file_get_contents((__DIR__).'/db/courses_users.json');
$courses_users_file_data = json_decode($courses_users_file,true);

$courses_users = array();

foreach($courses_users_file_data as $cud){
    $cud_users = array();
    foreach($cud['users'] as $cud_user){
        array_push($cud_users,array('id'=>$cud_user['id'],$cud_user['status']));
    }
    array_push($courses_users,array(
        'id'=>$cud['id'],
        'users'=>$cud_users
    ));
}
?>