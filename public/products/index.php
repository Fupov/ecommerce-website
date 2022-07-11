<?php require_once('../../private/initialize.php');


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




?>

<?php include(SHARED_PATH . '/public_header.php'); ?>

<nav id="side_panel_filtre" class="side_filtre">
       <a id="filtre_close" href="#" class="closebtn">×</a>
       <div class="side_filtre_flex">
         <a id="color_button" class="filtre_item">Couleur</a>
         <div id="color_container_show">
           <ul class="color_container">
              <li>
                <input class="color_filtre_box" type="checkbox"/>
                <span>AUTRES</span>
              </li>
              <li>
                <input class="color_filtre_box a" type="checkbox"/>
                <span>BEIGE</span>
              </li>
              <li>
                <input class="color_filtre_box b" type="checkbox"/>
                <span>BLANCS</span>
              </li>
              <li>
                <input class="color_filtre_box c" type="checkbox"/>
                <span>BLEUS</span>
              </li>
              <li>
                <input class="color_filtre_box d" type="checkbox"/>
                <span>ECRUS</span>
              </li>
              <li>
                <input class="color_filtre_box e" type="checkbox"/>
                <span>GRIS</span>
              </li>
              <li>
                <input class="color_filtre_box f" type="checkbox"/>
                <span>IMPRIMÉ</span>
              </li>
              <li>
                <input class="color_filtre_box g" type="checkbox"/>
                <span>JAUNES</span>
              </li>
              <li>
                <input class="color_filtre_box i" type="checkbox"/>
                <span>MARRONS</span>
              </li>
              <li>
                <input class="color_filtre_box j" type="checkbox"/>
                <span>MÉTALLISÉS</span>
              </li>
              <li>
                <input class="color_filtre_box k" type="checkbox"/>
                <span>NOIRS</span>
              </li>
              <li>
                <input class="color_filtre_box l" type="checkbox"/>
                <span>NÉON</span>
              </li>
              <li>
                <input class="color_filtre_box m" type="checkbox"/>
                <span>ORANGE</span>
              </li>
              <li>
                <input class="color_filtre_box n" type="checkbox"/>
                <span>PIERRE</span>
              </li>
              <li>
                <input class="color_filtre_box o" type="checkbox"/>
                <span>ROSES</span>
              </li>
              <li>
                <input class="color_filtre_box p" type="checkbox"/>
                <span>ROUGES</span>
              </li>
              <li>
                <input class="color_filtre_box q" type="checkbox"/>
                <span>VERTS</span>
              </li>
              <li>
                <input class="color_filtre_box r" type="checkbox"/>
                <span>VIOLETS</span>
              </li>
           </ul>
         </div>

         <a id="brand_button" class="filtre_item">Marque</a>
         <a id="size_button" class="filtre_item">Taille</a>
         <a id="category_button" class="filtre_item">Catégorie</a>
         <a id="price_button" class="filtre_item">Prix</a>
         <div id="price_container">
           <div class="price_flex_container">
              <span>MIN</span>
              <input id="min_input" type="number"/>
              <span>MAX</span>
              <input id="max_input" type="number"/>
           </div>
         </div>


       </div>
       <div class="submit_filter_flex">
         <a class="filtre_item_submit">VOIR LES RÉSULTATS</a>
         <a class="filtre_item_submit">NETTOYER</a>
       </div>
</nav>


<div class="section_products">
   <div id="filtre_bar" class="filtre_container">
      <button class="filtre_button">Filtres</button>
   </div>


   <ul class="products_grid">
     <?php
             $demande = find_all_products();
             foreach ($demande as $demandes):
              $id=$demandes['ID_prod'];

               ?>
     <li class="item_grid" data-product_id="<?=$demandes['ID_prod']?>" data-product_name="<?=$demandes['Nom_produit']?>" data-product_price="<?=$demandes['Prix']?>" data-product_image="https://loyaltycard.ovh/public/products/prod_img/<?=$demandes['Image']?>" data-product_descr="<?=$demandes['Description']?>">
        <a href="<?php echo url_for('products/item/index.php?id='.$id); ?>">
            <img class="products" src="prod_img/<?=$demandes['Image']?>">
        </a>
        <span class="product_item">
          <?=$demandes['Nom_produit'] ?>
        </span>
        <span id="span_price" class="product_item">
        <?=$demandes['Prix'] ?> EUR
        </span>
        <h2 data-type="<?=$demandes['Couleur'] ?>" ></h2>
        <img class="add_to_cart_button_main" src="../images/cart_button.png">
     </li>

    <?php endforeach ?>

   </ul>












   <nav id="change_page_container" class="change_container">
      <ul class="change_page">
        <li>
           <button class="page_num">1</button>
        </li>
        <li>
          <button class="page_num">2</button>
        </li>
        <li>
          <button class="page_num">3</button>
        </li>
      </ul>
   </nav>

</div>



<?php include(SHARED_PATH . '/public_footer.php'); ?>
