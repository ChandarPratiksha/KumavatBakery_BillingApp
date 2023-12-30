<?php

header('Content-Type: application/json');
header('Acess-Control-Allow-Origin: *');

function get_data()
{

    include "../config.php";

    // get token in body from users
    $getBody = getallheaders();
    $key = $getBody['token'];
    $orderId =  $getBody['orderId'];
    

    // token checking
    if ($key != $token_key) {
        $message = "error : Permission denied";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
        // query to get data
        $query = "UPDATE `orderRecord` SET `orderId`='$orderId' WHERE `orderId` = ''";
        $result = mysqli_query($connect, $query);

        $query2 = "DELETE FROM `billing`";
        $result2 = mysqli_query($connect, $query2);
        
        if ($result === TRUE && $result2 === TRUE) {
            echo "Thank you!";
        } else {
            echo "Error: " . $connect->error;
        }
    }
}
$contents = get_data();

echo $contents;
