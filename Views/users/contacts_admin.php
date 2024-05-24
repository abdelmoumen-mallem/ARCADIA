<?php

include $_SERVER['DOCUMENT_ROOT'] . 'layoutUsers/header.php';

require_once '../Controllers/ContactController.php';
$contactController = new ContactController();

$contacts = $contactController->index();


?>

<div id="content">
    <div class="container mt-4">
        <div class="row">
            <div class="col-6">
                <h2>Contact</h2>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Email</th>
                    <th class="text-center" scope="col">Titre</th>
                    <th class="text-center" scope="col">Description</th>
                    <th scope="col">Statut</th>
                    <th class="text-center" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact) : ?>
                    <tr>
                        <td><?= convertDate(htmlspecialchars($contact['date_creation']), false) ?></td>

                        <td><?= htmlspecialchars($contact['email']) ?></td>
                        <td><?= htmlspecialchars($contact['titre']) ?></td>

                        <td class="text-center">
                            <i class="bi bi-book btn btn-info" onclick="Avis.show('<?= htmlspecialchars(addslashes(str_replace(array("\n", '"', "'"), array(" ", '"', "'"), $contact['description'])), ENT_QUOTES) ?>')" title="Voir la description en detail" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"></i>
                        </td>
                        <td>
                            <?php if (htmlspecialchars($contact['statut']) == 1) : ?>
                                <div id="avis_<?= htmlspecialchars($contact['id']) ?>" class="badge text-bg-success">Vu</div>
                            <?php else : ?>
                                <div id="avis_<?= htmlspecialchars($contact['id']) ?>" class="badge text-bg-warning">Non-vu</div>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <input id="visible_<?= htmlspecialchars($contact['id']) ?>" class="form-check-input" type="checkbox" <?= $contact['statut'] == 1 ? 'checked' : '' ?> onclick="Avis.update('<?= htmlspecialchars($contact['id']) ?>', this.checked, '/visibleEmail', '/contact_admin','contact')" value="" id="flexCheckDefault">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <input type="hidden" id="csrf" value="<?= encodeTokenCsrf() ?>">

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