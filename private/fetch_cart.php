<?php

//print_r($_SESSION);
 require_once('initialize.php');

 //session_start();

 $total_price = 0;
 $total_item = 0;
 $output ='';
 //$path = url_for('products/prod_img');

 if(!empty($_SESSION["shopping_cart"]))
 {

   foreach ($_SESSION["shopping_cart"] as $keys => $values)
   {

     $output .='
     <li class="item_cart_info">
       <img class="first_item_cart_info" src='.$values["product_image"].'>
       <div class="about_item_container">
         <h3>'.$values["product_name"].'</h3>
         <span>'.$values["product_descr"].'</span>
         <span>'.$values["product_price"].'€</span>
         <a id="'.$values["product_id"].'" class="delete_cart" href="#">Supprimer</a>
       </div>
     </li>
     ';

     $total_price += $values["product_price"];
   }
 }

 echo $output;

 ?>
