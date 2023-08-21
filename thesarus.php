<?php
  include 'connection.php';

  $cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
  $cart = json_decode($cart);

  $cartname = isset($_COOKIE["cartname"]) ? $_COOKIE["cartname"] : "[]";
  $cartname = json_decode($cartname);

  $total  = 0;
  $flag = 0;

  
  $sql5 = "SELECT * FROM items ";
  $result5 = mysqli_query($conn,$sql5);

?>


<!DOCTYPE html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/thesaruscompany-img&logo/thesaruslogo.png">

    <title>The SARUS | Home</title>
        
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/hamburger.css">

    <link rel="stylesheet" href="css/style12.css">
    <link rel="stylesheet" href="css/categories.css">
    <link rel="stylesheet" href="css/featuredproducts.css">
    <link rel="stylesheet" href="css/homepageheaderimage.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/login.css">

    <link rel="stylesheet" href="css/footer.css">
        
  </head>

  <body>

    <div class="sarus-bird" id="preloader">
      <div class="sarus-bird1">
        <img src="img/thesaruscompany-img&logo/croppedbird.gif" alt="bird">
      </div>
    </div>

    <div id="sarus_body">

      <!--header-->
        <header>
          <div class="headname">
  
            <div class="headnameflex">
  
              <div class="headnameflex1">
                <img src="img/thesaruscompany-img&logo/hamburger-menu.png" alt="image" class="burger">
              </div>
  
              <div class="headnameflex2">
                <h1> <span id="lgt-blue">The </span> <span id="drk-blue">SARUS</span> <h1>
              </div>
    
              <div class="headnameflex3">
                        
                <div class="dropdown">
  
                  <!--<img src="img/thesaruscompany-img&logo/wishlist.png" alt="image" class="wishlist" id="responsivelogo">-->
                  
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
                    
                    <a class="links" href="login_page.php">Company LogIn</a>
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
                <li> <a href="thesarus.php" class="under">Home</a> </li>
                <li> <a href="about_us.php">About Us</a> </li>
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
      <!--header-->

      <!--home page header image-->
        <div class = "part2" >
           <div class="sub-part2">
              <img src="img/thesaruscompany-img&logo/topup.png" alt="coffee">
              <div class="sub-sub-part2">
                  <div>
                    <h1>Craft's Everyday !</h1>
                    <h2 id="drk-blue">India's Best Handpicked</h2> 
                    <h2 id="drk-blue"> Artisnal Products</h2>
                    <br>
                    <a href="#productsection"> <button>Shop Now</button> </a> 
                  </div>
              </div>
           </div>
        </div>
        <!--<div class="home_page_header_image">
          <div class = "subhomeimg1">
            <h1>Craft's Everyday !</h1>
            <h2 id="drk-blue">India's Best Handpicked</h2> 
            <h2 id="drk-blue"> Artisnal Products</h2>
            <br>
            <a href="#productsection"> <button>Shop Now</button> </a> 
          </div>
          <div class = "subhomeimg2">
            <img src="img/thesaruscompany-img&logo/topup.png" alt="coffee">
          </div>
        </div>-->
      <!--home page header image-->

      <!--categories-->
        <center>
          <h1 id="lgt-blue"> 
            Categories
            <center> <div class="line"></div> </center>
          </h1>
        </center>

        <div class="categories">
          <div class="subcategories1"> 
            <a><img src="upload-images-items/mug.jpg" alt="categories1" width="150px" height="150px"></a>
            <p>hello</p>
          </div>
          <div class="subcategories2"> 
            <a><img src="upload-images-items/mug.jpg" alt="categories1" width="150px" height="150px"></a>
            <p>hello</p>
          </div>
          <div class="subcategories3"> 
            <a><img src="upload-images-items/mug.jpg" alt="categories1" width="150px" height="150px"></a>
            <p>hello</p>
          </div>
          <div class="subcategories4"> 
            <a><img src="upload-images-items/mug.jpg" alt="categories1" width="150px" height="150px"></a>
            <p>hello</p>
          </div>
          <div class="subcategories5"> 
            <a><img src="upload-images-items/mug.jpg" alt="categories1" width="150px" height="150px"></a>
            <p>hello</p>
          </div>
          <div class="subcategories6"> 
            <a><img src="upload-images-items/mug.jpg" alt="categories1" width="150px" height="150px"></a>
            <p>hello</p>
          </div>
        </div>
      <!--categories-->

      <!--features products vedio-->
        <center>
          <h1 id="lgt-blue"> 
            #vedio of products
            <center> <div class="line"></div> </center>
          </h1>
        </center>

        <div>
          <div>45</div>
          <div>45</div>
          <div>45</div>
          <div>45</div>
          <div>45</div>
          <div>45</div>
        </div>
      <!--features products vedio-->

      <!--brands-->
        <center>
          <h1 id="lgt-blue"> 
            Our Brands
            <center> <div class="line"></div> </center>
          </h1>
        </center>

        <div class="brand">
          <div class="brand #1"> 
            <center> 
              <img src="img/client-logo/nykaa.png" alt="image" width="200px" border-radius="2em"> 
              <p>Nykaa</p>
            </center>
          </div>
          <div class="brand #2">
            <center> 
              <img src="img/client-logo/apple.png" alt="image" width="200px"> 
              <p>Apple</p>
            </center>
          </div>
          <div class="brand #3">
            <center> 
              <img src="img/client-logo/burger-king.png" alt="image" width="200px"> 
              <p>Burger King</p>
            </center>
          </div>
          <div class="brand #4">
            <center> 
              <img src="img/client-logo/h&m.png" alt="image" width="200px"> 
              <p>H&M</p>
            </center>
          </div>
          <div class="brand #5">
            <center> 
              <img src="img/client-logo/dell.png" alt="image" width="200px"> 
              <p>Dell</p>
            </center>
          </div>
          <div class="brand  #6">
            <center> 
              <img src="img/client-logo/adidas.png" alt="image" width="200px"> 
              <p>Adidas</p>
            </center>
          </div>
        </div>
      <!--brands-->  

      <!--features products-->
        <div class="products" id="productsection">
          <div class="productshead">
            <h1>
              Features Products
              <center> <div class="line"></div> </center>
            </h1>
          </div>
  
          <div class="sub_products">
  
            <div class="sub_sub_products">
              <a href="opened_item1.php?item_id=5">
                <img src="upload-images-items/mug.jpg" alt="product1">
                <div class="sub_sub_product_text">
                  <h3>MUG</h3>
                </div>
              </a>
            </div>
  
            <div class="sub_sub_products">
              <a href="opened_item1.php?item_id=1">
                <img src="upload-images-items/bouquet.jpg" alt="product2">
                <div class="sub_sub_product_text">
                  <h3>BOUQUET</h3>
                </div>
              </a>
            </div>
  
            <div class="sub_sub_products">
              <a href="opened_item1.php?item_id=6">
                <img src="upload-images-items/teddy.jpg" alt="product3">
                <div class="sub_sub_product_text">
                  <h3>TEDDY BEAR</h3>
                </div>
              </a>
            </div>
  
          </div>
  
          <div class="sub_products1">
            <a href="products.php">More Products</a>
          </div>
        </div>
      <!--features products-->

      <!--footer-->
        <footer>
          <div class="foot1">
            <center>
              <p>Copyright © 2022 thesarus.in</p>
              <div class ="foot2">
                <a href="#"> <img src="img/social-media-logo/facebook.png"  alt="facebook"   style="width:23px;height:23px;"> </a>
                <a href="#"> <img src="img/social-media-logo/instagram.png" alt="instagram"  style="width:23px;height:23px;"> </a>
                <a href="https://twitter.com/thesarus2022" target="blank"> <img src="img/social-media-logo/twitter.png"   alt="twitter"    style="width:23px;height:23px;"> </a>
                <a href="https://youtube.com/@thesarus" target="blank"> <img src="img/social-media-logo/youtube.png"   alt="youtube"    style="width:23px;height:23px;"> </a>
              </div>
            </center>
          </div>
        </footer>
      <!--footer-->        

    </div>

      <script src="javascript/preloder.js"></script>
      <script src="javascript/hamburger.js"></script>
      <script src="javascript/login.js"></script>
      <script src="javascript/popup1.js"></script>
      <script src="javascript/quantity.js"></script>

  </body>
</html>