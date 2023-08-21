<?php
    include 'connection.php';
           
    $user_id = $_POST['hid_cust_id'];

    $sql=" UPDATE customer  SET event2 = '1'  where customer_id = '$user_id' ";
    if(mysqli_query($conn,$sql)){
     echo 1;
    }
    else{
     echo 0;
    }

?>