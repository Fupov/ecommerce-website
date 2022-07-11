<?php require_once('../../../private/initialize.php');
if(isset($_SESSION['admin_access'])){
  redirect_to(url_for('/staff/produits.php'));
}
if(is_post_request()) {

    $user['first_name'] = $_POST['first_name'] ?? '';
    $user['last_name'] = $_POST['last_name'] ?? '';
    $user['email'] = $_POST['email'] ?? '';
    $user['username'] = $_POST['username'] ?? '';
    $user['password'] = $_POST['password'] ?? '';
    /*$user['confirm_password'] = $_POST['confirm_password'] ?? '';*/

    $result = insert_user($user);
    if($result === true) {
      $new_id = mysqli_insert_id($db);
      $_SESSION['message'] = 'user created.';
      $user['id']=$new_id;
      log_in_user($user);
      /*redirect_to(url_for('index.php?id=' . $new_id));*/
      redirect_to(url_for('index.php'));
    } else {
      $errors = $result;
    }

  } else {
    // display the blank form
    $user = [];
    $user["first_name"] = '';
    $user["last_name"] = '';
    $user["email"] = '';
    $user["username"] = '';
    $user['password'] = '';
    $user['confirm_password'] = '';

  }


  $produit=find_produit_by_id($_GET['id']);

?>

<?php include(SHARED_PATH . '/public_header.php'); ?>


<section class="main_container_item">
    <div class="material_info">
       <p><h2 style="font-size: 12px;font-weight: bold;">MATIÈRES, ENTRETIEN ET ORIGINE</h2><br>
         <span style="font-size: 11px;font-weight: bold;">JOIN LIFE</span><br>
         <p style="font-size: 10px;">Care for water : fabriqué en utilisant moins d'eau.<br>
          Nous labellisons les vêtements sous l'appellation Join Life lorsqu'ils sont fabriqués en utilisant des technologies et des matières premières qui nous aident à réduire l'impact environnemental de nos produits.<br></p>
        </p>
    </div>
    <img src="../prod_img/<?= $produit['Image']?>">

    <div class="cart_container" data-product_id="<?=$produit['ID_prod']?>" data-product_name="<?=$produit['Nom_produit']?>" data-product_price="<?=$produit['Prix']?>" data-product_image="https://loyaltycard.ovh/public/products/prod_img/<?=$produit['Image']?>" data-product_descr="<?=$produit['Description']?>">
        <div>
           <h2 class="item_title"><?= $produit['Nom_produit']?></h2>
           <p class="item_description"> <?= $produit['Description']?></p>
        </div>

       <label class="checkbox">
          <input type="checkbox"/>
          <input type="checkbox"/>
          <input type="checkbox"/>
       </label>
       <span class="item_price"><?= $produit['Prix']?> EUR</span>
       <ul class="item_size">
        <li>S</li>
        <li>M</li>
        <li>L</li>
       </ul>
       <button id="add_to_cart_button" class="add_cart_button">AJOUTER AU PANIER</button>
    </div>


</section>



<?php include(SHARED_PATH . '/public_footer.php'); ?>
