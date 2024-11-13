<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Sombre avec Icônes</title>
    <!-- Liens vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Liens vers Font Awesome pour les icônes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            color: white;
            background-color: #272727;
            min-height: 100vh;
        }
        .sidebar a {
            color: white;
            padding: 15px;
            text-decoration: none;
            display: block;
        }
        .sidebar a.active {
            background-color: white;
            color: #343a40;
            border-radius: 10px;
        }
        .sidebar a:hover {
            background-color: #4a4d4e;
            border-radius: 5px;
        }
        .sidebar i {
            margin-right: 10px;
        }
        .content {
            margin-left: 230px;
            background-color: #fff; /* Fond blanc pour la zone de contenu */
            min-height: 100vh;
            padding: 20px;
        }
        .header {
            color: white;
            background-color: white;
            padding: 20px 20px;
            width: 100%;
            padding-left: 5%;
        }
       
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar position-fixed top-0 start-0 p-3">
        <h4 class="text-center"><i class="fas fa-tachometer-alt"></i> Dashboard</h4>
        <a href="#" id="statistiquesLink"><i class="fas fa-chart-line"></i> Statistique</a>
        <a href="#" id="gestionProduitsLink"><i class="fas fa-shopping-cart"></i> Gestion des Produits</a>
        <a href="#" id="commandesLink"><i class="fas fa-box"></i> Commandes</a>
        <a href="#" id="clientsLink"><i class="fas fa-users"></i> Clients</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- Header -->
        <div class="header d-flex justify-content-between align-items-center w-100">
            <h2>Tableau de Bord</h2>
            <div>
                <button class="btn btn-light">Se déconnecter</button>
            </div>
        </div>

        <!-- Contenu Dynamique -->
        <div id="dynamicContent">
            <!-- Le contenu des autres pages sera chargé ici -->
        </div>
    </div>

    <!-- Liens vers Bootstrap JS et jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Fonction pour charger le contenu via AJAX
        function loadPage(page) {
            $.ajax({
                url: page,  // URL de la page PHP
                type: 'GET',
                success: function(response) {
                    $('#dynamicContent').html(response);  // Remplace le contenu de #dynamicContent avec la réponse
                },
                error: function() {
                    $('#dynamicContent').html('<p>Erreur lors du chargement de la page.</p>');
                }
            });
        }

        // Gérer les clics sur les liens de la sidebar
        $('#statistiquesLink').on('click', function() {
            loadPage('statistiques.php');  // Charge la page statistiques.php
            setActiveLink(this);
        });

        $('#gestionProduitsLink').on('click', function() {
            loadPage('ajouter_produit.php');  // Charge la page gestion_produits.php
            setActiveLink(this);
        });

        $('#commandesLink').on('click', function() {
            loadPage('commandes.php');  // Charge la page commandes.php
            setActiveLink(this);
        });

        $('#clientsLink').on('click', function() {
            loadPage('clients.php');  // Charge la page clients.php
            setActiveLink(this);
        });

        // Fonction pour mettre en surbrillance le lien actif
        function setActiveLink(element) {
            $('.sidebar a').removeClass('active');  // Retire la classe active de tous les liens
            $(element).addClass('active');  // Ajoute la classe active au lien cliqué
        }

        // Charger la page de tableau de bord par défaut
        loadPage('tableau_de_bord.php');
    </script>
</body>
</html>
