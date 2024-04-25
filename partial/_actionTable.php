<?php
include "../_config.php";


if (isset($_POST['select'])) {
     $id = $_POST['id'];
     $sql = "SELECT * FROM transaction WHERE t_id = $id";
     $res = $conn->query($sql);
     $row = $res->fetch_assoc();
     print_r(json_encode($row));
}

// Update request 
if (isset($_POST['update'])) {
     $d = $_POST['dt'];
     $amount = $_POST['amt'];
     $desc = $_POST['desc'];
     $op = $_POST['choice'];
     $day = date('l');
     $id = $_POST['row-id'];
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
          $sql = "UPDATE `transaction` SET `t_date` = '$d', `day` = '$day',
                `t_amount` = '$amount', `t_desc` = '$desc', `state` = '$op', `created_at` = current_timestamp() WHERE 
                `transaction`.`t_id` = $id";

          $res = $conn->query($sql);

          if ($res) {
               echo 'Updated Successfully';
          } else {
               echo 'Something Went Wrong!';
          }
     }
}

if (isset($_POST['delete'])) {
     $delId = $_POST['delId'];

     $sql = "DELETE FROM transaction WHERE t_id = $delId";
     $res = $conn->query($sql);
     if ($res) {
          echo "Record Removed";
     } else {
          echo "Record Removed";
     }
}
