<?php

require_once('../../private/initialize.php');


if(isset($_POST['conn'])) {

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
        log_in_admin($user);
        redirect_to(url_for('/staff/produits.php'));
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




















if(is_post_request()) {

  $user['first_name'] = $_POST['first_name'] ?? '';
  $user['last_name'] = $_POST['last_name'] ?? '';
  $user['email'] = $_POST['email'] ?? '';
  $user['username'] = $_POST['username'] ?? '';
  $user['password'] = $_POST['password'] ?? '';
  /*$user['confirm_password'] = $_POST['confirm_password'] ?? '';*/

  $result = insert_admin($user);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    $_SESSION['message'] = 'user created.';
    $user['id']=$new_id;
    log_in_admin($user);
    /*redirect_to(url_for('index.php?id=' . $new_id));*/
    redirect_to(url_for('staff/produits.php'));
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


<!DOCTYPE html>
<html id="html-id"  dir="ltr" lang="fr-FR">
    <head>
        <meta charset="utf-8" />
        <title>Marybé</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo url_for("/css/products_page.css"); ?>">
    </head>

    <body>



   <div class="login" id="login-container">
       <?php if (!is_logged_in_admin()) : ?>
   <p class="se-con">SE CONNECTER</p>
   <p class="acced">Pour accéder à votre compte</p>

   <form method="post">
     <label class="email-" for="email"><sup>*</sup>E-mail</label>
     <input class="input-design show-on-focus" type="email" name="email1" id="email" required="" placeholder="me@marybe.fr">
     <label for="pass" class="password-"><sup>*</sup>Mot de passe</label>
     <input class="input-design" type="password" id="pass" name="password1"minlength="8" required>
     <a href="#" class="reset-pass">Mot de passe oublié ?</a>
     <button class="button-submit"  name="conn" type="submit">
       ME CONNECTER
     </button>
   </form>

  
   <?php endif; ?>
   <?php if (is_logged_in_admin()) : ?>

     <p class="welcome"> Bienvenu <?php echo $_SESSION['full_name'] ; ?>
     <a class="log_out" href="<?php echo url_for('/staff/logout.php'); ?>">SE DECONNECTER</a>

   <?php endif; ?>
  </div>




 </section>



</section>
</body>
</html>
