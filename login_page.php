<?php

  $login = false;
  $showError = false;

  include 'connection.php';

  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $email = $_POST['email'];
    $pass  = $_POST['password'];
 
    $sql = "Select * from owner_login  where email = '$email' AND password = '$pass'";
 
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    $singleRow = mysqli_fetch_row($result);
 
    if($num == 1){
      $login = true;
      session_start();
      $_SESSION['loggedin'] = true;
      $_SESSION['brand'] = $singleRow['4'];
      $_SESSION['desination'] = $singleRow['5'];
      header("location:Owner_dashboard.php");
    }
 
    else{
      $showError = true;
    }
     
  }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/thesaruscompany-img&logo/thesaruslogo.png">
    <title>The SARUS | LOGIN</title>
    <link rel="stylesheet" href="css/login_page.css">
    <link rel="icon" href="img/thesaruscompany-img&logo/thesaruslogo.png">
</head>

    <body>
        <center>
            <div class="login_form">
                <h1 id="heading">The SARUS</h1>
                <hr>
                <h4>
                    <?php

                      if($showError){
                        echo '<span style="color:red;"> Invalid Credentials </span>';
                      }

                    ?>
                </h4>
                    <form  action="login_page.php" method="POST">
                        <input type="email" name="email" id="email" placeholder="Enter Email" required> <br> <br>
                        <input type="password" name="password" id="password" placeholder="Enter Password" required> <br> <br> <br>  
                        <p id="tnc">By continuing, you agree to The SARUS's  <a href="" id ="policy"><b>Terms of Use</b></a> and <a href="" id ="policy"><b>Privacy Policy</b>.</a></p>
                        <input type="submit" name="submit" id="submit" value="Login">
                    </form>
            </div>
        </center>

    </body>
</html>