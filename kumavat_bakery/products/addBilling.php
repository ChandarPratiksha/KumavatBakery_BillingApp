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
    $description = $getBody['description'];
    $quantity = $getBody['quantity'];
    $price = $getBody['price'];
    $m_no = $getBody['m_no'];
    $customer_mno = $getBody['customer_mno'];
    $orderId = "";

    // token checking
    if ($key != $token_key) {
        $message = "error : Permission denied";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
        // query to get data
        $query = "INSERT INTO billing (`items`, `description`, `quantity`, `price`) VALUES ('$item', '$description', '$quantity', '$price')";
        $result = mysqli_query($connect, $query);
        
        $query2 = "INSERT INTO orderRecord (`items`, `description`, `quantity`, `price`, `m_no`,`customer_mno`, `orderId`) VALUES ('$item', '$description', '$quantity', '$price', '$m_no', '$customer_mno', '$orderId')";
        $result2 = mysqli_query($connect, $query2);

        if ($result === TRUE && $result2 === TRUE) {
            echo "Item Added";
        } else {
            echo "Error: " . $connect->error;
        }
    }
}
$contents = get_data();

echo $contents;
