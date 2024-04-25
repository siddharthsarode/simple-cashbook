<?php

include "../_config.php";

$d = $_POST['dt'];
$amount = $_POST['amt'];
$desc = $_POST['desc'];
$op = $_POST['choice'];
$day = date('l');
$msg = "";

//  echo $d,$amount,$desc,$op,$day;

$currentDate = date("Y-m-d");
if ($d > $currentDate) {
    //  echo "<script>alert('Date cannot be greater than the current date.');</script>";
    $msg = "Error,Date cannot be greater than the current date.";
    echo $msg;
}

if ($op == "empty") {
    $msg = "Error, Select your option Income or Expence";
    echo $msg;
    // echo "<script>alert('Select your option Income or Expence');</script>";
}

if (empty($msg)) {
    $sql = "INSERT INTO `transaction` (`t_id`, `state`, `t_date`, `day`, `t_amount`, `t_desc`, `created_at`) 
               VALUES (NULL, '$op', '$d', '$day', '$amount', '$desc', current_timestamp());";

    $res = $conn->query($sql);

    if ($res) {
        echo 'Added Successfully!';
    } else {
        echo 'Something Went Wrong!';
    }
}
