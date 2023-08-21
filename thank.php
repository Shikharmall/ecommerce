<?php
    include 'connection.php';

    session_start();
    if(!isset($_SESSION['id'])){
        header("location:thesarus.php");
        exit;
    }


    $id = $_SESSION['id'];
    $sql = "SELECT * FROM customer where customer_id = '$id' ";
    $result = mysqli_query($conn , $sql);
    $singleRow = mysqli_fetch_row($result);
    $consg = $singleRow['18'];

?>



<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/thesaruscompany-img&logo/thesaruslogo.png">
        <title>The SARUS | Thanks</title>
        <link rel="stylesheet" href="css/common.css">
        <link rel = "stylesheet" href="css/payment&thank.css">
    </head>
    <body>
        <center class="thanking">
            <div class ="heading">
                <h2> <span id="lgt-blue">The</span> <span id="drk-blue">SARUS</span> </h2>
            </div>


            <h1><span id="drk-blue">Thanks for shopping</span></h1>
            <h3><span id="lgt-blue">Visit again</span></h3>

            <br><br><br>

            <h3><span id="drk-blue">Your Order Number(Consignment Number) is : </span> <b id="lgt-blue"> <?php echo $singleRow['18']; ?></b></h3>
            <a href="tracking_system.php">Click to check status of your consignment</a>
            

        </center>
        
    </body>
</html>