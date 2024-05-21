<?php

include $_SERVER['DOCUMENT_ROOT'] . 'layoutUsers/header.php';

require_once '../Controllers/AvisController.php';
$avisController = new AvisController();

$filtre = "";
$avis = $avisController->index($filtre);


?>

<div id="content">
    <div class="container mt-4">
        <div class="row">
            <div class="col-6">
                <h2>Avis</h2>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Nom</th>
                    <th s class="text-center" cope="col">Description</th>
                    <th class="text-center" scope="col">Note</th>
                    <th scope="col">Statut</th>
                    <th class="text-center" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($avis as $aviss) : ?>
                    <tr>
                        <td><?= $aviss['date_creation'] ?></td>

                        <td><?= $aviss['nom'] ?></td>
                        <td class="text-center">
                            <i class="bi bi-pencil btn btn-info" onclick="Avis.show('<?= addslashes(str_replace("\n", " ", $aviss['description'])) ?>')" title="Voir la description en detail" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"></i>
                        </td>
                        <td class="text-center"><?= $aviss['note'] ?></td>
                        <td>
                            <?php if ($aviss['visible'] == 1) : ?>
                                <div id="avis_<?= $aviss['id'] ?>" class="badge text-bg-success">Visible</div>
                            <?php else : ?>
                                <div id="avis_<?= $aviss['id'] ?>" class="badge text-bg-danger">Non-visible</div>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <input id="visible_<?= $aviss['id'] ?>" class="form-check-input" type="checkbox" <?= $aviss['visible'] == 1 ? 'checked' : '' ?> onclick="Avis.update('<?= $aviss['id'] ?>', this.checked, '/visibleAvis', '/avis_admin')" value="" id="flexCheckDefault">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop1Label1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdrop1Label1"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class=" modal-body">
                    <p id="description"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
</div>