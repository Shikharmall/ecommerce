<?php
    include 'connection.php';
    session_start();
    if(!isset($_COOKIE["cart"]) && !isset($_COOKIE["cartname"])){
      header("location:thesarus.php");
      exit;
    }

    $cartname = isset($_COOKIE["cartname"])  ? $_COOKIE["cartname"] : "[]" ;
    $cartname = json_decode($cartname);


    $cart = isset($_COOKIE["cart"])  ? $_COOKIE["cart"] : "[]"; /* dont decode and store in database... */

    
    /*$validity = false;*/
    
    if(isset($_POST['submit']))
    {   
      $item_name = $cart;
      $country = $_POST['country'];    
      $fname = $_POST['fname'];      
      $lname = $_POST['lname'];       
      $address = $_POST['address'];  
      $state = $_POST['state'];   
      $city = $_POST['city'];
      $pincode = $_POST['pincode'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $event0 = '0';
      $event1 = '0';
      $event2 = '0';
      $event3 = '0';

       
       /* if(strlen($phone) == 10 && strlen($phone) == 6){
          $_SESSION['customer_ph'] = "$phone";

          $sql = "INSERT INTO customer(item_id,item_name,country,fname,lname,address,city,state,pincode,email,phone) VALUES('$item_id','$item_name','$country','$fname','$lname','$address','$city','$state','$pincode','$email','$phone')";

          $result = mysqli_query($conn,$sql);

          if($result){
            header("location:shipping_charge.php");
          }
          else{
            echo "<script type ='text/javascript'> alert('Upload failed.')</script>";
          }

        }

        else{
          $validity = true;
        }
      */

        $_SESSION['customer_ph'] = "$phone";

          $sql = "INSERT INTO customer(item_name,country,fname,lname,address,city,state,pincode,email,phone,event0,event1,event2,event3) VALUES('$item_name','$country','$fname','$lname','$address','$city','$state','$pincode','$email','$phone','$event0','$event1','$event2','$event3')";

          $result = mysqli_query($conn,$sql);

          if($result){
            header("location:shipping_charge.php");
          }
          else{
            echo "<script type ='text/javascript'> alert('Upload failed.')</script>";
          }
    }
  
    $subtotal = 0;

?>

<!DOCTYPE html>
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" href="img/thesaruscompany-img&logo/thesaruslogo.png">

      <title>The SARUS | Customer Information</title>
      <link rel="stylesheet" href="css/common.css">
      <link rel="stylesheet" href="css/header.css">
      <link rel="stylesheet" href="css/gather_data.css">
      <link rel="stylesheet" href="css/popup.css">
    </head>

    <body>   
      <!--<center>
        <?php                   
          if($validity){
            echo '<span style="color:red;"> Invalid credentials</span>';
          }
        ?>
      </center>-->                    
          
            <div class="infogather">
                 <center> <div class="headname"  id="hd-size"> <h1> <span id="lgt-blue">The </span> <span id="drk-blue"> SARUS</span></h1> <div> </center>
                  <br>
                  <p> <span id="lgt-blue">Information</span>  <span id="drk-blue"> <b> > </b> </span>   <span id="grey">Shipping</span>  <span id="drk-blue"> <b> > </b> </span> <span id="grey">Payment</span> </p>
                  <!--44-->
                  <fieldset class="field_set">
                  <legend><h1 id="drk-blue">Billing details</h1></legend>  

                    <?php 
                      foreach($cartname as $ct){

                        $itmid = $ct->item_id;
                        $sql55 = "SELECT * FROM items WHERE item_id = '$itmid'";
                        $result55 = mysqli_query($conn,$sql55);
                        $singleRow55 = mysqli_fetch_row($result55);

                        $productprice = ($singleRow55[3])*($ct->quantity);
                        $subtotal  =  $subtotal + $productprice;
                    ?>

                    <div class="productdetails">

                      <div class="productsubdetails">
                        <?php echo"<image src='".$singleRow55[9]."' width='60px' height = '60px' style='border-radius: 10px'>"?>
                      </div>

                      <div class="productsubdetails">
                        <h3> <span id="lgt-blue"> <?php echo $singleRow55[1]; ?> </span> </h3>
                        <p id="lgt-blue"> &#8377;<?php echo $singleRow55[3]; ?> </p>
                        <p id="lgt-blue"> <?php echo $ct->quantity ?> pieces</p>
                      </div>

                    </div>


                    <?php
                      }
                    ?> 


                    <div class="prcdet">
                      <ul>
                        <li> <a>Sub total: &#8377; <?php echo $subtotal; ?></a> </li> 
                        <li> <a>Shipping charge: Calculated at next step </a> </li>
                        <li> <a>Total: &#8377; <?php echo $subtotal; ?> </a> </li>
                      </ul> 
                    </div> 
                  </fieldset>
     
                  <!--44-->
                  <fieldset class="field_set">
                    <legend><h1 id="drk-blue">Customer Information</h1></legend>
                    <form action="#" method="POST">
                      <div class="data_collection">
                        <p><span id="lgt-blue">*Enter details correctly as you cannot change it further<span></p>
                          
                          <div class="formgrid">

                            <div class="formgrid1">
                              <input type="text" id="country" name="country" placeholder="Country"  value ="India" required>
                            </div>
    
                            <div class="formgrid2">
                              <input type="text" id="fname" name="fname" placeholder="First Name" required>
                            </div> 

                            <div class="formgrid3">
                              <input type="text" id="lname" name="lname" placeholder="Last Name" required>
                            </div>

                            <div class="formgrid4">
                              <input type="text" id="address" name="address" placeholder="Address" required>
                            </div>
    
                            <div class="formgrid5">
                              <input type="text" id="city" name="city" placeholder="City" required>
                            </div>

                            <div class="formgrid6">
                              <!--<input type="text" id="state" name="state" placeholder="State" required>-->
                              <input type="text" id="state" name="state" placeholder="State" list="stateoption" required>
                                <datalist id="stateoption">
                                     <option value="Andhra Pradesh">Andhra Pradesh</option>
                                     <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                     <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                     <option value="Assam">Assam</option>
                                     <option value="Bihar">Bihar</option>
                                     <option value="Chandigarh">Chandigarh</option>
                                     <option value="Chhattisgarh">Chhattisgarh</option>
                                     <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                     <option value="Daman and Diu">Daman and Diu</option>
                                     <option value="Delhi">Delhi</option>
                                     <option value="Lakshadweep">Lakshadweep</option>
                                     <option value="Puducherry">Puducherry</option>
                                     <option value="Goa">Goa</option>
                                     <option value="Gujarat">Gujarat</option>
                                     <option value="Haryana">Haryana</option>
                                     <option value="Himachal Pradesh">Himachal Pradesh</option>
                                     <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                     <option value="Jharkhand">Jharkhand</option>
                                     <option value="Karnataka">Karnataka</option>
                                     <option value="Kerala">Kerala</option>
                                     <option value="Madhya Pradesh">Madhya Pradesh</option>
                                     <option value="Maharashtra">Maharashtra</option>
                                     <option value="Manipur">Manipur</option>
                                     <option value="Meghalaya">Meghalaya</option>
                                     <option value="Mizoram">Mizoram</option>
                                     <option value="Nagaland">Nagaland</option>
                                     <option value="Odisha">Odisha</option>
                                     <option value="Punjab">Punjab</option>
                                     <option value="Rajasthan">Rajasthan</option>
                                     <option value="Sikkim">Sikkim</option>
                                     <option value="Tamil Nadu">Tamil Nadu</option>
                                     <option value="Telangana">Telangana</option>
                                     <option value="Tripura">Tripura</option>
                                     <option value="Uttar Pradesh">Uttar Pradesh</option>
                                     <option value="Uttarakhand">Uttarakhand</option>
                                     <option value="West Bengal">West Bengal</option>
                                </datalist>
                            </div>

                            <div class="formgrid7">
                              <input type="number" id="pincode" name="pincode" placeholder="PIN code" oninput="myFuncValidPin(this.value)" required>
                              <p class ="warning" id="demo"></p>
                            </div>

    
                            <div class="formgrid8">
                              <input type="text" id="email" name="email" placeholder="Email" required>
                            </div>

                            <div class="formgrid9">
                              <input type="number" id="phone" name="phone" placeholder="Phone Number" oninput="myFuncValidPhone(this.value)" required>
                              <p class ="warning" id="demo1"></p>
                            </div>

                            <div class="formgrid10">
                              <center> <input type="submit" id="submit"  name="submit" value="Continue to shipping"> </center>
                            </div>

                          </div>
                      </div>
                    </form>

                    <hr>
                    <footer>
                        <center>
                            <button class="button" data-modal="modalOne">Refund Policy</button>
                            <button class="button" data-modal="modalTwo">Shipping Policy</button>
                            <button class="button" data-modal="modalThree">Private Policy</button>
                            <button class="button" data-modal="modalFour">Term and Condition</button>
                            
                            <div id="modalOne" class="modal">
                              <div class="modal-content">
                                <div class="contact-form">
                                  <span class="close">&times;</span>
                                  <form action="/">
                                    <center><h2>Refund Policy</h2></center>
                                    <ul>
                                        <li> <p><b>Cancellation by thesarus.in:</b> <br>
                                          Please note that there are some orders that we are unable to accept and they will be cancelled from our side. We reserve the right, to cancel the order for any reason. Like under any foreseen circumstances that may come in the way of your order that may be limitations on quantity available for purchase, error in product(s) or pricing information, or limitations of our credit department. We may also require information before accepting your order. We will contact you if in any case, your order is cancelled or any kind of information that is required to accept your order. If your order is cancelled after your credit card has been charged, the amount will be credited to your account within 4-5 working days.</p> </li>

                                        <li><p><b>Cancellations by the customer:</b>  <br>
                                          Product once purchased can cannot be cancelled as making of product starts after order is placed.</p></li>

                                         <li><p><b>For any queries you can contact us:</b> <br>
                                         Tel:   xxxxx xxxxx<br>
                                         E-mail: thesarus.in <br>
                                          
                                         Subscribe And Get Latest Updates & Offers</p></li>
                                      </ul>
                                  </form>
                                </div>
                              </div>
                            </div>
                            
                            
                            <div id="modalTwo" class="modal">
                              <div class="modal-content">
                                <div class="contact-form">
                                  <span class="close">&times;</span>
                                  <form action="/">
                                    <center><h2>Shipping Policy</h2></center>
                                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic inventore accusamus vitae amet, necessitatibus cumque quisquam tempore sit ab soluta corporis ducimus unde! Ducimus odio quisquam repudiandae sequi, quia eveniet similique quibusdam, ipsa nobis quis assumenda rem iusto animi aliquid neque tempora maiores quidem a. Ullam sit corrupti, a nesciunt incidunt sed iste soluta pariatur optio, id architecto, blanditiis neque? Ab consectetur numquam quidem omnis hic iusto eligendi. Optio quod ab magni velit earum possimus ullam dolorum deserunt delectus explicabo tenetur, deleniti dolores commodi dolore consectetur modi quas amet maxime expedita officia! Vel ut itaque fuga laborum delectus suscipit mollitia.</p>
                                  </form>
                                </div>
                              </div>
                            </div>
                            
                            
                            <div id="modalThree" class="modal">
                                <div class="modal-content">
                                  <div class="contact-form">
                                    <span class="close">&times;</span>
                                    <form action="/">
                                    <center><h2>Private Policy</h2></center>
                                      <ul>
                                        
                                        <li> <p>We assure you that your personal information is safe & secure at our hands and we won't share your personal information with third party for their marketing purpose without your clear approval and we only use your information as described in our Privacy Policy. Your privacy is our foremost concern.</p> </li>
                                        <li><p>thesarus.in reserves the rights to recover the cost of goods, collection charges from people using the Site fraudulently.</p></li>
                                        <li><p>We also reserve the rights to take legal action against such people for fake use of the Site and any other unlawful acts done against the terms and conditions of The SARUS.</p></li>

                                      </ul>
                                    </form>
                                  </div>
                                </div>
                            </div>
                            
                            
                            <div id="modalFour" class="modal">
                              <div class="modal-content">
                                <div class="contact-form">
                                  <span class="close">&times;</span>
                                  <form action="/">
                                    <center><h2>Terms and condition</h2></center>
                                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic inventore accusamus vitae amet, necessitatibus cumque quisquam tempore sit ab soluta corporis ducimus unde! Ducimus odio quisquam repudiandae sequi, quia eveniet similique quibusdam, ipsa nobis quis assumenda rem iusto animi aliquid neque tempora maiores quidem a. Ullam sit corrupti, a nesciunt incidunt sed iste soluta pariatur optio, id architecto, blanditiis neque? Ab consectetur numquam quidem omnis hic iusto eligendi. Optio quod ab magni velit earum possimus ullam dolorum deserunt delectus explicabo tenetur, deleniti dolores commodi dolore consectetur modi quas amet maxime expedita officia! Vel ut itaque fuga laborum delectus suscipit mollitia.</p>
                                  </form>
                                </div>
                              </div>
                            </div> 

                        </center>
                    </footer> 
            </div>

            
            </fieldset>

            <script>
                let modalBtns = [...document.querySelectorAll(".button")];
                modalBtns.forEach(function (btn) {
                  btn.onclick = function () {
                    let modal = btn.getAttribute("data-modal");
                    document.getElementById(modal).style.display = "block";
                  };
                });
                let closeBtns = [...document.querySelectorAll(".close")];
                closeBtns.forEach(function (btn) {
                  btn.onclick = function () {
                    let modal = btn.closest(".modal");
                    modal.style.display = "none";
                  };
                });
                window.onclick = function (event) {
                  if (event.target.className === "modal") {
                    event.target.style.display = "none";
                  }
                };
            </script>

            <script src="javascript/validity.js"></script>

    </body>
</html>