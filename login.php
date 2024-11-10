<?php

$host = 'localhost';
$dbname = 'gestion_de_vente';
$username = 'root';
$password = '';

// var_dump($_SESSION['type_utilisateur']);

if (isset($_SESSION['type_utilisateur'])) {
    if ($_SESSION['type_utilisateur'] === 'admin') {
        // Vérifiez si l'utilisateur est déjà sur la page admin
        if ($_SERVER['PHP_SELF'] !== '/ajouter_produit.php') {
            header("Location: ajouter_produit.php");
            exit();
        }
    } elseif ($_SESSION['type_utilisateur'] === 'client') {
        // Vérifiez si l'utilisateur est déjà sur la page d'accueil
        if ($_SERVER['PHP_SELF'] !== '/acceuil.php') {
            header("Location: acceuil.php");
            exit();
        }
    }
}



try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_utilisateur = $_POST['email_utilisateur'] ?? null;
    $nom_utilisateur = $_POST['nom_utilisateur'] ?? null;
    $mdp_utilisateur = $_POST['mdp_utilisateur'] ?? null;
    
    // Requête pour vérifier les informations de l'utilisateur
    $sql = "SELECT * FROM utilisateur WHERE (email_utilisateur = :email_utilisateur OR nom_utilisateur = :nom_utilisateur)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'email_utilisateur' => $email_utilisateur,
        'nom_utilisateur' => $nom_utilisateur
    ]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($utilisateur && $mdp_utilisateur === $utilisateur['mdp_utilisateur']) {
        session_start();
        $_SESSION['id_utilisateur'] = $utilisateur['id_utilisateur'];
        $_SESSION['type_utilisateur'] = $utilisateur['type_utilisateur'];
        
        if ($utilisateur['type_utilisateur'] == 'admin') {
            header("Location: ajouter_produit.php");
        } elseif ($utilisateur['type_utilisateur'] == 'client') {
            header("Location: acceuil.php");
        } else {
            echo "Type d'utilisateur inconnu.";
        }
    } else {
        echo "Identifiants incorrects";
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
    <link rel="stylesheet" href="login.css">

    <title>Se connecter</title>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <form action="login.php" method="POST" class="border p-4 shadow-lg rounded bg-white" style="width: 300px;">
            <div class="image-container mb-4 d-flex justify-content-center align-items-center w-5">
                <img src="image/verre.jpg" class="img-fluid" style="width: 100px; height: auto;">
            </div>
            <h3 class="text-center mb-4">Se connecter</h3>

            <!-- Champ pour le nom d'utilisateur -->
            <div class="mb-3">
                <label for="nom_utilisateur" class="form-label visually-hidden">Nom d'utilisateur</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" id="nom_utilisateur" name="nom_utilisateur" class="form-control" placeholder="Nom d'utilisateur">
                </div>
            </div>

            <!-- Champ pour l'email -->
            <div class="mb-3">
                <label for="email_utilisateur" class="form-label visually-hidden">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" id="email_utilisateur" name="email_utilisateur" class="form-control" placeholder="Email" required>
                </div>
            </div>

            <!-- Champ pour le mot de passe -->
            <div class="mb-3">
                <label for="mdp_utilisateur" class="form-label visually-hidden">Mot de passe</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" id="mdp_utilisateur" name="mdp_utilisateur" class="form-control" placeholder="Mot de passe" required>
                </div>
            </div>

            <div class="text-end mb-3">
                <a href="#" class="text-decoration-none">Mot de passe oublié?</a>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </div>
        </form>
    </div>
</body>
</html>


