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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../js/General.js"></script>
</head>

<?php
require_once '../Controllers/UtilsController.php';
$utilController = new UtilsController();
?>

<body>
    <nav class="navbar navbar-expand bg-light">
        <div class="container-fluid">

            <a class="navbar-brand d-none d-lg-inline" href="/accueil_admin">
                <img src="../img/arcadia_logo1.png" alt="Arcadia Logo">
            </a>

            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                <i class="bi bi-list"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">


                <div class="d-flex ms-auto" title="Déconnexion">
                    <a class="nav-link" href="/deconnexion">
                        <div class="rounded-bottom-1 bg-primary text-white px-2 py-1"><?= $_SESSION['id_user_arcadia']['prenom'] ?> <i class="bi bi-box-arrow-in-right"></i></div>

                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="staticBackdropLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
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
                    <li class="nav-item">
                        <a class="nav-link <?php echo $utilController->isActive('/roles_admin') ?>" href="/roles_admin">Roles</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>