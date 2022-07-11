<?php require_once('../../private/initialize.php');

/*filtre produit par Type*/
function find_product_type($product_type) {
    global $db;

    $sql = "SELECT * FROM produit ";
    $sql .= "WHERE type_produit='" . db_escape($db, $product_type) . "' ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $user; // returns an assoc. array
}
/*Filtre produit par taille*/
function find_product_size($product_size) {
    global $db;

    $sql = "SELECT * FROM produit ";
    $sql .= "WHERE taille='" . db_escape($db, $product_size) . "' ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $user; // returns an assoc. array
}
/*Filtre Produit par marque*/
function find_product_brand($product_brand) {
    global $db;

    $sql = "SELECT * FROM produit ";
    $sql .= "WHERE marque='" . db_escape($db, $product_brand) . "' ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $user; // returns an assoc. array
}

/*Filtre produit par Couleur*/
function find_product_color($product_color) {
    global $db;

    $sql = "SELECT * FROM produit ";
    $sql .= "WHERE couleur='" . db_escape($db, $product_color) . "' ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $user; // returns an assoc. array
}

/*Filtre produit par prix*/
function find_product_prix($product_prix) {
    global $db;

    $sql = "SELECT * FROM produit ";
    $sql .= "WHERE prix<='" . db_escape($db, $product_prix) . "' ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $user; // returns an assoc. array
}
