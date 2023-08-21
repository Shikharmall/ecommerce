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
    <link rel="icon" href="img/thesaruscompany-img&logo/thesaruslogo.png">
    <title>The SARUS | About US</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/hamburger.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/about_us.css">
    <link rel="stylesheet" href="css/footer.css">
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
          <li> <a href="about_us.html" class="under">About Us</a> </li>
          <li> <a href="contact_us.php">Contact Us</a> </li>
          <li> <a href="tracking_system.php">Track Consignment</a> </li>
          <li> <a href="pdf/syllabus.pdf" download>Terms and Condition</a> </li>
          <li> <a href="pdf/syllabus.pdf" download>Copyright & Website Policy</a> </li>
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
    
  </header>

    <div class="abtheading">
      <center>
        <h1> <b>About Us</b> </h1>
      </center>
    </div>

    <div class="container">
        <div class="abt">
          <div  id="abt1">
            <img src="img/thesaruscompany-img&logo/sarus-dark.png" alt="image" width="200px" height="200px">
            <center>
                <p>Logo of The SARUS</p>
            </center>
          </div>  
        </div>

        <div class="abt" id ="abt2">
            <h2><span id="lgt-blue">The </span> <span id="drk-blue"> SARUS</span></h2>
            <p> <b>Currenty this website is for project and not used in any production so any images use in this is just part of project.</b> </p>
            <p>This company was started in year 2022. We work here as a commonity.</p>
            <p>This company was started in year 2022. We work here as a commonity.This company was started in year 2022. We work here as a commonity.</p>
            <p>This company was started in year 2022. We work here as a commonity.This company was started in year 2022. We work here as a commonity.</p>
            <p>This company was started in year 2022. We work here as a commonity.This company was started in year 2022. We work here as a commonity.</p>
            <p>This company was started in year 2022. We work here as a commonity.This company was started in year 2022. We work here as a commonity.</p>
            <p>This company was started in year 2022. We work here as a commonity.This company was started in year 2022. We work here as a commonity.</p>
            <p>This company was started in year 2022. We work here as a commonity.This company was started in year 2022. We work here as a commonity.</p>
            <p>This company was started in year 2022. We work here as a commonity.This company was started in year 2022. We work here as a commonity.</p>
            
        </div>
    </div>
    <br>
    <br>

    <footer>
        <div class="foot1">
          <center>
            <p>Copyright © 2022 thesarus.in</p>
            <div class ="foot2">
              <a href="#"> <img src="img/social-media-logo/facebook.png"  alt="facebook"   style="width:23px;height:23px;"> </a>
              <a href="#"> <img src="img/social-media-logo/instagram.png" alt="instagram"  style="width:23px;height:23px;"> </a>
              <a href="#"> <img src="img/social-media-logo/twitter.png"   alt="twitter"    style="width:23px;height:23px;"> </a>
              <a href="#"> <img src="img/social-media-logo/youtube.png"   alt="youtube"    style="width:23px;height:23px;"> </a>
            </div>
          </center>
        </div>
    </footer>

    
    <script src="javascript/login.js"></script>
    <script src="javascript/hamburger.js"></script>
    <script src="javascript/popup1.js"></script>
    <script src="javascript/quantity.js"></script>

</body>

</html>