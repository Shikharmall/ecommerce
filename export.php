<?php

    include 'connection.php';
    $sql = "SELECT * FROM customer ";
    $result = mysqli_query($conn,$sql);
    $html='<table><tr><th>Customer Id (Tracking Id)</th><th>Item(Quantity)</th><th>First Name</th><th>Last Name</th><th>Address</th><th>City</th><th>State</th><th>Country</th><th>Pincode</th><th>Email</th><th>Phone</th><th>Payment Recieved</th><th>Packed</th><th>Shipped</th><th>Delivered</th></tr>';

    while($info=$result->fetch_assoc())
    {
      $html.='<tr><td>'.$info['consignment_no'].'</td><td>'.$info['item_name'].'</td><td>'.$info['fname'].'</td><td>'.$info['lname'].'</td><td>'.$info['address'].'</td><td>'.$info['city'].'</td><td>'.$info['state'].'</td><td>'.$info['country'].'</td><td>'.$info['pincode'].'</td><td>'.$info['email'].'</td><td>'.$info['phone'].'</td><td>'.$info['event0'].'</td><td>'.$info['event1'].'</td><td>'.$info['event2'].'</td><td>'.$info['event3'].'</td></tr>';

    }
    
    $html.='</table>';
    
    header('Content-Type:application/xls');
    header('Content-Disposition:attachment;filename=customers.xls');


    echo $html;

?>