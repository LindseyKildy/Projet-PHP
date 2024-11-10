<?php 
include "connect_db.php";
    $num_produit = $_GET['num_produit'];
    $sql = "DELETE FROM `produits` WHERE num_produit = $num_produit";
    $result = mysqli_query($conn, $sql);
    if($result) {
        header("Location: affichage.php?msg=Enregistrement supprimé ");
    }
    else {
        echo "Failed: " .mysqli_error($conn); 
    }
?>