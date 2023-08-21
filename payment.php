<?php
    include 'connection.php';

    session_start();

    if(!isset($_SESSION['shipping_price']) &&  !isset($_SESSION['finalamount']) && !isset($_SESSION['customer_id'])){
        header("location:thesarus.php");
        exit;
    }

    //$item_price = $_SESSION['item_price'];
    
    
    $customer_id = $_SESSION['customer_id'];
    $shipping_charge = $_SESSION['shipping_price'];
    $finalamount = $_SESSION["finalamount"];

    $_SESSION['id'] = $customer_id;
    
    $sql=" UPDATE customer  SET shipping_charge = '$shipping_charge'  where customer_id = '$customer_id' ";
    $rest = mysqli_query($conn,$sql);

    $sql=" UPDATE customer  SET total = '$finalamount'  where customer_id = '$customer_id' ";
    $res = mysqli_query($conn,$sql);
    
    
    if(isset($_POST["submit"])){

       $file_name = $_FILES['uploadfile']['name'];
       $file_tmp = $_FILES['uploadfile']['tmp_name'];
       $folder   = "upload-images/".$file_name;

       if(move_uploaded_file($file_tmp , $folder)){
        $sql=" UPDATE customer  SET receipt = '$folder'  where customer_id = '$customer_id' ";
        $result = mysqli_query($conn,$sql);
        header("location:thank.php");
       }

       else{
        echo "upload failed.";
       }
    }

?>



<!DOCTYPE html>
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" href="img/thesaruscompany-img&logo/thesaruslogo.png">
        <title>Payment</title>
        <link rel="stylesheet" href="css/common.css">
        <link rel = "stylesheet" href="css/payment&thank.css">
    </head>
    <body>

    <div class="navigator">
        <p> <span id="grey">Information</span>  <span id="drk-blue"> <b> > </b> </span>   <span id="grey">Shipping</span>  <span id="drk-blue"> <b> > </b> </span> <span id="lgt-blue">Payment</span> </p>
    </div>

        <center>
            <p>Scan QR and make payment</p>
            <h3>Amount to be paid of multiple product: <?php echo "$finalamount"; ?> </h3>
            <img src="img\qr.png" alt="QR code"  width="346.5px" height="346.5px">
            <br><br><br><br>
            
            <p>After payment upload the screenshot of the payment done for proof</p>
            <form action="#" method="POST" enctype="multipart/form-data">
                 <input type ="file" name = "uploadfile" required> <br> <br>
                 <input type ="submit" name ="submit" id ="ss_subm" value="Upload">
            </form>

            <br>

            <p>*If you have done payment and  amount is debited  but cannot upload file in any circumstances then you can send the screenshot of your payment as a proof to our email <b>thesarus.2022@gmail.com</b>*</p>

        </center>
        
    </body>
</html>