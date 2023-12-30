<?php

header('Content-Type: application/json');
header('Acess-Control-Allow-Origin: *');

function get_data()
{

    include "../config.php";

    // get token in body from users
    $getBody = getallheaders();
    $key = $getBody['token'];
    $orderId = $getBody['orderId'];

    // token checking
    if ($key != $token_key) {
        $message = "error : Permission denied";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
        // query to get data
        $query = "SELECT * FROM `orderRecord` WHERE `orderId` = $orderId";
        $result = mysqli_query($connect, $query);

        $task_data = array();
        while ($row = mysqli_fetch_array($result)) {
            $task_data[] = array(
                'items'      =>   $row["items"],
                'description'      =>   $row["description"],
                'quantity'      =>   $row["quantity"],
                'price'      =>   $row["price"],
                'm_no'      =>   $row["m_no"],
                'customer_mno'      =>   $row["customer_mno"],
                'orderId'      =>   $row["orderId"]
            );
        }
        return json_encode($task_data);
    }
}
$contents = get_data();

echo $contents;
