<?php

header('Content-Type: application/json');
header('Acess-Control-Allow-Origin: *');

function get_data()
{

    include "../config.php";

    // get token in body from users
    $getBody = getallheaders();
    $key = $getBody['token'];
    $m_no = $getBody['m_no'];

    // token checking
    if ($key != $token_key) {
        $message = "error : Permission denied";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
        // query to get data
        $query = "SELECT * FROM products WHERE customer_mno = $m_no";
        $result = mysqli_query($connect, $query);

        $task_data = array();
        while ($row = mysqli_fetch_array($result)) {
            $task_data[] = array(
                'id'      =>   $row["id"],
                'name'      =>   $row["name"],
                'description'      =>   $row["description"],
                'price'      =>   $row["price"],
                'image'      =>   $row["image"],
                'customer_mno'      =>   $row["customer_mno"],
                'm_no'      =>   $row["m_no"]
            );
        }
        return json_encode($task_data);
    }
}
$contents = get_data();

echo $contents;
