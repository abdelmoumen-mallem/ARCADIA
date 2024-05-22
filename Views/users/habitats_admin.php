<?php

include $_SERVER['DOCUMENT_ROOT'] . 'layoutUsers/header.php';

require_once '../Controllers/HabitatsController.php';
$habitatsController = new HabitatsController();

$habitats = $habitatsController->index();

?>

<div id="content">
    <div class="container mt-4">
        <div class="row">
            <div class="col-6">
                <h2>Habitats</h2>
            </div>
            <div class="col-6 text-end">
                <div class="btn btn-primary" onclick="Services.actionServices('Creation','/habitats_admin_insert')" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">Ajouter un habitat <i class="bi bi-plus-square"></i></div>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th s class="text-center" cope="col">Description</th>
                    <th scope="col" class="text-center">Modifier</th>
                    <th scope="col" class="text-center">Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($habitats as $habitat) : ?>
                    <tr>
                        <td><?= $habitat['nom'] ?></td>

                        <td class="text-center">
                            <i class="bi bi-book btn btn-info" onclick="Services.show('<?= addslashes(str_replace("\n", " ", $habitat['description'])) ?>')" title="Voir la description en detail" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"></i>
                        </td>

                        <td class="text-center">
                            <i class="bi bi-pencil btn btn-warning" onclick="Services.fetchServices(<?= $habitat['id'] ?> , '/habitats_admin_show','habitats')" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"></i>

                        </td>
                        <td class="text-center">
                            <i class="bi bi-trash3 btn btn-danger" onclick="Services.deleteServices(<?= $habitat['id'] ?> , '/habitats_admin_delete','habitats')"></i>
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

                <input type="hidden" id="id_service">
                <input type="hidden" id="image_url">

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nom" placeholder="Nom">
                    <label for="nom">Nom</label>
                </div>

                <div class="form-floating mb-3">
                    <textarea id="description" class="form-control" placeholder="Leave a comment here"></textarea>
                    <label for="description">Description</label>
                </div>

                <a href="" target="_blank" id="openFile" class="btn btn-primary mb-3 d-none">Voir l'image</a>

                <div class="mb-3">
                    <label for="formFile" class="form-label" id="labelFicher"></label>
                    <input class="form-control" type="file" id="formFile">
                </div>

                <div class=" mt-3" id="msg"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="window.location.reload();">Fermer</button>
                <button type=" button" class="btn btn-primary" id="validation" data-action="" onclick="Services.insertServices(this.getAttribute('data-action'),'habitats')">Valider</button>
            </div>
        </div>
    </div>
</div>