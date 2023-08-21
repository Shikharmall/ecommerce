<?php

  include 'connection.php';

  $item_id = $_POST["item_id"];

  $cart = isset($_COOKIE["cart"])  ? $_COOKIE["cart"] : "[]" ;
  $cart = json_decode($cart);
  $new_cart = array();

 
  $sql = " SELECT * FROM items where item_id = '$item_id' "; 
  $result = mysqli_query($conn , $sql);
  $singleRow = mysqli_fetch_row($result);
  $item_name = $singleRow[1];
  
  $cartname = isset($_COOKIE["cartname"])  ? $_COOKIE["cartname"] : "[]" ;
  $cartname = json_decode($cartname);
  $new_cartname = array();


  foreach($cart as $c){

    if($c->item_name != $item_name){
      array_push($new_cart , $c);
    }

  }

  foreach($cartname as $cn){
   
    if($cn->item_id!= $item_id){
      array_push($new_cartname , $cn);
    }

  }

  setcookie("cart" , json_encode(($new_cart)));

  setcookie("cartname" , json_encode(($new_cartname)));

  header("Location: thesarus.php")
  
?>