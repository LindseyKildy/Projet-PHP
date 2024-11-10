<?php
include "connect_db.php";
$num_produit = $_GET['num_produit'];

if(isset($_POST['submit'])) {
    $nom_produit = $_POST['nom_produit'];
    $type_produit = $_POST['type_produit'];
    $prix_produit = $_POST['prix_produit'];
    $qty = $_POST['qty'];
    $date = $_POST['date'];
    
    $sql ="UPDATE `produits` SET `nom_produit`='$nom_produit',
    `type_produit`='$type_produit',`prix_produit`='$prix_produit', `qty`='$qty',`date`='$date'
     WHERE `num_produit`='$num_produit'";
    
    $result = mysqli_query($conn, $sql);
    
    if($result) {
        header("Location: affichage.php?msg=Enregistrement modifié");
    }
    else {
        echo "Failed: " .mysqli_error($conn);
    }
}



?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css.map">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css.map">
    <link rel="stylesheet" href="css/bootstrap-grid.rtl.css">
    <link rel="stylesheet" href="css/bootstrap-grid.rtl.css.map">
    <link rel="stylesheet" href="css/bootstrap-grid.rtl.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.rtl.min.css.map">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css.map">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css.map">
    <link rel="stylesheet" href="css/bootstrap-reboot.rtl.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.rtl.css.map">
    <link rel="stylesheet" href="css/bootstrap-reboot.rtl.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.rtl.min.css.map">
    <link rel="stylesheet" href="css/bootstrap-utilities.css">
    <link rel="stylesheet" href="css/bootstrap-utilities.css.map">
    <link rel="stylesheet" href="css/bootstrap-utilities.min.css">
    <link rel="stylesheet" href="css/bootstrap-utilities.min.css.map">
    <link rel="stylesheet" href="css/bootstrap-utilities.rtl.css">
    <link rel="stylesheet" href="css/bootstrap-utilities.rtl.css.map">
    <link rel="stylesheet" href="css/bootstrap-utilities.rtl.min.css">
    <link rel="stylesheet" href="css/bootstrap-utilities.rtl.min.css.map">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.css.map">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css.map">
    <link rel="stylesheet" href="css/bootstrap.rtl.css">
    <link rel="stylesheet" href="css/bootstrap.rtl.css.map">
    <link rel="stylesheet" href="css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="css/bootstrap.rtl.min.css.map">
     <!-- font awesome -->
     <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="fontawesome/css/brands.css">
    <link rel="stylesheet" href="fontawesome/css/brands.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="fontawesome/css/regular.css">
    <link rel="stylesheet" href="fontawesome/css/regular.min.css">
    <link rel="stylesheet" href="fontawesome/css/solid.css">
    <link rel="stylesheet" href="fontawesome/css/solid.min.css">
    <link rel="stylesheet" href="fontawesome/css/svg-with-js.css">
    <link rel="stylesheet" href="fontawesome/css/svg-with-js.min.css">
    <link rel="stylesheet" href="fontawesome/css/v4-font-face.css">
    <link rel="stylesheet" href="fontawesome/css/v4-font-face.min.css">
    <link rel="stylesheet" href="fontawesome/css/v4-shims.css">
    <link rel="stylesheet" href="fontawesome/css/v4-shims.min.css">
    <link rel="stylesheet" href="fontawesome/css/v5-font-face.css">
    <link rel="stylesheet" href="fontawesome/css/v5-font-face.min.css">

     <title>Modification des Produits</title>
     <link rel="stylesheet" href="ajouter_produit.css">
    </head>
<body>
    <nav class="navbar justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
        <h3>Vente de vin au sein de Lazan'i Betsileo</h3>
    </nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Modification des Produits</h3>
            <p class="text-muted">Veuillez remplir le champ ci-dessous pour modifier les produits</p>
        </div>
        
        <?php 
            
            $sql = "SELECT * FROM `produits` WHERE num_produit = $num_produit LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            // var_dump($row['num_produit']);
        ?>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width: 50vw; min-width:300px">
                <div class="row">
                
                    <div class="col">
                        <label for="form-label">Nom:</label>
                        <input type="text" class="form-control" name="nom_produit" value="<?php echo $row['nom_produit'] ?>">
                    </div>

                    <div class="col mt-0.5">
                        <label for="form-label">Type:</label>
                        <input type="text" class="form-control" name="type_produit" value="<?php echo $row['type_produit'] ?>">
                    </div>

                    <div class="col mt-0.5">
                        <label for="form-label">Prix:</label>
                        <input type="number" class="form-control " name="prix_produit" value="<?php echo $row['prix_produit'] ?>">
                    </div>
                    
                    <div class="col mt-0.5">
                        <label for="form-label">Quantité:</label>
                        <input type="number" class="form-control " name="qty" value="<?php echo $row['qty'] ?>">
                    </div>

                    <div class="col mt-0.5 mb-3">
                        <label for="form-label">Date:</label>
                        <input type="date" class="form-control " name="date" value="<?php echo $row['date'] ?>">
                    </div>

                </div>

                <div>
                    <button type="submit" class="btn btn-success" name="submit">Modifier</button>
                    <a href="affichage.php" class="btn btn-danger">Annuler</a>
                </div>
            </form>
        </div>
    </div>

    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/bootstrap.bundle.js.map"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.bundle.min.js.map"></script>
    <script src="js/bootstrap.esm.js"></script>
    <script src="js/bootstrap.esm.js.map"></script>
    <script src="js/bootstrap.esm.min.js"></script>
    <script src="js/bootstrap.esm.min.js.map"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.js.map"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.min.js.map"></script>
</body>
</html>
