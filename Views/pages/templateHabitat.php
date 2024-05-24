<?php

require_once '../Controllers/AnimalController.php';
$animalsController = new AnimalController();
$id = $_POST['id'];
$type = $_POST['type'];

$animals = $animalsController->indexC($id);

?>

<div id="content">
    <div class="container mt-4">
        <h2 class="text-center">Prénom des animaux de type <?= htmlspecialchars($type) ?></h2>
        <div class="row">
            <?php foreach ($animals as $animal) : ?>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <button id="animal_<?= $animal['animalId'] ?>" class="btn btn-primary" onclick="Avis.showAnimal(<?= $animal['animalId'] ?>,'/stats', '<?= $type ?>', 'stats')" type="button" data-bs-toggle="collapse" data-bs-target="#animal<?= $animal['animalId'] ?>">
                                <?= htmlspecialchars($animal['prenom']) ?>
                            </button>
                        </div>
                        <div id="animal<?= $animal['animalId'] ?>" class="collapse">
                            <div class="card-body">
                                <p><strong>Description:</strong> <?= htmlspecialchars($animal['description']) ?></p>
                                <p><strong>État:</strong>
                                    <?php if ($animal['etat'] == 1) : ?>
                                        <span class="badge text-bg-success">Bon</span>
                                    <?php elseif ($animal['etat'] == 2) : ?>
                                        <span class="badge text-bg-warning">Moyen</span>
                                    <?php elseif ($animal['etat'] == 3) : ?>
                                        <span class="badge text-bg-danger">Mauvais</span>
                                    <?php endif; ?>
                                </p>
                                <p><strong>Nourriture:</strong> <?= htmlspecialchars($animal['nouriture']) ?></p>
                                <p><strong>Grammage:</strong> <?= htmlspecialchars($animal['grammage']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>