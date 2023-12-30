<?php

header('Content-Type: application/json');
header('Acess-Control-Allow-Origin: *');

function get_data()
{

    include "../config.php";

    // get token in body from users
    $getBody = getallheaders();
    $key = $getBody['token'];

    // token checking
    if ($key != $token_key) {
        $message = "error : Permission denied";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
                // query to find user of given email id
        $query = "SELECT SUM(`quantity`*`price`) AS total_price FROM `billing`";
        $result = mysqli_query($connect, $query);
        $totalPrice = 0;

        // getting data from our database
        while ($row = mysqli_fetch_array($result)) {
            $task_data[] = array(
                'totalPrice'      =>   (float)$row["total_price"]
            );
        }
        return json_encode($task_data);
    }
}
$contents = get_data();

echo $contents;
