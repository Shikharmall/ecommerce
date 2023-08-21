<?php
    include 'connection.php';
    session_start();

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
      header("location:login_page.php");
      exit;
    }
    

    $brand = $_SESSION['brand'];
    $sql1 = " SELECT * FROM owner_login where brand = '$brand' ";
    $result1 = mysqli_query($conn,$sql1);
    $singleRow = mysqli_fetch_row($result1);

    /*if($_SESSION['desination'] == "owner"){*/
      $sql = "SELECT * FROM customer ORDER BY customer_id DESC;";
      $result = mysqli_query($conn,$sql);

      $sql55 = "SELECT * FROM items ";
      $result55 = mysqli_query($conn,$sql55);

   /* }*/
    
    /*else{
      $sql2 = " SELECT * FROM items where brand = '$brand' ";
      $result2 = mysqli_query($conn,$sql2);
      $singleRow1 = mysqli_fetch_row($result2);
      $item_no = $singleRow1['0'];
    
      $sql = "SELECT * FROM customer where item_id = '$item_no' ";
      $result = mysqli_query($conn,$sql);

      $sql55 = "SELECT * FROM items  where brand = '$brand' ";
      $result55 = mysqli_query($conn,$sql55);
    }*/

    if(isset($_POST['submit_item']))
      {   
        $item_name = $_POST['item-name'];
        $selling_price = $_POST['selling-price'];      
        $original_price = $_POST['original-price'];    
        $discount = $_POST['discount'];       
        $occasion = $_POST['occasion'];
        $color = $_POST['color'];
        $size = $_POST['size'];
  
        $file_name1 = $_FILES['image1']['name'];
        $file_tmp1 = $_FILES['image1']['tmp_name'];
        $folder1   = "upload-images-items/".$file_name1;
        move_uploaded_file($file_tmp1 , $folder1);
  
        $file_name2 = $_FILES['image2']['name'];
        $file_tmp2 = $_FILES['image2']['tmp_name'];
        $folder2   = "upload-images-items/".$file_name2;
        move_uploaded_file($file_tmp2 , $folder2);
  
        $file_name3 = $_FILES['image3']['name'];
        $file_tmp3 = $_FILES['image3']['tmp_name'];
        $folder3   = "upload-images-items/".$file_name3;
        move_uploaded_file($file_tmp3 , $folder3);
  
        
        $des1 = $_POST['des1'];
        $des2 = $_POST['des2'];
        $des3 = $_POST['des3'];
        $des4 = $_POST['des4'];
        
        $item_type = $_POST['item-type'];
        $stock_status = $_POST['stock-status'];
  
        $sql_insert = "INSERT INTO items(item_name,original_price,selling_price,discount,occasion,brand,Colour,size,img1,img2,img3,des1,des2,des3,des4,item_type,stock) VALUES('$item_name','$original_price','$selling_price','$discount','$occasion','$brand','$color','$size','$folder1','$folder2','$folder3','$des1','$des2','$des3','$des4','$item_type','$stock_status')";
  
        $result_insert = mysqli_query($conn,$sql_insert);
  
        if($result_insert){
          header("location:Owner_dashboard.php");
        }
        else{
          echo "<script type ='text/javascript'> alert('Upload failed.')</script>";
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
    <title>Owner Dashboard</title>
    <link rel = "stylesheet" href="css/Owner_dashboard.css">
    <link rel = "stylesheet" href="css/common.css">
    <link rel = "stylesheet" href="css/popupbyowner.css">
  </head>


  <body>
    
    <!--heading-->
      <div class="heading">
        <div class="heading1"> <a href="tracking_system.php" target="blank"> Track Consignment Status</a> </div>
        <div class="heading2"> <h1> <span id="lgt-blue">The </span> <span id="drk-blue"> SARUS</span> <h1> </div>
        <div class="heading3"> <a href="logout.php">LogOut</a> </div>
      </div>
    <!--heading-->
    
    <!--buttons-->   
      <div class="settings">

        <input type="button" onclick="printDiv('printcust')" value="Print PDF" id="printpdf"/>
        <button class="button"> <a href="export.php"> <b>Export</b></a> </button>

        <button class="button" data-modal="modalOne"> <b>Check Item List</b> </button>
        <button class="button" data-modal="modalTwo"> <b>Add Item</b> </button>

            <div id="modalOne" class="modal">
                <div class="modal-content">
                  <div class="contact-form">
                    <span class="close">&times;</span>
                    <form action="/">
                      <center><h2 id="drk-blue">Item List</h2></center>

                      <br>
                      <br>

                      <div id="printitm">

                        <table border="1px">
                        <tr>
                            <th>Item name</th>
                            <th>Selling Price <br> (Original Price) - Discount</th>
                            <th>Ocassion</th>
                            <th>Brand</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Images</th>
                            <th>Description</th>
                            <th>Item Type</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                        <?php
                          while($info=$result55->fetch_assoc())
                          {
                        ?>

                        <tr>
                            <td><?php echo"{$info['item_name']}" ; ?> </td>

                            <td><?php echo"Rs.{$info['selling_price']}" ; ?> <br> (<strike><?php echo"Rs.{$info['original_price']}" ; ?></strike>) - <?php echo"{$info['discount']}%" ; ?> </td>

                            <td><?php echo"{$info['occasion']}" ; ?> </td>

                            <td><?php echo"{$info['brand']}" ; ?> </td>

                            <td><?php echo"{$info['Colour']}" ; ?> </td>

                            <td><?php echo"{$info['size']}" ; ?> </td>

                            <td>
                              <?php echo"<image src='".$info['img1']."' width='100px' height = '100px' style='margin:1px'>" ?> <br>
                              <?php echo"<image src='".$info['img2']."' width='100px' height = '100px' style='margin:1px'>" ?> <br>
                              <?php echo"<image src='".$info['img3']."' width='100px' height = '100px' style='margin:1px'>" ?> 
                            </td>

                            <td>
                              1. <?php echo"{$info['des1']}" ; ?> <br>
                              2. <?php echo"{$info['des2']}" ; ?> <br>
                              3. <?php echo"{$info['des3']}" ; ?> <br>
                              4. <?php echo"{$info['des4']}" ; ?>
                            </td>

                            <td><?php echo"{$info['item_type']}" ; ?> </td>

                            <td><?php echo"{$info['stock']}" ; ?> </td>

                            <td> <button>Edit</button> </td>
                        </tr>

                        <?php
                          } 
                        ?>
                        </table>

                      </div>  
                    </form>
                  </div>
                </div>
            </div>

            <div id="modalTwo" class="modal">
                <div class="modal-content">
                  <div class="contact-form">
                    <span class="close">&times;</span>

                    <!--<form action="import.php" method="post" name="upload_excel" enctype="multipart/form-data">
                      <input type="file" name="file" id="file">
                      <button class="button" name="Import"> <b>Import</b></button>
                    </form>-->

                    <form action="" method="POST" enctype="multipart/form-data">
                      <center><h2 id="drk-blue">Add Items</h2></center>
                      


                      <center>
                      <div class="formgrid">

                            <div class="formgrid1">
                              <input type="text" id="item-name" name="item-name" placeholder="Item Name" required>
                            </div>
    
                            <div class="formgrid2">
                              <input type="number" id="selling-price" name="selling-price" placeholder="Selling Price(₹)" required>
                            </div> 

                            <div class="formgrid3">
                            <input type="number" id="original-price" name="original-price" placeholder="Original Price(₹)" required>
                            </div>

                            <div class="formgrid4">
                              <input type="number" id="discount" name="discount" placeholder="Discount(%)" required>
                            </div>
    
                            <div class="formgrid5">
                              <input type="text" id="ocassion" name="occasion" placeholder="Ocassion" required>
                            </div>

                            <div class="formgrid6">
                              <input type="text" id="color" name="color" placeholder="Color(multi if involves many colors)" required>
                            </div>

                            <div class="formgrid7">
                              <input type="text" id="size" name="size" placeholder="Size(cm/m)" required>
                            </div>

                            <div class="formgrid8">

                            <fieldset class="field_set">
                            <legend><h3 id="drk-blue">Insert Product Images</h3></legend>

                                <p id="grey">Insert image of dimension (1897 X 625)px (First Image will be given high priority.)</p>
                                <input type="file" id="image1" name="image1" placeholder="image1" required>

                                <input type="file" id="image2" name="image2" placeholder="image2" required>
                              
                                <input type="file" id="image3" name="image3" placeholder="image3" required>
  
                            </fieldset>
                            </div>

                            <div class="formgrid11">
                              <textarea placeholder="Write first description of your product."  name="des1" required="required" "></textarea>
                            </div>

                            <div class="formgrid12">
                              <textarea placeholder="Write second description of your product."  name="des2" required="required" "></textarea>
                            </div>

                            <div class="formgrid13">
                              <textarea placeholder="Write third description of your product."  name="des3" required="required" "></textarea>
                            </div>

                            <div class="formgrid14">
                              <textarea placeholder="Write fourth description of your product."  name="des4" required="required" "></textarea>
                            </div>

                            <div class="formgrid15">
                              <select id="item-type"  name="item-type">
                                <optgroup label=" --- Item Type --- ">
                                <option value="Cards">Cards</option>
                                <option value="Shirts">Shirts</option>
                              </select>
                            </div>

                            <div class="formgrid16">
                              <select id="stock-status" name="stock-status">
                                <optgroup label=" --- Stock Status --- ">
                                <option value="In Stock">In Stock</option>
                                <option value="Out Of Stock">Out of Stock</option>
                              </select>
                            </div>

                            <div class="formgrid17">
                              <center> 
                                <input type="submit" id="submit_item"  name="submit_item" value="Add"> 
                              </center>
                            </div>

                        </div>
                      </center>    
                    </form>
                  </div>
                </div>
            </div>

      </div>
    <!--buttons-->    


    <!--greetings-->   
      <h3> <span id="lgt-blue"></span> <span id="drk-blue"> <?php echo $singleRow['4']; ?> </span> </h3>
      <h3 id="lgt-blue">Hello - <span id="drk-blue"><?php echo $singleRow['3']; ?></span></h3>
    <!--greetings-->

    <!--customers detail table-->
      <div id="printcust">
        <center>
          <table border="1px">
                <tr>
                  <th>S.No</th>
                  <th>Customer Id (Tracking Id)</th>
                  <th>Item name(Quantity)</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>City, State</th>
                  <th>Country, Pincode</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Payment status(Amount Recieved)</th>
                  <th>Total Amount Recieved</th>
                  <th>Payment Recieved</th>
                  <th>Packed</th>
                  <th>Shipped</th>
                  <th>Delivered</th>
                </tr>

                <?php
                  $a = 0 ;

                  while($info=$result->fetch_assoc())
                  {
                    $a = $a + 1;
                ?>

                <tr>
                    
                  <td><?php echo $a ; ?></td>
                  <td><?php echo"{$info['consignment_no']}" ; ?></td>
                  <td>
                    <?php
                      $items = $info['item_name'];
                      $items = json_decode($items);
                      foreach($items as $itm){
                        echo $itm->item_name;
                        echo "(".$itm->quantity.")<br>";
                      }
                    ?>
                  </td>
                  <td><?php echo"{$info['fname']}" ; ?> <?php echo"{$info['lname']}" ; ?></td>
                  <td><?php echo"{$info['address']}" ; ?></td>
                  <td><?php echo"{$info['city']}" ; ?>, <?php echo"{$info['state']}" ; ?> </td>
                  <td><?php echo"{$info['country']}" ; ?> , <?php echo"{$info['pincode']}" ; ?></td>
                  <td><?php echo"{$info['email']}" ; ?></td>
                  <td><?php echo"{$info['phone']}" ; ?></td>
                  <td><?php echo"<image src='".$info['receipt']."' width='100px' height = '100px'>" ?></td>
                  <td>Total Price: &#8377;<?php echo"{$info['total']}" ; ?> (Shipping Charge: &#8377;<?php echo"{$info['shipping_charge']}" ; ?>)</td>

                  <td>
                    <button class="donetickpayment" data-id="<?php echo $info['customer_id'] ?>">Payment recieved</button> 
                  </td>

                  <td>
                      <?php
                        if($info['event1'] == '0'){
                      ?> 
                          <button class="donetickpacked" data-id="<?php echo $info['customer_id'] ?>" style="background-color: red; color: white;">Not Packed</button>
                          <?php
                        }
                        else{
                          ?>
                          <button class="donetickpacked" data-id="<?php echo $info['customer_id'] ?>" style="background-color: green; color: white;">Packed</button> 
                      <?php
                        }
                      ?>
                  </td>
                    
                  <td>
                    <button class="donetickshipped" data-id="<?php echo $info['customer_id'] ?>">Shipped</button> 
                  </td>
                    
                  <td>
                    <button class="donetickdelivered" data-id="<?php echo $info['customer_id'] ?>">Delivered</button> 
                  </td>

                </tr>

                <?php
                  } 
                ?>

          </table>
        </center>
      </div>  
    <!--customers detail table--> 

    <script src="javascript/login.js"></script>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>

      $(document).ready(function(){


        $(".donetickpayment").on("click" , function(e){

          e.preventDefault();
          var hidden_cust_id = $(this).data("id");

          $.ajax({
            url : "done_tick1.php",
            type : "POST",
            data : {hid_cust_id: hidden_cust_id},
            success : function(data){
              //loadTable();
              alert("PAYMENT CHECKED");
            }
          });
        });


        $(".donetickpacked").on("click" , function(e){

          e.preventDefault();
          var hidden_cust_id = $(this).data("id");

          $.ajax({
            url : "done_tick2.php",
            type : "POST",
            data : {hid_cust_id: hidden_cust_id},
            success : function(data){
              //loadTable();
              alert("PACKING CHECKED");
            }
          });
        });

        $(".donetickshipped").on("click" , function(e){

          e.preventDefault();
          var hidden_cust_id = $(this).data("id");

          $.ajax({
            url : "done_tick3.php",
            type : "POST",
            data : {hid_cust_id: hidden_cust_id},
            success : function(data){
              //loadTable();
              alert("SHIPPING CHECKED");
            }
          });
        });


        $(".donetickdelivered").on("click" , function(e){

          e.preventDefault();
          var hidden_cust_id = $(this).data("id");

          $.ajax({
            url : "done_tick4.php",
            type : "POST",
            data : {hid_cust_id: hidden_cust_id},
            success : function(data){
              //loadTable();
              alert("DELIVERY CHECKED");
            }
          });
        });



      });

    </script>

    <script type="text/javascript">
      function printDiv(printcust) {
        var printContents = document.getElementById(printcust).innerHTML;
        var originalContents = document.body.innerHTML;
  
        document.body.innerHTML = printContents;
  
        window.print();
  
        document.body.innerHTML = originalContents;
      }
    </script>

  </body>
</html>