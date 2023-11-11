<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../model/user.php';
    require_once '../config/db.php';

    $json = json_decode(file_get_contents('php://input'),true);

    header('Content-Type: application/json');
    $mysqli = db::connect();
    User::SaveUser(
        $mysqli,
        $json["password"],
        $json["email"],
        $json["name"],
        $json["lastname"],
        $json["birthdate"],
        $json["genre"]
    );
    $json_response = ["success" => true];
    echo json_encode($json_response);
    exit;
    #if($user)
    #{
        #$json_response["success"] = true;
        #echo json_encode($json_response);
        #exit;
    #} 
    #else
    #{
       #echo json_encode($json_response);
       #exit;
    #}
}
?>