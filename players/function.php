<?php

require '../inc/dbcon.php';


function updatePlayer($playerInput, $playerParams) {
    global $conn;

    if (!isset($playerParams['player_id'])) {
        return error422('Player Id not found in the database...');
    } elseif ($playerParams['player_id'] == null){
        return error422('Enter the player Id'); 
    }

        $playerId = mysqli_real_escape_string($conn, $playerParams['player_id']);
        $first_name = mysqli_real_escape_string($conn, $playerInput['first_name']);
        $last_name = mysqli_real_escape_string($conn, $playerInput['last_name']);
        $jersey_number = mysqli_real_escape_string($conn, $playerInput['jersey_number']);

        if (empty(trim($first_name))) {
            return error422('Enter first name...');
        } elseif (empty(trim($last_name))) {
            return error422('Enter last name...');
        } elseif (empty(trim($jersey_number))) {
            return error422('Enter jersey number...');
        } 
        else {
            $query = "UPDATE players SET first_name = '$first_name', last_name = '$last_name', jersey_number = '$jersey_number' WHERE id = '$playerId' LIMIT 1";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $data = [
                    'status' => 200,
                    'message' => 'Player Updated Successfully',
                ];
                header('HTTP/1.0 200 Updated Successfully');
                echo json_encode($data);
            } else {
                $data = [
                    'status' => 500,
                    'message' => 'Internal Server Error',
                ];
                header('HTTP/1.0 500 Internal Server Error');
                echo json_encode($data);
            }
        }
    }

function error422($message){
    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header('HTTP/1.0 422 Unprocessable Entity');
    echo json_encode($data);
    exit();
}

function storePlayer($playerInput){
    global $conn;

    if (isset($playerInput['first_name']) && isset($playerInput['last_name']) && isset($playerInput['jersey_number'])) {
        $first_name = mysqli_real_escape_string($conn, $playerInput['first_name']);
        $last_name = mysqli_real_escape_string($conn, $playerInput['last_name']);
        $jersey_number = mysqli_real_escape_string($conn, $playerInput['jersey_number']);

        if (empty(trim($first_name))) {
            return error422('Enter first name...');
        } elseif (empty(trim($last_name))) {
            return error422('Enter last name...');
        } elseif (empty(trim($jersey_number))) {
            return error422('Enter jersey number...');
        } else {
            $query = "INSERT INTO players (first_name, last_name, jersey_number) VALUES ('$first_name', '$last_name', '$jersey_number')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $data = [
                    'status' => 201,
                    'message' => 'Player Created Successfully',
                ];
                header('HTTP/1.0 201 Created Successfully');
                echo json_encode($data);
            } else {
                $data = [
                    'status' => 422,
                    'message' => 'Unprocessable Entity',
                ];
                header('HTTP/1.0 422 Unprocessable Entity');
                echo json_encode($data);
            }
        }
    } else {
        return error422('Invalid input data. Make sure to provide all required fields.');
    }
}


function getPlayerList(){
    global $conn;

    $query = "SELECT * FROM players";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        if(mysqli_num_rows($query_run) > 0){
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => "Player list fetched successfully",
                'data' => $res,
            ];
            header("HTTP/1.0 200 Success");
            return json_encode($data);

        } else {
            $data = [
                'status' => 404,
                'message' => "No Player Found",
            ];
            header("HTTP/1.0 404 No Player Found");
            return json_encode($data);
        }

    } else {
        $data = [
            'status' => 500,
            'message' => "Internal Server Error",
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}


function deletePlayer($playerParams){
    global $conn;

    if (!isset($playerParams['player_id'])) {
        return error422('Player id not found in the database...');
    } elseif ($playerParams['player_id'] == null){
        return error422('Enter the player Id'); 
    }

        $playerId = mysqli_real_escape_string($conn, $playerParams['player_id']);

        $query = "DELETE FROM players WHERE player_id = '$playerId' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if($result){
            $data = [
                'status' => 204,
                'message' => "Player Deleted Successfully",
            ];
            header("HTTP/1.0 204 DELETED");
            return json_encode($data);
        }else{
            $data = [
                'status' => 404,
                'message' => "Player not found",
            ];
            header("HTTP/1.0 404 Not Found");
            return json_encode($data);
        }

}

?>
