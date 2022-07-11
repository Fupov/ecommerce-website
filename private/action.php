<?php

 session_start();

if(isset($_POST["action"]))
{
  if($_POST["action"] == "add")
  {

    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];
    $product_image = $_POST["product_image"];
    $product_descr = $_POST["product_descr"];



    $item_array = array("product_id" => $product_id,"product_name" => $product_name,"product_price" => $product_price,"product_image" => $product_image,"product_descr" => $product_descr);

    $_SESSION["shopping_cart"][$product_id] = $item_array;
    $_SESSION["shopping_cart_total"] += $product_price;

    //print_r($_SESSION["shopping_cart"][$product_id]);

  }
  if($_POST["action"] == "remove")
  {
    $product_id = $_POST["product_id"];
    $item_array_remove = $_SESSION["shopping_cart"][$product_id];
    $_SESSION["shopping_cart_total"]-= $item_array_remove["product_price"];
    unset($_SESSION["shopping_cart"][$product_id]);

  }



}

?>
