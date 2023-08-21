<?php
  include 'connection.php';


    if(isset($_POST['submit_consg_number'])){

      $congnNo = $_POST['consg_number'];
         
      $user_id =$_SESSION['cust_id'];
      
      $sql=" UPDATE customer  SET speedNumber = '$congnNo'  where customer_id = '$user_id' ";
    }
  

?>