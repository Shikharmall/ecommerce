<?php
  include 'connection.php';
  session_start();
  if(!isset($_SESSION['customer_ph'])){
    header("location:thesarus.php");
    exit;
  }

  /*as we are taking phone number as session , so after rebacking on previous page and changing the pincode , phone number will be same and we will get two tr in table and first duplicate phone number would be taken*/

  $cartname = isset($_COOKIE["cartname"]) ? $_COOKIE["cartname"] : "[]";
  $cartname = json_decode($cartname);

  $subtotal = 0;
?>


<!DOCTYPE html>
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" href="img/thesaruscompany-img&logo/thesaruslogo.png">

      <title>The SARUS | Shipping Charge</title>
      
      <link rel="stylesheet" href="css/common.css">
      <link rel="stylesheet" href="css/header.css">
      <link rel="stylesheet" href="css/shipping_charge.css">
      <link rel="stylesheet" href="css/popup.css">
    </head>

    <body> 
      <center> 
        <div class="headname" id="hd-size"> <h1> <span id="lgt-blue">The </span> <span id="drk-blue"> SARUS</span></h1> <div> 
      </center>
      <br>
      
      <div class="navigator">
       <p> <span id="grey">Information</span>  <span id="drk-blue"> <b> > </b> </span>   <span id="lgt-blue">Shipping</span>  <span id="drk-blue"> <b> > </b> </span> <span id="grey">Payment</span> </p>
      </div>
      
       
      <div class="infodt">
        <div class="infod"  id="infod-right">
                
          <?php
                      
            $phone = $_SESSION['customer_ph']; 
            $sql = "SELECT * FROM customer where phone = '$phone' ";
            $result = mysqli_query($conn , $sql);
            $singleRow = mysqli_fetch_row($result);

            $_SESSION['customer_id'] = $singleRow['0'];


            $custid =  $singleRow['0'];
            $x = 'BAB';
            $y = 'EE';
            $z = $x.$custid.$y;
            $sql1 = " UPDATE customer  SET consignment_no = '$z'  where customer_id = '$custid' ";
            $result5 = mysqli_query($conn,$sql1);

            /*taking first digit of pincode to decide the price of shipment*/
            $pin = $singleRow['8'];
            $s = $pin;
            while ($s >= 10)
            {
              $s = $s/10;
            } 
            $a = (int)$s;

          ?>

                <center>
                  <table>
                    <tr>
                      <th>Contact </th>
                      <td> <?php echo $singleRow['10']; ?> </td>
                    </tr>
                    <tr>
                      <th>Ship to</th>
                      <td><?php echo $singleRow['5']; ?> , <?php echo $singleRow['8']; ?> <?php echo $singleRow['6']; ?> <?php echo $singleRow['7']; ?> ,<?php echo $singleRow['2']; ?></td>
                    </tr>
                    
                    <tr>
                      <th>Method</th>
                      <td>Standard . <b>&#8377;<?php 

                      //for 51-200grm from gkp
                      if($a == 1 || $a == 2 || $a == 3 || $a == 4 || $a == 7){
                        $shipping_price = 60;
                        echo "60"; //delhi,haryana,punjab,j&k,himachal pradesh,UP , uttarakhand,guj,rajasthan,maharasthra,mp,chattisgarh,seven sisters....
                      }

                      else if($a == 5 || $a == 6){
                        $shipping_price = 70;
                        echo "70"; //tel,andra prad,karnataka,kerala,tamil nadu....
                      }

                      else if($a == 8){
                        $shipping_price = 40;
                        echo "40"; //bihar,jharkhand
                      }
                      
                      else if ($a == 9){
                        $shipping_price = 100;
                        echo "100"; //army zone....
                      }
                      
                      
                      ?></b></td>
                    </tr>
                  </table>
                </center>

                    <br> <br>
                    
                    <center>
                      <div class="btn">
                        <a href="payment.php">Continue to payment</a>
                      </div> 
                    </center>

                    <br> 
    

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
                                         Tel: xxxxx xxxxx<br>
                                         E-mail: thesarus.in<br>
                                          
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
                                  <ul>   
                                    <li><p><b>How long product will take to deliver my order?</b>  <br>
                                    Orders to Metro cities in India will get delivered in 1-2 working days and to the interiors may take at least 3-4 working days (excluding Sundays and other Holidays). All orders are shipped from our warehouse, after your payment is cleared.</p> </li> 
                                       
                                    <li><p><b>Are there any shipping charges on Archies products?</b> <br>  
                                    We provide you with standard rates and our shipping charges are based on volume of the particular product(s) and you can also view the shipping charges on every product(s) in view details section. Octroi charges if any will be collected from the consignee.</p></li>
                                     <li><p><b>What if my order gets delayed? </b><br>
                                     Orders can be delayed due to product un-availability for immediate dispatch. Wherein the stocks are still getting ready with packaging and pricing being done on the whole lot or in transit from the Warehouse to the Head office. This could put a delay in the dispatch of the on line order.
                                    </p></li>
                                     <li><p><b></b><br></p></li>
                                     <li><p><b></b><br></p></li>
                                     <li><p><b>Please note:</b><br>   
                                       
                                       Buttons and Bows will not cover delivery delays due to customer unavailability or if the given address is not valid. To avoid further error or delays in shipment you are requested to submit your correct & complete details of your address followed by pincode/landmark & valid phone  number.</p></li>
                                       
                                      
                                     
                                       
                                    What should I do if I have received a different order?   
                                    In case you have received a different product, or if the product was damaged in shipment, please contact us within 48hours after delivery through e-mail (helpdesk@archiesonline.com) or customer care service 011- 4141 0060 and we will ensure that it will be replaced as soon as    possible.
                                       
                                    Fresh Flowers Disclaimer 
                                    
                                    <ul>
                                    <li>We CANNOT commit any fix time for delivery as mentioned in Special Instructions or otherwise. Deliveries will be made between 9 am to 7 pm on the given date.</li> 
                                       
                                    <li>Orders received till 4:00pm will be delivered on same day unless delivery date in mentioned.</li>   
                                       
                                    Orders cannot be cancelled or modified after dispatch.   
                                       
                                    We deliver on Sundays also.   
                                       
                                    We will attempt delivery of the items once. In case the delivery is not executed during the attempt, due to wrong address/recipient not available/premises locked/recipient refused the order, the customer shall still be charged for the order.   
                                       
                                    Please note that Flowers, Cakes and other perishable products are sourced locally at the delivery location & will be hand delivered.   
                                       
                                    No Deliveries on National Holidays.   
                                       
                                    The image displayed in indicative in nature. Actual product may vary in shape or design as per the availability.   
                                       
                                    If, for any reason, the delivery is "refused by recipient", the order will be considered as delivery attempted and no refund / change of order is acceptable in this case. We, however, will try our best to convince the recipient for accepting the delivery.   
                                       
                                    For Courier Products   
                                    Orders will be delivered within 1-2 working days in Metro cities & 3-4 Tier II and III.   
                                       
                                    We work with various 3 PL service providers. your order will be dispatched with the fastest service available with the provider.   
                                       
                                    <li>Deliveries on National Holidays and Sundays.</li> 
                                       
                                    <li>Courier and express product cannot be delivered together at same time. </li>  
                                       
                                    <li>We cannot commit exact date of delivery for courier products. Courier product will reach in advance/late within 3-5 days as per date of delivery.</li>
                                  </ul>
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
                                        <li><p>buttonsandbows.in reserves the rights to recover the cost of goods, collection charges from people using the Site fraudulently.</p></li>
                                        <li><p>We also reserve the rights to take legal action against such people for fake use of the Site and any other unlawful acts done against the terms and conditions of Buttons and Bows.</p></li>
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
                                           <p>The following document is in your benefit, while you are accessing the site and its services       provided to you. Please keep in mind certain terms & conditions.

                                              Introduction: Archiesonline.com is a website providing services all over India and sending you incredible lovely gifts & cards at your doorstep. All products, services and information displayed on archiesonline.com are to put forward your order that you buy which shall be subject to the terms and conditions as listed below. Archiesonline.com reserves the rights to accept or reject your order and inform you by email regarding the confirmation of your order. After verifying your contact details, we will process your order.
                                              
                                              Membership
                                              Only members can use the site by signing in and assured of approving the terms & conditions of the company.
                                              
                                              For opting membership your age should be 18 years or, over and If you are a minor i.e. under the age of 18 years but at least 13 years of age you may use this Site only under the supervision of your parents or legal guardian who agrees with the Terms & conditions.
                                              
                                              Archiesonline.com reserves the rights to end your membership and refuse to provide you with the authority to use the Site, if we find any unfavorable act against the company.
                                              
                                              In future the site will not be available to a person whose membership has been terminated by archiesonline.com for any reason.
                                              
                                              If you are registering as a businessperson, you must show that you have authority to join the unit to this User Agreement. Unless specified the materials on this website are directed solely at those who access this website from India.
                                              
                                              Those who choose to access the Site from outside India are responsible for compliance with local laws. By using the services of archiesonline.com you agree with the Terms and Conditions.
                                              
                                              Pricing Information
                                              Archiesonline.com provides you a true value of a product and its information, (pricing errors may occur).
                                              
                                              If in case, your order is not dispatched and an incorrect information has occurred due to an error in pricing or product(s) information, your order will not be considered and we reserve the rights, to cancel the order for any reason and revert back to you through e-mail.
                                              
                                              If we accept your order, the difference in amount will be credited to your account and you will be informed through email, that the payment has been processed.
                                              
                                              The payment may be processed prior to archiesonline.com dispatch of the product that you have ordered.
                                              
                                              If we have to cancel the order after we have processed the payment, the said amount will be reversed back to your credit card account.
                                              
                                              We provide you with the best low prices possible on archiesonline.com as well as in all our Stores under the corporate Archies Limited.
                                              
                                              Refund Policy
                                              Cancellation by Archiesonline.com:
                                              
                                              Please note that there are some orders that we are unable to accept and they will be cancelled from our side.
                                              
                                              We reserve the right, to cancel the order for any reason. Like under any foreseen circumstances that may come in the way of your order that may be limitations on quantity available for purchase, error in product(s) or pricing information, or limitations of our credit department.
                                              
                                              We may also require information before accepting your order. We will contact you if in any case, your order is cancelled or any kind of information that is required to accept your order.
                                              
                                              If your order is cancelled after your credit card has been charged, the amount will be credited to your account within 4-5 working days.
                                              
                                              Credit Card Details
                                              If you are paying via credit card, remember that in a credit card transaction you must use your own credit card.
                                              
                                              You must give the correct information of your credit card details to us. We assure you that in future the given information will not be shared from our side.
                                              
                                              In any case, it will be not our responsibility for any credit card scam. Unless law requires the responsibility from our side with any of the third party also the use of a card falsely will count on your part.
                                              
                                              Fraudulent Transactions
                                              Privacy Policy : We assure you that your personal information is safe & secure at our hands and we won't share your personal information with third party for their marketing purpose without your clear approval and we only use your information as described in our Privacy Policy. Your privacy is our foremost concern.
                                              
                                              Archiesonline.com reserves the rights to recover the cost of goods, collection charges from people using the Site fraudulently.
                                              
                                              We also reserve the rights to take legal action against such people for fake use of the Site and any other unlawful acts done against the terms and conditions of the company.
                                              
                                              Site Security
                                              For security purpose it is strictly prohibited to use the site illegally, like using data not anticipated for you.
                                              
                                              If you are trying to obstruct the services of any other user by means of putting a virus on Site, overloading, "spamming," "mail bombing" or sending unwanted e-mail's, disobedience of system or network security is against legal responsibility and major actions will be taken by the authorities for obstructing the services.
                                              
                                              You cannot use any device, software or routine to hold up or attempt to interfere with the proper working of the Site or any activity being conducted on the Site.
                                              
                                              Colours
                                              The colours of product(s) that appear on Site are accurate. However, we cannot guarantee that your monitor's display the same accurate colours or not.
                                              
                                              Not recommended by the site
                                              
                                              You are not permitted to use the site illegally, that is in advance using illegally to other computer systems.
                                              
                                              Passing on electronic copies of material confined by copyrights without the permission of the owner.
                                              
                                              Interfering or disrupting networks or web sites connected to the Site. Disobeying any law which is not in favor of the company.
                                              
                                              Entire Agreement
                                              If we fail to act with respect to a fall foul by you or others, does not ignore its rights to act with respect to following or similar violation that means the entire agreement between you and archiesonline.com with respect to all its services and its achievements and all former proposals, whether electronic, oral or written.
                                              
                                              Termination
                                              You may lapse the Agreement with archiesonline.com at any time, and from that time you won't be able to continue to use the services of the Site.
                                              
                                              Also, archiesonline.com has right to terminate this User Agreement at any time and may do so directly without notice, and accordingly disallow you to access the Site, Such termination will be without any legal responsibility to archiesonline.com.
                                              
                                              This User Agreement is of use unless and until terminated by either you or archiesonline.com.
                                              
                                              You Agree and Confirm
                                              In case if you have given us incomplete information of delivery (i.e. wrong name or address) extra charges will be taken from you.
                                              
                                              Archiesonline.com reserves the rights to confirm the information and other details provided by you at any time, and if your given information is not correct, we reserve the rights to reject your request of the given address or information.
                                              
                                              When placing an order for a product you agreed with the conditions of sale, which is included in the item(s) description and you are using the services available on this Site and transacting at your own responsibility.
                                              
                                              Modification of Terms and conditions of Service
                                              Archiesonline.com can any time modify the User Agreement without any prior notification to its customers.
                                              
                                              We will inform you about the changes in the User Agreement via e-mail that is provided by you while registering on archiesonline.com.
                                              
                                              You should regularly review the User Agreement on archiesonline.com. In case modified User Agreement is not satisfactory to you, you should discontinue using the services.
                                              
                                              However, if you continue to use the services, you shall be considered to have agreed with the terms & conditions and abide by the modified User Agreement.
                                              
                                              Account and Registration Obligations
                                              The information that you give us at the time of registration of buying or listing process, through e-mail must be clear and correct.
                                              
                                              We assure you that your information is safe in our hands at the same time you are requested for maintaining the confidentiality of your account and Password and for restricting access to your computer.
                                              
                                              We shall not be responsible for any loss, which may arise as a result of any failure from your side to protect your password or account.
                                              
                                              Reviews, Feedback, Submissions
                                              Archiesonline.com reverses the rights of all reviews, feedback, while accessing the site. You agree that any Comments submitted by your side on the site will not break this policy or any right of the third party, including copyrights, trademark, privacy, will not create any kind of illegal or disturbance to any person. Comments given by you on the site will not contain any illegal material, or any software viruses, form of Spam etc.
                                              
                                              Third Party Selling
                                              You are requested to follow certain Terms & Conditions related to the products that you buy or sell on archiesonline.com by third party seller.
                                              
                                              Archiesonline.com will not be able to manage the transactions of the dealers, when you buy products from dealers on the Site you must follow certain terms & conditions.
                                              
                                              We are not responsible for any break up of contract done between you and the dealer.
                                              
                                              We cannot guarantee that the third party will execute the transaction accomplished on the Site or of the quality, pricing marketing etc. of the items offer to be sold on the Site by their side.
                                              
                                              Archiesonline.com or their employees who are connected with the company are not responsible for any damage, liability or for any actions of the dealers on the Site.
                                              
                                              If you find third party information offensive, inaccurate, or deceptive, please use security measures and do safe trading while using the Site.
                                              
                                              Please note that there are also risks of dealing with foreign nationals and people found to be foul.
                                              
                                              You are requested not to use a fake email address or wrong information for remarks that you will submit.
                                              
                                              Indemnity
                                              If any kind of damage or loss is done from your side or from the third party, archiesonline.com or its employees are not responsible for any kind of claims. When you are agree to the terms and conditions of the company you are liable of all the claims done by you or the third party who deals with you. If there is non-fulfillment of any of your requirement under the User Agreement that is a unpaid statutory due and tax, violation of rights of privacy or publicity or intellectual property, loss of services by other subscribers or any other rights. This clause will terminate the User Agreement.
                                              
                                              Limitation of Liability and Disclaimers
                                              The Board of Directors/senior management of the Company has power to modify or replace the Code, as they may consider essential from time to time in their absolute discretion. Company will not be responsible for the risks associated while using the Site.
                                              
                                              The Site provides content from other Internet sites or resources and while we try to make sure that material included on the Site is correct, reputable and of high quality, it cannot accept responsibility.
                                              
                                              Archiesonline.com is not responsible for any errors or for the results found from the use of such information or for any technical problems you may experience in the future while accessing the site.
                                              
                                              Archiesonline.com and its associates make no assurance about the accuracy, reliability, correctness of any content, information, software, text, graphics, links or communications provided on the use of the Site or the function of the Site will be uninterrupted.
                                              
                                              Thus, archiesonline.com consider no legal responsibility, whatsoever for any financial or other damages from your side for account delay, failure, interruption, or corruption of any data or any interruption in the function of the Site.
                                              
                                              Copyright & Trademark
                                              Archiesonline.com and its suppliers reserve the rights in all text, programs, products, processes and other materials, which appear on the Site.
                                              
                                              All rights, including copyrights, on the site are owned and licensed to Archies limited. Any use of the site or its content without our authorization, including copying or storing it, for your own personal or for the non-commercial use is prohibited.
                                              
                                              You cannot modify anything on the site for any purpose.
                                              
                                              Name and logo of archiesonline.com and all related products and service names, design marks and slogans are the trademarks/service marks of Archies Ltd.
                                              
                                              All other marks are property of their respective companies.
                                              
                                              No trademark or service mark license is granted in connection with the materials contained on the Site.
                                              
                                              We are not responsible for the content of any third party site and not make any depiction regarding the content or precision of material on such site.
                                              
                                              If you decide to link to any such third party website, you do so entirely at your own risk.
                                              
                                              All materials, including images, text, illustrations, designs, icons, photographs, programs, music clips or downloads, video clips and written and other materials that are part of the Site are intended only for personal, non-commercial use.
                                              
                                              You may download or copy the Contents and other downloadable materials displayed on the Site for your personal use only.
                                              
                                              No right, title or interest in any downloaded materials or software is transferred to you as a result of any such downloading or copying.
                                              
                                              All software used on the Site is the property of archiesonline.com or its suppliers and protected by Indian and international copyright laws.

                                            The collection of all Contents on the Site is exclusive property of archiesonline.com and is also protected by privacy and copyright laws.</p>
                                  </form>
                                </div>
                              </div>
                            </div> 
                        </center>
                    </footer> 
            </div>

            <div class="infodb"></div>
    
            <div class="infod">
                    <h1 id="lgt-blue">Billing amount</h1>

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

                    <h3> <span id="lgt-blue">Sub total  &#8377;<?php echo $subtotal ?>  </span> </h3>

                    <h3 id="lgt-blue">Shipping &#8377;<?php  echo $shipping_price; ?> </h3>

                    <h3 id="lgt-blue">Total INR &#8377;
                      <?php 
                        $_SESSION['shipping_price'] = $shipping_price;
                        $finalamount = $subtotal + $shipping_price;
                        $_SESSION["finalamount"] = $finalamount;
                        echo $finalamount;
                      ?>
                    </h3> 

                    <br>

            </div>

      </div>  
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


    </body>
</html>