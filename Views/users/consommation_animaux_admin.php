<?php

include $_SERVER['DOCUMENT_ROOT'] . 'layoutUsers/header.php';

$filtre = "";
if (isset($_POST['submit'])) {
    $animalId = $_POST['animalId'];
    $date = $_POST['date'];

    if (!empty($date) && !empty($animalId)) {
        $filtre .= "WHERE r.date_creation = '$date' AND r.animal_id = '$animalId'";
    } elseif (!empty($date)) {
        $filtre .= "WHERE r.date_creation = '$date'";
    } elseif (!empty($animalId)) {
        $filtre .= "WHERE r.animal_id = '$animalId'";
    }
}

require_once '../Controllers/ConsommationsController.php';
$consommationsController = new ConsommationsController();
$consommations = $consommationsController->index($filtre);

require_once '../Controllers/AnimalController.php';
$animalsController = new AnimalController();
$animals = $animalsController->index();

?>

<div id="content">
    <div class="container mt-4">
        <div class="row">
            <div class="col-6">
                <h2>Consommations</h2>
            </div>
            <div class="col-6 text-end">
                <div class="btn btn-primary" onclick="General.action('Creation','/consommation_animaux_admin_insert','consommations')" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">Ajouter une consommation <i class="bi bi-plus-square"></i></div>
            </div>
        </div>
        <div class="row">
            <div class="col-6"></div>
            <div class="col-6 text-end">
                <form method="POST" action="/consommation_animaux_admin_filtre">
                    <div class="row">
                        <div class="col">
                            <select name="animalId" class="form-select mb-3" aria-label="animalId">
                                <option selected value="">Choix de l'animal</option>
                                <?php foreach ($animals as $animal) : ?>
                                    <option value="<?= $animal['id'] ?>"><?= $animal['prenom'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col">
                            <input type="date" name="date" class="form-control">
                        </div>
                        <div class="col">
                            <input type="submit" name="submit" class="btn btn-success">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Prénom</th>
                    <th scope="col">Nourriture</th>
                    <th scope="col">Grammage</th>
                    <th scope="col">Date</th>
                    <th scope="col" class="text-center">Modifier</th>
                    <th scope="col" class="text-center">Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($consommations as $consommation) : ?>
                    <tr>
                        <td><?= $consommation['prenom'] . ' (' . $consommation['nom'] . ')' ?></td>
                        <td><?= $consommation['nouriture'] ?></td>
                        <td><?= $consommation['grammage'] ?></td>
                        <td><?= convertDate($consommation['date_creation'], true) ?></td>

                        <td class="text-center">
                            <i class="bi bi-pencil btn btn-warning" onclick="General.fetch(<?= $consommation['id'] ?> , '/consommation_animaux_admin_show', 'consommations')" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"></i>

                        </td>
                        <td class="text-center">
                            <i class="bi bi-trash3 btn btn-danger" onclick="General.delete(<?= $consommation['id'] ?> , '/consommation_animaux_admin_delete', 'consommations')"></i>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop1Label1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdrop1Label1"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="window.location.reload();"></button>
            </div>
            <div class="modal-body" id="modalBody">

                <input type="hidden" id="id">

                <input type="hidden" id="utilisateur_id" value="<?= $_SESSION['id_user_arcadia']['id'] ?>">

                <div class="form-floating">
                    <select name="animal_id" id="animal_id" class="form-select mb-3" aria-label="animal_id">
                        <?php foreach ($animals as $animal) : ?>
                            <option value="<?= $animal['id'] ?>"><?= $animal['prenom'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="animal_id">Animal</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nouriture" placeholder="nouriture">
                    <label for="nouriture">Nourriture</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="grammage" placeholder="grammage">
                    <label for="grammage">Grammage</label>
                </div>

                <div class=" mt-3" id="msg"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="window.location.reload();">Fermer</button>
                <button type=" button" class="btn btn-primary" id="validation" data-action="" onclick="General.insert(this.getAttribute('data-action'), 'consommations')">Valider</button>
            </div>
        </div>
    </div>
</div>