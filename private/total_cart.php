<?php

 session_start();
 $output ='';

  //if($_POST["action"] == "total_price")
  //{

    $output .= '
    <span id="total_price">Total : '.$_SESSION["shopping_cart_total"].'</span>
  ';
//  }

echo $output;

?>
