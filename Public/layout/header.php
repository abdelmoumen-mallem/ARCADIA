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
</head>

<?php
require_once '../Utils/utils.php';
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
                        <a class="nav-link <?php echo isActive('/') ?>" href="/">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo isActive('/services') ?>" href="/services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo isActive('/habitats') ?>" href="/habitats">Habitats</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo isActive('/contacts') ?>" href="/contacts">Contacts</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a class="nav-link" href="/connexion">Connexion</a>
                </div>
            </div>
        </div>
    </nav>