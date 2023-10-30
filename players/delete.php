<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header('Access-Control-Allow-Method: DELETE');
header('Access-Control-Allow-Headers: Content-Type, Access-Allow-Headers, Authorization, X-Request-Width');
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('function.php');

if ($requestMethod == "DELETE") {
    if (isset($_GET["player_id"])) {
        $player_id = $_GET["player_id"];
        $deletePlayer = deletePlayer(['player_id' => $player_id]);
        echo $deletePlayer;
    } else {
        $data = [
            'status' => 422,
            'message' => 'Player id not found in the request...',
        ];
        header('HTTP/1.0 422 Unprocessable Entity');
        echo json_encode($data);
    }
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . ' Method Not Allowed',
    ];
    header('HTTP/1.0 405 Method Not Allowed');
    echo json_encode($data);
}
?>
