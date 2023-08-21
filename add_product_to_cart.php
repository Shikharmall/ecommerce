<?php

   include 'connection.php';

   $item_id = $_POST["item_id"];
   $qty = $_POST["quantity"];

   $cart = isset($_COOKIE["cart"])  ? $_COOKIE["cart"] : "[]" ;
   $cart = json_decode($cart);

   $cartname = isset($_COOKIE["cartname"])  ? $_COOKIE["cartname"] : "[]" ;
   $cartname = json_decode($cartname);

   $reslt = mysqli_query($conn , "SELECT * FROM items WHERE item_id = '$item_id'");
   $product = mysqli_fetch_object($reslt);

   $output = mysqli_query($conn , "SELECT * FROM items WHERE item_id = '$item_id'");
   $singleRow = mysqli_fetch_row($output);

   array_push($cart , array(
      "item_name" => $singleRow[1],
      "quantity" => $qty
   ));

   array_push($cartname , array(
      "item_id" => $item_id,
      "quantity" => $qty
   ));

   setcookie("cart" , json_encode(($cart)));

   setcookie("cartname" , json_encode(($cartname)));

   header("Location: products.php")

?>