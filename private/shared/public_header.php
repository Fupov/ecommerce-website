

<?php if(isset($_POST['conn'])) {

  $email = $_POST['email1'] ?? '';
  $password = $_POST['password1'] ?? '';

  // Validations
  if(is_blank($email)) {
    $errors[] = "Username cannot be blank.";
  }
  if(is_blank($password)) {
    $errors[] = "Password cannot be blank.";
  }

  // if there were no errors, try to login
  if(empty($errors)) {
    // Using one variable ensures that msg is the same
    $login_failure_msg = "Log in was unsuccessful.";

    $user = find_user_by_email($email);

    if($user) {
  if(password_verify($password, $user['hashed_password'])) {
        // password matches
        log_in_user($user);
        redirect_to(url_for('index.php'));
      } else {
        // username found, but password does not match
        $errors[] = $login_failure_msg;
      }

   }else {
    // no username found
    $errors[] = $login_failure_msg;
  }
  }

}

?>


<!DOCTYPE html>
<html id="html-id"  dir="ltr" lang="fr-FR">
    <head>
        <meta charset="utf-8" />
        <title>Marybé</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="<?php echo url_for("/css/style.css"); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo url_for("/css/products_page.css"); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo url_for("/css/item.css"); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo url_for("/css/cart.css"); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo url_for("/css/filtre.css"); ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script type="text/javascript" src="../../../jquery-3.6.0.js"></script>
        <script type="text/javascript" src="<?php echo url_for("/script_js/func_js.js"); ?>"></script>


    </head>

    <body>



     <header id="header-bar">

        <div class="title-bar">
          <h4 class="livraison">LIEU DE LIVRAISON: <strong>FR</strong></h4>
          <a class="Marybe" href="<?php echo url_for('index.php'); ?>">MARYBÈ</a>
          <div class="icons">
            <a href=""><i style="font-size:20px" class="fa"> &#xf006;</i></a>
            <a href="javascript:void(0)" onclick="openNav(); on();"><i style="font-size:20px" class="fa">&#xf2c0;</i></a>
            <a id="cart_button" href="">
               <img class="cart" src="<?php echo url_for('/images/cart.png'); ?>">
            </a>
          </div>
       </div>
        <div>
            <ul class="nav-bar" id="nav-bar-hide">
                <li><a href="<?php echo url_for('/products/index.php'); ?>">NOS PRODUITS</a></li>
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

            <form method="post">
              <label class="email-" for="email"><sup>*</sup>E-mail</label>
              <input class="input-design show-on-focus" type="email" name="email1" id="email" required="" placeholder="me@marybe.fr">
              <label for="pass" class="password-"><sup>*</sup>Mot de passe</label>
              <input class="input-design" type="password" id="pass" name="password1"minlength="8" required>
              <a href="#" class="reset-pass">Mot de passe oublié ?</a>
              <button class="button-submit" name="conn" type="submit">
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
            <form action="<?php echo url_for('index.php'); ?>" method="post">


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


    </nav>

    <section id="cart_panel" class="cart_container_panel">
        <div class="flex_cart">
          <a id="cart_close" href="#" class="closebtn">×</a>
          <h2>MON PANIER</h2>
          <ul class="cart_items_container" id="shopping_cart">
          </ul>
          <span id="total_price"></span>
          <form action="<?php echo url_for('products/payements/index.php'); ?>" method="post">
              <button  id="validate_cart" >PASSER LA COMMANDE</button>
          </form>
        </div>
    </section>
