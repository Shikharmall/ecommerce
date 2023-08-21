<?php
    
  include 'connection.php';

  $cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
  $cart = json_decode($cart);

  $cartname = isset($_COOKIE["cartname"]) ? $_COOKIE["cartname"] : "[]";
  $cartname = json_decode($cartname);
  
  $total  = 0;
  $flag = 0;


?>



<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img\thesaruscompany-img&logo\thesaruslogo.png">

        <title>The SARUS | Track Consignment</title>

        <link rel="stylesheet" href="css/common.css">
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/cart.css">
        <link rel="stylesheet" href="css/hamburger.css">
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="css/tracking_system.css">
    </head>


    <body>

        
    <header>
        <div class="headname">

          <div class="headnameflex">

            <div class="headnameflex1">
              <img src="img/thesaruscompany-img&logo/hamburger-menu.png" alt="image" class="burger">
            </div>

            <div class="headnameflex2">
              <h1> <span id="lgt-blue">The </span> <span id="drk-blue"> SARUS</span> <h1>
            </div>
  
            <div class="headnameflex3">
                      
              <div class="dropdown">
               
                
                <!--cart-->
                <img src="img/thesaruscompany-img&logo/cart.png" alt="image" class="cart"  onclick="funcart()" id="responsivelogo">
  
  <div  id="opencart">
    <div id="opencart-content">
      <div class="closecart">
        <img src="img/thesaruscompany-img&logo/close.png" alt="close" onclick="funcartclose()">
      </div>

      <div class="content">
        <center> <h2>Shopping Cart</h2> </center>
        <hr>


        <?php
          foreach($cart as $c){
            if($c->item_name){
              $flag = true;
              break;
            }
          }
        ?>

        <?php  
          if(!$flag){
        ?>

        
        <center>
        <br><br><br><br>
        <img src="img/thesaruscompany-img&logo/cart.png" alt="image" class="cart"  id="responsivelogo">
        <h3 id="lgt-blue">Your shopping cart is empty.</h3>
        </center>

        <?php

          }
          else{
          foreach($cartname as $c){
          $itmid = $c->item_id;

          $sql55 = "SELECT * FROM items WHERE item_id = '$itmid'";
          $result55 = mysqli_query($conn,$sql55);
          $singleRow55 = mysqli_fetch_row($result55);

        ?>
        
        <div class="cartcontainer">

          <div class="cartcontainer1">

            <div class="subcart">
              <center>
                <?php echo"<image src='".$singleRow55[9]."' width='150px' height = '150px' style='border-radius: 5px'>"?>
              </center>
            </div>

            <div class="subcart">
              <div class="quantity">
                <!--<div class = "quantity1"> <button /*onclick ="fucndecrement()"*/>-</button> </div>-->
                <div class = "quantity2"> <center> <b><p id ="numb"> Quantity: <?php echo $c->quantity; ?> </p></b> </center> </div>
                <!--<div class = "quantity1"> <button /*onclick ="fucnincrement()"*/>+</button> </div>-->
              </div>
            </div>
                    
          </div>

          <div class="cartcontainer2">
            <h2 id="lgt-blue"><?php  echo $singleRow55[1]; ?></h2>
            <h3 id="grey"><?php  echo $singleRow55[3]; ?></h3>
            <h3 id="grey"> <s>&#8377; <?php  echo $singleRow55[2]; ?> </s>  &nbsp; <?php  echo $singleRow55[4]; ?> %off </h3>
                     
            <hr>

            <div class="total">
              <div class="total1">
                <form action="delete-item-cart.php" method="POST">
                  <input type="hidden" name="item_id" value ="<?php  echo $c->item_id; ?>">
                  <input type="image" src="img/thesaruscompany-img&logo/delete.png" alt="delete" width="30px" height="30px">
                </form>
                <!--<img src="img/thesaruscompany-img&logo/delete.png" alt="image"  width="30px" height="30px"> -->
              </div>
              <?php 
                $subtotal = ($singleRow55[3])*($c->quantity);
              ?>
              <div class="total1" id="grey"> <b><p id="pricetag">Sub Total: Rs <?php  echo $subtotal; ?></p></b> </div>
            </div>
             
          </div>

        </div>

        <?php
          $total = $total + $subtotal;
          }
        ?>
        

        <div class="ordersummary">
          <fieldset>
            <legend>Order Summary</legend>
            <h4 id="grey"><p id="pricetagtotal">Total Amount: Rs <?php  echo $total; ?></p></h4>
          </fieldset>
        </div>

        <br>

        <form action="gather_data.php">
          <div class="buy"> 
            <button> <h3>Proceed to Buy</h3> </button> 
          </div>
        </form>


        <?php
          }
        ?>

       <br>
       <br>
      </div>

    </div>

  </div>
  <!--</cart>-->
                
                <!--<userlogin>-->
                <img src="img/thesaruscompany-img&logo/user-logo.png" alt="image"  onclick="myFunction()" id="responsivelogo" class="dropbtn">

                <div id="myDropdown" class="dropdown-content">
                  <center>
                    <img src="img/thesaruscompany-img&logo/sarus-dark.png" alt="image">
                    <br>
                    <a class="links" href="login_page.php">Owner LogIn</a>
                  </center>  
                </div>
                <!--</userlogin>-->

              </div>

            </div>

          </div>

        </div>
              
        <nav class="navbar">
          <ul>
                
            <div class=" navvv v-class-hidden v-class-height">
              <li> <a href="thesarus.php">Home</a> </li>
              <li> <a href="about_us.php">About Us</a> </li>
              <li> <a href="contact_us.php">Contact Us</a> </li>
              <li> <a href="tracking_system.php"  class="under" >Track Consignment</a> </li>
              <li> <a href="#">Terms and Condition</a> </li>
              <li> <a href="#">Copyright & Website Policy</a> </li>
            </div>

                
            <div class="search">
              <form action="#" method="post">
                <div class="searchflex">
                  <div class="searchflex1">
                    <input type="text" name="search" id="search" placeholder="Search">
                  </div>
                  <div class="searchflex2">
                    <input type="image" src="img/thesaruscompany-img&logo/search.png" alt="Submit"  width="25px">
                  </div>
                </div>
              </form>
            </div>

          </ul> 
        </nav>  
        

        <!--<marquee>
          <p>**This site was developed by and is under maintenance of <b>Shikhar Mall</b> student of Madan Mohan Malviya University of Technology** &nbsp;&nbsp;&nbsp;&nbsp;  **☠️Use on laptop for better experience☠️**</p>
        </marquee>-->

      </header>

    <br><br>
        <div class="heading">
            <center>
                <h1><span id="lgt-blue">Track </span> <span id="drk-blue"> Consignment</span></h1>
            </center>

        <center>
            <form action="#" method="POST">
                <div class="conshdetails">
                    <input type="text" name="name" placeholder="Enter consignment number" required>
                </div>  <br>
    
                <div class="conshdetailsub">
                    <input type="submit" name="search" value = "Search">
                </div>
                <br> <br>
            </form>

            <?php

                if(isset($_POST['search']))
                {
                    $name = $_POST['name'];
                    /*$num = trim($name,"BAE"); /*removes B,A,E from consinment number*/
                    $query ="SELECT * FROM customer  WHERE consignment_no ='$name' ";
                    $query_run = mysqli_query($conn,$query);

            ?>
    
            <h3 id="drk-blue">
                <?php 
                    if(mysqli_num_rows($query_run)){echo "Consignment Number:  ".$name; }
                ?>
            </h3>
            


            <table>
                <tr>
                    <th>Event</th>
                </tr>

            <?php

                if(mysqli_num_rows($query_run) > 0){
                while($row = mysqli_fetch_array($query_run))
                {

            ?>


                <tr>
                    <td>Order Placed:  <div class="tick">&#10004;</div></td>
                </tr>

                <tr>
                    <td>Payment Recieved(Payment status will be updated soon):&nbsp;&nbsp; 
                    <div class="tick">
                        <?php
                          if($row['event0']){
                            echo "&#10004;";
                          }
                          else{
                            echo "";
                          }
                        ?>
                      </div>
                    </td>
                </tr>

                <tr>
                    <td>Packed: 
                      <div class="tick">
                        <?php
                          if($row['event1']){
                            echo "&#10004;";
                          }
                          else{
                            echo "";
                          }
                        ?>
                      </div>
                    </td>
                </tr>

                <tr>
                    <td>Shipped: 
                    <div class="tick">
                        <?php
                          if($row['event2']){
                            echo "&#10004;";
                          }
                          else{
                            echo "";
                          }
                        ?>
                      </div>
                    </td>
                </tr>

                <tr>
                    <td>Delivered: 
                    <div class="tick">
                        <?php
                          if($row['event3']){
                            echo "&#10004;";
                          }
                          else{
                            echo "";
                          }
                        ?>
                      </div>
                    </td>
                </tr>

            <?php
                    }
                }

               else
               {
            ?>
        
             <tr>  
               <td colspan ="6"> *Enter valid consignment mumber </td>  
             </tr>
               
            <?php
                }
            ?>
            </table>
            <?php
                }
            ?>
        </center>
        

        <br><br><br>
        
       <script src="javascript/hamburger.js"></script>
       <script src="javascript/login.js"></script>
       <script src="javascript/popup1.js"></script>

    </body>
</html>