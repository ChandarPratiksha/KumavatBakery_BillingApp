<?php

header('Content-Type: application/json');
header('Acess-Control-Allow-Origin: *');

function get_data()
{

    include "../config.php";

    // get token in body from users
    $getBody = getallheaders();
    $key = $getBody['token'];
    $item = $getBody['item'];
    $quantity = $getBody['quantity'];
    $price = $getBody['price'];
    $m_no = $getBody['m_no'];

    // token checking
    if ($key != $token_key) {
        $message = "error : Permission denied";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
        // query to get data
        $query = "INSERT INTO billing (`items`, `quantity`, `price`, `m_no`) VALUES ('$item', '$quantity', '$price', '$m_no') WHERE `m_no` !=''";
        $result = mysqli_query($connect, $query);

        if ($result === TRUE) {
            echo "Thank You!";
        } else {
            echo "Error: " . $connect->error;
        }
    }
}
$contents = get_data();

echo $contents;
