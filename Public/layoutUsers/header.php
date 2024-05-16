<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo Arcadia</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="../js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<?php
require_once '../Controllers/UtilsController.php';
$utilController = new UtilsController();
?>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="/">
                <img src="../img/arcadia_logo1.png" alt="Arcadia Logo">
            </a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $utilController->isActive('/accueil_admin') ?>" href="/accueil_admin">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $utilController->isActive('/collaborateurs_admin') ?>" href="/collaborateurs_admin">Collaborateurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $utilController->isActive('/services_admin') ?>" href="/services_admin">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $utilController->isActive('/habitats_admin') ?>" href="/habitats_admin">Habitats</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $utilController->isActive('/animaux_admin') ?>" href="/animaux_admin">Animaux</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $utilController->isActive('/horaires_admin') ?>" href="/horaires_admin">Horaires</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $utilController->isActive('/comptes_rendus_admin') ?>" href="/compte_rendu_admin">Comptes rendus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $utilController->isActive('/consommation_animaux_admin') ?>" href="/consommation_animaux_admin">Consommations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $utilController->isActive('/avis_admin') ?>" href="/avis_admin">Avis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $utilController->isActive('/contacts_admin') ?>" href="/contacts_admin">Contacts</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a class="nav-link" href="/deconnexion">Deconnexion</a>
                </div>
            </div>
        </div>
    </nav>