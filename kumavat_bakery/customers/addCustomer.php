<?php

header('Content-Type: application/json');
header('Acess-Control-Allow-Origin: *');

function get_data()
{

    include "../config.php";

    // get token in body from users
    $getBody = getallheaders();
    $key = $getBody['token'];
    $name = $getBody['name'];
    $location = $getBody['location'];
    $m_no = $getBody['m_no'];

    // token checking
    if ($key != $token_key) {
        $message = "error : Permission denied";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
        // query to get data
        $query = "INSERT INTO customers (`name`, `location`, `m_no`) VALUES ('$name', '$location', '$m_no')";
        $result = mysqli_query($connect, $query);

        if ($result === TRUE) {
            echo "Customer Added";
        } else {
            echo "Error: " . $connect->error;
        }
    }
}
$contents = get_data();

echo $contents;
