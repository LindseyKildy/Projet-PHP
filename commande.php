<?php
// Inclure la connexion à la base de données
include 'connect_db.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $type_produit = $_POST['type_produit'];
    $prix_unitaire = $_POST['prix_unitaire'];
    $quantite_disponible = $_POST['quantite_disponible'];
    $qty_commande = $_POST['qty_commande'];

    // Vérifier si la quantité commandée est valide par rapport à la quantité disponible
    if ($qty_commande > $quantite_disponible) {
        echo "La quantité commandée dépasse la quantité disponible.";
        exit;
    }

    // Insérer la commande dans la table `commandes`
    $sql = "INSERT INTO `commande`( `type_produit`, `prix_unitaire`,
     `date_commande`, `qty_commande`)VALUES ('$type_produit','$prix_unitaire',
     '$date_commande','$qty_commande')";
    $stmt = $pdo->prepare($sql);

    // Exécuter la requête
    try {
        $stmt->execute([
            ':type_produit' => $type_produit,
            ':prix_produit' => $prix_produit,
            ':qty_commande' => $qty_commande
        ]);

        echo "Commande enregistrée avec succès !";
    } catch (PDOException $e) {
        echo "Erreur lors de l'enregistrement de la commande : " . $e->getMessage();
    }
}
?>







<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de commande</title>
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
    <link rel="stylesheet" href="acceuil.css">
    
    <style>
        /* Style pour l'arrière-plan sombre */
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.7);
        }
    </style>
</head>
<body>
    <!-- MENU -->
    <div class="container my-5" id="menu">
        <h1 class="akali text-center mb-5">MENU</h1>
        <div class="row g-4">
            <!-- Carte de Vin 1 -->
            <div class="col-md-4">
                <div class="card">
                    <div class="diva d-flex justify-content-center align-item-center">
                        <img src="image/Vin_aperitif-removebg-preview.png" class="card-img-top" alt="Vin rouge">
                    </div>
                    <div class="card-body">
                        <h4 class="sylas card-title">Vin Aperitif</h4>
                        <ul class="list-unstyled">
                            <li><strong>Prix:</strong> Ar 20 000 </li>
                            <li><strong>Quantité:</strong> 10 bouteilles</li>
                            <li><strong>Type:</strong> Apéritif</li>
                        </ul>
                        <!-- Bouton pour afficher le formulaire -->
                        <button 
                            class="btn btn-primary" 
                            data-bs-toggle="modal" 
                            data-bs-target="#formCommandeModal"
                            data-type="Apéritif"
                            data-prix=" Ar 20 000"
                            data-quantite="10">Commander
                        </button>
                    </div>
                </div>
            </div>
            <!-- Carte de Vin 2 -->
            <div class="col-md-4">
                <div class="card">
                    <div class="diva d-flex justify-content-center align-items-center">
                        <img src="image/Vin_Blanc-removebg-preview.png" class="card-img-top " alt="Vin blanc">
                    </div>
                    <div class="card-body">
                        <h4 class="sylas card-title">Vin Blanc - Moelleux</h4>
                        <ul class="list-unstyled">
                            <li><strong>Prix:</strong> Ar 20 000</li>
                            <li><strong>Quantité disponible:</strong> 15 bouteilles</li>
                            <li><strong>Type:</strong> Blanc-Moelleux</li>
                        </ul>
                        <!-- Bouton "Commander" avec les attributs data-* -->
                        <button 
                            class="btn btn-primary" 
                            data-bs-toggle="modal" 
                            data-bs-target="#formCommandeModal"
                            data-type="Blanc-Moelleux"
                            data-prix="Ar 20 000"
                            data-quantite="15">Commander
                        </button>
                    </div>
                </div>
            </div>
            <!-- Carte de Vin 3 -->
            <div class="col-md-4">
                <div class="card">
                    <div class="diva d-flex justify-content-center align-items-center">
                        <img src="image/Vin_blanc_vert-removebg-preview 1.png" class="card-img-top" alt="Vin blanc">
                    </div>
                    <div class="card-body">
                        <h4 class="sylas card-title">Vin Blanc</h4>
                        <ul class="list-unstyled">
                            <li><strong>Prix:</strong> Ar 12 000</li>
                            <li><strong>Quantité disponible:</strong> 25 bouteilles</li>
                            <li><strong>Type:</strong> Blanc</li>
                        </ul>
                        <!-- Bouton "Commander" avec les attributs data-* -->
                        <button 
                            class="btn btn-primary" 
                            data-bs-toggle="modal" 
                            data-bs-target="#formCommandeModal"
                            data-type="Blanc"
                            data-prix="Ar 12000"
                            data-quantite="25">Commander
                        </button>
                    </div>
                </div>
            </div>
            <!-- Carte de Vin 4 -->
            <div class="col-md-4">
                <div class="card">
                    <div class="diva d-flex justify-content-center align-items-center">
                        <img src="image/Vin_rose_11-removebg-preview.png" class="card-img-top" alt="Vin rosé">
                    </div>
                    <div class="card-body">
                        <h4 class="sylas card-title">Vin Blanc</h4>
                        <ul class="list-unstyled">
                            <li><strong>Prix:</strong> Ar 12 000</li>
                            <li><strong>Quantité disponible:</strong> 20 bouteilles</li>
                            <li><strong>Type:</strong> Rosé</li>
                        </ul>
                        <!-- Bouton "Commander" avec les attributs data-* -->
                        <button 
                            class="btn btn-primary" 
                            data-bs-toggle="modal" 
                            data-bs-target="#formCommandeModal"
                            data-type="Rosé"
                            data-prix="Ar 12000"
                            data-quantite="20">Commander
                        </button>
                    </div>
                </div>
            </div>
            <!-- Carte de Vin 5 -->
            <div class="col-md-4">
                <div class="card">
                    <div class="diva d-flex justify-content-center align-item-center">
                        <img src="image/Vin_Rouge_1-removebg-preview 1.png" class="card-img-top" alt="Vin rosé">
                    </div>
                    <div class="card-body">
                        <h4 class="sylas card-title">Vin Rouge - Prestige</h4>
                        <ul class="list-unstyled">
                            <li><strong>Prix:</strong> Ar 17 000 </li>
                            <li><strong>Quantité:</strong> 30 bouteilles</li>
                            <li><strong>Type:</strong> Rouge-Prestige</li>
                        </ul>
                        <button 
                            class="btn btn-primary" 
                            data-bs-toggle="modal" 
                            data-bs-target="#formCommandeModal"
                            data-type="Rouge-Prestige"
                            data-prix=" Ar 17 000"
                            data-quantite="30">Commander
                        </button>
                    </div>
                </div>
            </div>
            <!-- Carte de Vin 6 -->
            <div class="col-md-4">
                <div class="card">
                    <div class="diva d-flex justify-content-center align-item-center">
                        <img src="image/Vin_rouge_fotsy-removebg-preview.png" class="card-img-top" alt="Vin rosé">
                    </div>
                    <div class="card-body">
                        <h4 class="sylas card-title">Vin Rouge</h4>
                        <ul class="list-unstyled">
                            <li><strong>Prix:</strong> Ar 15 000 </li>
                            <li><strong>Quantité:</strong> 40 bouteilles</li>
                            <li><strong>Type:</strong> Rouge</li>
                        </ul>
                        <button 
                            class="btn btn-primary" 
                            data-bs-toggle="modal" 
                            data-bs-target="#formCommandeModal"
                            data-type="Rouge"
                            data-prix=" Ar 15 000"
                            data-quantite="40">Commander
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal du formulaire de commande -->
        <div class="modal fade" id="formCommandeModal" tabindex="-1" aria-labelledby="formCommandeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formCommandeModalLabel">Formulaire de commande</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="commandeForm" action=""  method="POST">
                            <!-- Affichage du type de produit (lecture seule) -->
                            <div class="mb-3">
                                <label for="type_produit" class="form-label">Type de produit</label>
                                <input type="text" class="form-control" id="type_produit" name="type_produit" readonly>
                            </div>
                            <!-- Affichage du prix du produit (lecture seule) -->
                            <div class="mb-3">
                                <label for="prix_produit" class="form-label">Prix unitaire</label>
                                <input type="text" class="form-control" id="prix_produit" name="prix_produit" readonly>
                            </div>
                            <!-- Affichage de la quantité disponible (lecture seule) -->
                            <div class="mb-3">
                                <label for="quantite_disponible" class="form-label">Quantité disponible</label>
                                <input type="text" class="form-control" id="quantite_disponible" name="quantite_disponible" readonly>
                            </div>
                            <!-- Champ pour la quantité commandée, modifiable par l'utilisateur -->
                            <div class="mb-3">
                                <label for="qty_commande" class="form-label">Quantité commandée</label>
                                <input type="number" class="form-control" id="qty_commande" name="qty_commande" min="1" required>
                            </div>
                            <button type="submit" class="btn btn-success">Passer la commande</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <script>
        // Script pour remplir les champs du formulaire avec les informations du produit sélectionné
        const formCommandeModal = document.getElementById('formCommandeModal');
        formCommandeModal.addEventListener('show.bs.modal', function (event) {
            // Bouton qui a déclenché l'ouverture du modal
            const button = event.relatedTarget;
        
            // Récupération des informations du produit
            const typeProduit = button.getAttribute('data-type');
            const prixProduit = button.getAttribute('data-prix');
            const quantiteDisponible = button.getAttribute('data-quantite');
        
            // Remplissage des champs du formulaire avec les informations du produit
            document.getElementById('type_produit').value = typeProduit;
            document.getElementById('prix_produit').value = prixProduit;
            document.getElementById('quantite_disponible').value = quantiteDisponible;
        });
        
        document.getElementById('commandeForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Empêche le rechargement de la page

        // Création de l'objet FormData pour récupérer les données du formulaire
        let formData = new FormData(this);

        // Envoi des données via AJAX
        fetch('traiter_commande.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(responseText => {
            console.log(responseText);

            // Réinitialise le formulaire
            document.getElementById('commandeForm').reset();

            // Ferme le modal après la soumission
            let formModal = new bootstrap.Modal(document.getElementById('formCommandeModal'));
            formModal.hide();
        })
        .catch(error => {
            console.error('Erreur:', error);
        });
    });
    
    </script>

        
        
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

    

