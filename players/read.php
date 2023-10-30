<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Conent-Type, Access-Allow-Headers, Authorization, X-Request-Width');
$requestMethod = $_SERVER["REQUEST_METHOD"];

include('function.php');

if($requestMethod == "GET"){
    $playerList = getPlayerList();
    echo $playerList;

}

else{
    $data = [
        'status' => 405,
        'message' => $requestMethod. ' Method Not Allowed',
    ];
    header('HTTP/1.0 405 Method Not Allowed');
    echo json_encode($data);
}

?>