<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../model/user.php';
    require_once '../config/db.php';

    $json = json_decode(file_get_contents('php://input'),true);

    header('Content-Type: application/json');
    $mysqli = db::connect();
    $user = User::AuthenticateUser($mysqli, $json["username"], $json["password"]);
    $json_response = ["success" => false];
    if($user)
    {
        $json_response["success"] = true;
        session_start();
        $_SESSION["AUTH"] = (string)$user->getIdUser();
        echo json_encode($json_response);
        exit;
    } 
    else
    {
       echo json_encode($json_response);
       exit;
    }
}
?>