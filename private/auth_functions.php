<?php

  // Performs all actions necessary to log in an user
  function log_in_user($user) {
  // Renerating the ID protects the user from session fixation.
    session_regenerate_id();

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['last_login'] = time();
    $_SESSION['full_name'] = $user['first_name'] . " " . $user['last_name'] ;
    return true;
  }

  function log_in_admin($user) {
  // Renerating the ID protects the user from session fixation.
    session_regenerate_id();
    $_SESSION['admin_access']=$user['admin_access'];
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['last_login'] = time();
    $_SESSION['full_name'] = $user['first_name'] . " " . $user['last_name'] ;
    return true;
  }
  // Performs all actions necessary to log out an admin
  function log_out_user() {
  
    unset($_SESSION['user_id']);
    unset($_SESSION['last_login']);
    unset($_SESSION['full_name']);
    session_destroy(); // optional: destroys the whole session
    return true;
  }


  // is_logged_in() contains all the logic for determining if a
  // request should be considered a "logged in" request or not.
  // It is the core of require_login() but it can also be called
  // on its own in other contexts (e.g. display one link if an admin
  // is logged in and display another link if they are not)
  function is_logged_in() {
    // Having a admin_id in the session serves a dual-purpose:
    // - Its presence indicates the admin is logged in.
    // - Its value tells which admin for looking up their record.
    return isset($_SESSION['user_id']);
  }
  function is_logged_in_admin() {
    // Having a admin_id in the session serves a dual-purpose:
    // - Its presence indicates the admin is logged in.
    // - Its value tells which admin for looking up their record.
    return isset($_SESSION['admin_access']);
  }
  // Call require_login() at the top of any page which needs to
  // require a valid login before granting acccess to the page.
  function require_login() {
    if(!is_logged_in()) {
      redirect_to(url_for('/staff/login.php'));
    } else {
      // Do nothing, let the rest of the page proceed
    }
  }
  function require_admin_login() {
    if(!is_logged_in_admin()) {
      redirect_to(url_for('/staff/connexion.php'));
    } else {
      // Do nothing, let the rest of the page proceed
    }
  }
?>
