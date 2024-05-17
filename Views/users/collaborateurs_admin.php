<?php
include $_SERVER['DOCUMENT_ROOT'] . 'layoutUsers/header.php';

require_once '../Controllers/CollaborateursController.php';
$collaborateursController = new CollaborateursController();
$collaborateurs = $collaborateursController->index();


require_once '../Controllers/RolesController.php';
$rolesController = new RolesController();
$roles = $rolesController->index();


?>




<div class="container mt-4">
    <h2>Collaborateurs</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Email</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Statut</th>
                <th scope="col">Rôle</th>
                <th scope="col">Date de création</th>
                <th scope="col" class="text-center">Modifier</th>
                <th scope="col" class="text-center">Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($collaborateurs as $collaborateur) : ?>
                <tr>
                    <th scope="row"><?= $collaborateur['id'] ?></th>
                    <td><?= $collaborateur['username'] ?></td>
                    <td><?= $collaborateur['nom'] ?></td>
                    <td><?= $collaborateur['prenom'] ?></td>
                    <td>
                        <?php if ($collaborateur['statut'] == 1) : ?>
                            <div class="badge text-bg-success">Activé</div>
                        <?php else : ?>
                            <div class="badge text-bg-danger">Désactivé</div>
                        <?php endif; ?>
                    </td>
                    <td><?= $collaborateur['role_nom'] ?></td>
                    <td><?= $collaborateur['date_creation'] ?></td>
                    <td class="text-center">
                        <?php if ($_SESSION['id_user_arcadia']['role_id'] === 1) { ?>
                            <?php if ($_SESSION['id_user_arcadia']['id'] === $collaborateur['id']) { ?>
                                <i class="bi bi-pencil btn btn-warning" onclick="General.fetchCollaborateurInfo(<?= $collaborateur['id'] ?>, '/data')" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"></i>
                            <?php } ?>
                        <?php } ?>

                    </td>
                    <td class="text-center">
                        <?php if ($_SESSION['id_user_arcadia']['role_id'] === 1) { ?>
                            <?php if ($_SESSION['id_user_arcadia']['id'] !== 1 || $_SESSION['id_user_arcadia']['id'] !== $collaborateur['id']) { ?>
                                <i class="bi bi-trash3 btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"></i>
                            <?php } ?>
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop1Label1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdrop1Label1">Modification</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="username" placeholder="Email">
                    <label for="username">Email</label>
                </div>

                <div class="form-floating">
                    <input type="text" class="form-control" id="nom" placeholder="Nom">
                    <label for="nom">Nom</label>
                </div>

                <div class="form-floating">
                    <input type="text" class="form-control" id="prenom" placeholder="Prenom">
                    <label for="prenom">Prenom</label>
                </div>

                <select name="role" id="role_id" class="form-select" aria-label="role">
                    <?php foreach ($roles as $role) : ?>
                        <option value="<?= $role['id'] ?>"><?= $role['nom'] ?></option>
                    <?php endforeach; ?>
                </select>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="statut">
                    <label class="form-check-label" for="defaultCheck1">
                        Activation/Desactivation
                    </label>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Valider</button>
            </div>
        </div>
    </div>
</div>