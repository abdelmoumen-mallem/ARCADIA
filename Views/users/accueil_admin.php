<?php

include $_SERVER['DOCUMENT_ROOT'] . 'layoutUsers/header.php';


require_once '../Controllers/StatistiquesController.php';
$statsController = new StatistiquesController();
$statsAdmin = $statsController->indexB();

require_once '../Controllers/AvisController.php';
$statsController = new AvisController();
$filtre = "";
$stats = $statsController->indexB($filtre);

$filtre = "WHERE visible = 0";
$statsVisible = $statsController->indexB($filtre);

require_once '../Controllers/AnimalController.php';
$animalController = new AnimalController();
$filtre = "2";
$animalMoyen = $animalController->indexD($filtre);
$filtre = "3";
$animalMauvais = $animalController->indexD($filtre);

?>

<div id="content">
    <div class="container mt-4">
        <div class="row">
            <div class="col-6">
                <h2>Statistiques</h2>
            </div>
        </div>
        <?php if ($_SESSION['id_user_arcadia']['role_id'] === 1) { ?>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">Prenom</th>
                        <th scope="col">Statistique</th>
                        <th scope="col">Dernier clic</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($statsAdmin as $statAdmin) : ?>
                        <tr>
                            <td><?= htmlspecialchars($statAdmin['prenom']) ?></td>
                            <td><?= htmlspecialchars($statAdmin['stats']) ?></td>
                            <td><?= htmlspecialchars($statAdmin['dateStats']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php } ?>
        <?php if ($_SESSION['id_user_arcadia']['role_id'] === 2) { ?>
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card text-center">
                            <div class="card-header">
                                Nombre avis
                            </div>
                            <div class="card-body">
                                <h2 class="card-title"><?= $stats ?></h2>
                                <p class="card-text">Le total des avis.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card text-center">
                            <div class="card-header">
                                Avis non visible
                            </div>
                            <div class="card-body">
                                <h2 class="card-title"><?= $statsVisible ?></h2>
                                <p class="card-text">Nombre d'avis non vus ou rejetés.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if ($_SESSION['id_user_arcadia']['role_id'] === 3) { ?>
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card text-center">
                            <div class="card-header">
                                Nombre état moyen animaux
                            </div>
                            <div class="card-body">
                                <h2 class="card-title"><?= $animalMoyen ?></h2>
                                <p class="card-text">Nombre d'animaux ayant un état moyen</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card text-center">
                            <div class="card-header">
                                Nombre état mauvais animaux
                            </div>
                            <div class="card-body">
                                <h2 class="card-title"><?= $animalMauvais ?></h2>
                                <p class="card-text">Nombre d'animaux ayant un état mauvais</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>