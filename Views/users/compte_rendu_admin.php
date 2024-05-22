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

require_once '../Controllers/CompteRenduController.php';
$compteRendusController = new CompteRenduController();
$compteRendus = $compteRendusController->index($filtre);



require_once '../Controllers/AnimalController.php';
$animalsController = new AnimalController();
$animals = $animalsController->index();



?>

<div id="content">
    <div class="container mt-4">
        <div class="row">
            <div class="col-6">
                <h2>Rapport vétérinaire</h2>
            </div>
            <div class="col-6 text-end">
                <div class="btn btn-primary" onclick="General.action('Creation','/compte_rendu_admin_insert','compte_rendu')" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">Ajouter un rapport <i class="bi bi-plus-square"></i></div>
            </div>
        </div>
        <div class="row">
            <div class="col-6"></div>
            <div class="col-6 text-end">
                <form method="POST" action="/compte_rendu_admin_filtre">
                    <div class="row">
                        <div class="col">
                            <select name="animalId" class="form-select mb-3" aria-label="animalId">
                                <option selected value="">Choix de l'animal</option>
                                <?php foreach ($animals as $animal) : ?>
                                    <option value="<?= $animal['id'] ?>" <?= ($_POST['animalId'] ?? '') == $animal['id'] ? 'selected' : '' ?>><?= $animal['prenom'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col">
                            <input type="date" name="date" value="<?= $_POST['date'] ?? '' ?>" class="form-control">
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
                    <th scope="col">Etat</th>
                    <th scope="col">Nourriture</th>
                    <th scope="col">Grammage</th>
                    <th scope="col">Date</th>
                    <th scope="col" class="text-center">Detail</th>
                    <th scope="col" class="text-center">Modifier</th>
                    <th scope="col" class="text-center">Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($compteRendus as $compteRendu) : ?>
                    <tr>
                        <td><?= $compteRendu['prenom'] . ' (' . $compteRendu['nom'] . ')' ?></td>
                        <td>
                            <?php if ($compteRendu['etat'] == 1) : ?>
                                <div class="badge text-bg-success">Bon</div>
                            <?php elseif ($compteRendu['etat'] == 2) : ?>
                                <div class="badge text-bg-warning">Moyen</div>
                            <?php else : ?>
                                <div class="badge text-bg-danger">Mauvais</div>
                            <?php endif; ?>
                        </td>
                        <td><?= $compteRendu['nouriture'] ?></td>
                        <td><?= $compteRendu['grammage'] ?></td>
                        <td><?= convertDate($compteRendu['date_creation'], false) ?></td>

                        <td class="text-center">
                            <i class="bi bi-book btn btn-info" onclick="General.show('<?= addslashes(str_replace("\n", " ", $compteRendu['description'])) ?>')" title="Voir la description en detail" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"></i>
                        </td>

                        <td class="text-center">
                            <i class="bi bi-pencil btn btn-warning" onclick="General.fetch(<?= $compteRendu['id'] ?> , '/compte_rendu_admin_show', 'compte_rendu')" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"></i>

                        </td>
                        <td class="text-center">
                            <i class="bi bi-trash3 btn btn-danger" onclick="General.delete(<?= $compteRendu['id'] ?> , '/compte_rendu_admin_delete', 'compte_rendu')"></i>
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

                <div class="form-floating">
                    <select name="etat" id="etat" class="form-select mb-3" aria-label="etat">
                        <option value="1">Bon</option>
                        <option value="2">Moyen</option>
                        <option value="3">Mauvais</option>
                    </select>
                    <label for="etat">Etat</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nouriture" placeholder="nouriture">
                    <label for="nouriture">Nourriture</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="grammage" placeholder="grammage">
                    <label for="grammage">Grammage</label>
                </div>

                <div class="form-floating mb-3">
                    <textarea id="description" class="form-control" placeholder="Leave a comment here"></textarea>
                    <label for="description">Description</label>
                </div>

                <div class=" mt-3" id="msg"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="window.location.reload();">Fermer</button>
                <button type=" button" class="btn btn-primary" id="validation" data-action="" onclick="General.insert(this.getAttribute('data-action'), 'compte_rendu')">Valider</button>
            </div>
        </div>
    </div>
</div>