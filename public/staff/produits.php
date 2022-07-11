<?php

require_once('../../private/initialize.php');

require_admin_login();


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
    redirect_to(url_for('/staff/produits.php'));
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



if (isset($_POST['supprimer'])){
  delete_produit($_POST['id_produit']);
}
if (isset($_POST['modifier'])){
  update_produit($_POST['id_produit']);
}




if(isset($_POST['submit'])) {

  $user1['nom'] = $_POST['nom'] ?? '';
  $user1['description'] = $_POST['description'] ?? '';
  $user1['taille'] = $_POST['taille'] ?? '';
  $user1['quantite'] = $_POST['quantite'] ?? '';
  $user1['prix'] = $_POST['prix'] ?? '';
  $user1['couleur'] = $_POST['couleur'] ?? '';
  $user1['marque'] = $_POST['marque'] ?? '';
  $user1['type'] = $_POST['type'] ?? '';
  /*$user['confirm_password'] = $_POST['confirm_password'] ?? '';*/

  $result = insert_produit($user1);
  if($result === true) {
    /*redirect_to(url_for('index.php?id=' . $new_id));*/
    redirect_to(url_for('/staff/produits.php'));
  } else {
    $errors = $result;
  }

} else {
  // display the blank form
  $user1 = [];
  $user1['nom'] = '';
  $user1['description'] ='';
  $user1['taille'] ='';
  $user1['quantite'] = '';
  $user1['prix'] = '';
  $user1['couleur'] = '';
  $user1['marque']='';
  $user1['type']='';

}






?>


<!DOCTYPE html>
<html id="html-id"  dir="ltr" lang="fr-FR">
    <head>
        <meta charset="utf-8" />
        <title>Marybé</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo url_for("../css/products_page.css"); ?>">
    </head>

    <body>



     <header id="header-bar">

        <div class="title-bar">
          <h4 class="livraison">LIEU DE LIVRAISON: <strong>TN D</strong></h4>
          <h1 class="Marybe">MARYBÈ </h1>
          <div class="icons">
            <a href=""><i style="font-size:20px" class="fa"> &#xf006;</i></a>
            <a href="javascript:void(0)" onclick="openNav(); on();"><i style="font-size:20px" class="fa">&#xf2c0;</i></a>
            <a href="">
               <img class="cart" src="<?php echo url_for('/images/cart.png'); ?>">
            </a>
          </div>
       </div>
        <div>
            <ul class="nav-bar" id="nav-bar-hide">
                <li><a href="<?php echo url_for('/products/index.php'); ?>">NOS PORDUITS</a></li>
                <li><a href='#'>TENDANCES</a></li>
                <li><a href='#'>MESSAGES</a></li>
            </ul>
        </div>

     </header>

     <nav>
        <div id="mySidepanel" class="sidepanel">
           <a href="javascript:void(0)" class="closebtn" onclick="closeNav(); off();">×</a>
           <ul class="account-bar">
             <li><a href="javascript:void(0)" id='inscription-button' onclick="inscri()">INSCRIPTION</a></li>
             <li><a href="javascript:void(0)" id='compte-button' onclick="sign_in()">COMPTE</a></li>
             <li><a href='#'>FAVORIS</a></li>

           </ul>

           <div style="position:absolute; left: 0;">
             <?php echo display_errors($errors); ?>
          </div>

           <section>

            <div class="login" id="login-container">
                <?php if (!is_logged_in()) : ?>
            <p class="se-con">SE CONNECTER</p>
            <p class="acced">Pour accéder à votre compte</p>

            <form>
              <label class="email-" for="email"><sup>*</sup>E-mail</label>
              <input class="input-design show-on-focus" type="email" name="email" id="email" required="" placeholder="me@marybe.fr">
              <label for="pass" class="password-"><sup>*</sup>Mot de passe</label>
              <input class="input-design" type="password" id="pass" name="password"minlength="8" required>
              <a href="#" class="reset-pass">Mot de passe oublié ?</a>
              <button class="button-submit" type="submit">
                ME CONNECTER
              </button>
            </form>
            <div class="sign-nav">
                <p class="vous-nav">VOUS N'AVEZ PAS DE COMPTE ?</p>
                <button class="button-create" onclick="inscri()" >CRÉER UN COMPTE</button>
            </div>
            <?php endif; ?>
            <?php if (is_logged_in()) : ?>

              <p class="welcome"> Bienvenu <?php echo $_SESSION['full_name'] ; ?>
              <a class="log_out" href="<?php echo url_for('/staff/logout.php'); ?>">SE DECONNECTER</a>

            <?php endif; ?>
           </div>




         </section>






         <section>

           <div class="sign-up" id="signup-container">
            <p class="cre-compte">CRÉER UN COMPTE</p>
            <p class="rejoignez">Rejoignez-nous sur Marybé.fr</p>
            <form action="<?php echo url_for('staff/produits.php'); ?>" method="post">


              <label for="civilite_input"></label>
              <select name="civilite" id="civilite_input" class="input-select-design-inscri" type="select" required>
                <option disabled selected>Civilité</option>
                <option>M.</option>
                <option>Mme</option>
              </select>




              <label for="name_input" class="name_input_">Prénom<sup>*</sup></label>
              <input class="input-design-inscri" type="text" placeholder="" name="first_name" id="name_input" required value="<?php echo h($user['first_name']); ?>">


              <label for="lastname_input" class="lastname_input_">Nom<sup>*</sup></label>
              <input class="input-design-inscri" type="text" placeholder="" name="last_name" id="lastname_input" required value="<?php echo h($user['last_name']); ?>">


              <label for="pays_input" class="pays_input_">Tunisie</label>
              <input class="input-design-inscri" type="text" placeholder="" name="country" id="pays_input" disabled>




              <label class="email-inscri" for="email_ins">E-mail<sup>*</sup></label>
              <input class="input-design-inscri show-on-focus" type="email" name="email" id="email_ins" required="" placeholder="me@marybe.fr" value="<?php echo h($user['email']); ?>">


              <label for="pass_ins" class="password-inscri">Mot de passe<sup>*</sup></label>
              <input class="input-design-inscri" type="password" id="pass_ins" name="password" minlength="8" required value="">





              <button class="button-submit-cree" type="submit" >
                CRÉER UN COMPTE
              </button>
            </form>
           </div>

         </section>






       </div>
       <div id="overlay" onclick="off(); closeNav(); "></div>
     <script>
        function openNav() {
          document.getElementById("mySidepanel").style.width = "550px";
         }

         function closeNav() {
           document.getElementById("mySidepanel").style.width = "0";
          }
          function on() {
           document.getElementById("overlay").style.display = "block";
          }

          function off() {
           document.getElementById("overlay").style.display = "none";
          }

          function inscri() {
           var x = document.getElementById("login-container");
           x.style.display = "none";
           document.getElementById("signup-container").style.display = "flex";
           document.getElementById("inscription-button").style.borderBottom =  ".125rem solid black";
           document.getElementById("compte-button").style.borderBottom =  "none";
           }

           function sign_in () {
            document.getElementById("login-container").style.display = "flex";
            document.getElementById("signup-container").style.display = "none";
            document.getElementById("inscription-button").style.borderBottom =  "none";
            document.getElementById("compte-button").style.borderBottom =  ".125rem solid black";
           }



           var prevScrollpos = window.pageYOffset;
           var height = document.body.offsetHeight;
           window.onscroll = function() {
            var currentScrollPos = window.pageYOffset;
            if (currentScrollPos > 1000) {

              document.getElementById("header-bar").style.zIndex = "0";
              /*document.getElementById("header-bar").style.animation = " fadein 2s ease-in  ";*/
               }

            else {
             document.getElementById("header-bar").style.zIndex = "2";

             }

             prevScrollpos = currentScrollPos;
            }


      </script>
    </nav>


    <main>
    <section>

        <div class="">
          <table class="">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Image</th>
                <th>Prix</th>
                <th>Taille</th>
                <th>Couleur</th>
                <th>Quantité</th>
                <th>Type</th>
                <th>Marques</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="product_list">
              <?php
                      $demande = find_all_products();
                      foreach ($demande as $demandes): ?>
               <tr>
                <td><?=$demandes['ID_prod']?></td>
                <td><?=$demandes['Nom_produit'] ?></td>
                <td><?=$demandes['Image'] ?></td>
                <td><?=$demandes['Prix'] ?></td>
                <td><?=$demandes['Taille'] ?></td>
                <td><?=$demandes['Couleur'] ?></td>
                <td><?=$demandes['Quantite'] ?></td>
                <td><?=$demandes['Type_produit'] ?></td>
                <td><?=$demandes['Marque'] ?></td>
                <td><?=$demandes['Description'] ?></td>
                <form action="produits.php" method="post">

                    <input type="hidden" name="id_produit" value="<?=$demandes['ID_prod']?>" >

                <td><button name="supprimer">Supprimer</button>
                    <button name="modifier">Modifier</button>
                </form>
                </td>
              </tr>
                        <?php endforeach ?>
            </tbody>
          </table>
        </div>



    </section>
    <form method="post" action="produits.php">
    <label>Nom </label>
    <input name="nom" value="">
    <label>Description</label>
    <input name="description" value="">
    <label>Couleur</label>
    <input name="couleur" value="">
    <label>Taille </label>
    <input name="taille" value="">
    <label>Prix </label>
    <input name="prix" value="">
    <label>Quantité </label>
    <input name="quantite" value="">
    <label>Type </label>
    <input name="type" value="">
    <label>Marques </label>
    <input name="marque" value="">
    <button type="submit" name="submit"> Ajouter produit </button>


    </form>


     </main>


    </body>
</html>
