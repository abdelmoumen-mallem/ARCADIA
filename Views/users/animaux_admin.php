<?php

include $_SERVER['DOCUMENT_ROOT'] . 'layoutUsers/header.php';

require_once '../Controllers/AnimalController.php';
$animalsController = new AnimalController();
$animals = $animalsController->index();

require_once '../Controllers/RacesController.php';
$racesController = new RacesController();
$races = $racesController->index();

require_once '../Controllers/HabitatsController.php';
$habitatsController = new HabitatsController();
$habitats = $habitatsController->index();


?>

<div id="content">
    <div class="container mt-4">
        <div class="row">
            <div class="col-6">
                <h2>Animaux</h2>
            </div>
            <div class="col-6 text-end">
                <div class="btn btn-primary" onclick="General.action('Creation','/animaux_admin_insert','animaux')" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">Ajouter un animal <i class="bi bi-plus-square"></i></div>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Prénom</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Race</th>
                    <th scope="col">Habitat</th>
                    <th scope="col">Date de création</th>
                    <th scope="col" class="text-center">Modifier</th>
                    <th scope="col" class="text-center">Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($animals as $animal) : ?>
                    <tr>
                        <td><?= htmlspecialchars($animal['prenom']) ?></td>
                        <td>
                            <?php if ($animal['statut'] == 1) : ?>
                                <div class="badge text-bg-success">Activé</div>
                            <?php else : ?>
                                <div class="badge text-bg-danger">Désactivé</div>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($animal['race_nom']) ?></td>
                        <td><?= htmlspecialchars($animal['habitat_nom']) ?></td>
                        <td><?= convertDate(htmlspecialchars($animal['date_creation']), false) ?></td>
                        <td class="text-center">
                            <i class="bi bi-pencil btn btn-warning" onclick="General.fetch(<?= htmlspecialchars($animal['id']) ?> , '/animaux_admin_show','animaux')" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"></i>

                        </td>
                        <td class="text-center">
                            <i class="bi bi-trash3 btn btn-danger" onclick="General.delete(<?= htmlspecialchars($animal['id']) ?> , '/animaux_admin_delete','animaux')"></i>
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

                <input type="hidden" id="csrf" value="<?= encodeTokenCsrf() ?>">


                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="prenom" placeholder="Prenom">
                    <label for="prenom">Prenom</label>
                </div>

                <div class="form-floating">
                    <select name="race" id="race" class="form-select mb-3" aria-label="race">
                        <?php foreach ($races as $race) : ?>
                            <option value="<?= htmlspecialchars($race['id']) ?>"><?= htmlspecialchars($race['nom']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="race">Race</label>
                </div>

                <div class="form-floating">
                    <select name="habitat" id="habitat" class="form-select mb-3" aria-label="habitat">
                        <?php foreach ($habitats as $habitat) : ?>
                            <option value="<?= htmlspecialchars($habitat['id']) ?>"><?= htmlspecialchars($habitat['nom']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="habitat">Habitat</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="statut">
                    <label class="form-check-label" for="defaultCheck1">
                        Activation/Desactivation
                    </label>
                </div>

                <div class=" mt-3" id="msg"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="window.location.reload();">Fermer</button>
                <button type=" button" class="btn btn-primary" id="validation" data-action="" onclick="General.insert(this.getAttribute('data-action'), 'animaux')">Valider</button>
            </div>
        </div>
    </div>
</div>