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
    <div class="row">
        <div class="col-6">
            <h2>Collaborateurs</h2>
        </div>
        <div class="col-6 text-end">
            <div class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop1" onclick="Collaborateurs.actionCollaborateurs('Creation','/collaborateurs_admin_insert')">Ajouter un collaborateur <i class="bi bi-plus-square"></i></div>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Email</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Statut</th>
                <th scope="col">Rôle</th>
                <th scope="col">Date de création</th>
                <th scope="col" class="text-center">Modifier</th>
                <th scope="col" class="text-center">Supprimer</th>
                <th scope="col" class="text-center">Password</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($collaborateurs as $collaborateur) : ?>
                <tr>
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
                            <i class="bi bi-pencil btn btn-warning" onclick="Collaborateurs.fetchCollaborateurInfo(<?= $collaborateur['id'] ?> , '/collaborateurs_admin')" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"></i>
                        <?php } ?>

                    </td>
                    <td class="text-center">
                        <?php if ($_SESSION['id_user_arcadia']['role_id'] === 1) { ?>
                            <?php if ($_SESSION['id_user_arcadia']['id'] !== 1 || $_SESSION['id_user_arcadia']['id'] !== $collaborateur['id']) { ?>
                                <i class="bi bi-trash3 btn btn-danger" onclick="Collaborateurs.deleteCollaborateurs(<?= $collaborateur['id'] ?> , '/collaborateurs_admin_delete')"></i>
                            <?php } ?>
                        <?php } ?>
                    </td>
                    <td class="text-center">
                        <i class="bi bi-envelope-check btn btn-info" title="Envoi de mail de modification de password" onclick="Collaborateurs.passwordCollaborateurs(<?= $collaborateur['id'] ?>,'<?= $collaborateur['username'] ?>', '<?= $collaborateur['nom'] ?>', '<?= $collaborateur['prenom'] ?>', '/collaborateurs_admin_mail')"></i>
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
                <h1 class="modal-title fs-5" id="staticBackdrop1Label1"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="window.location.reload();"></button>
            </div>
            <div class=" modal-body">

                <input type="hidden" id="id_collaborateur">

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="username" placeholder="Email">
                    <label for="username">Email</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nom" placeholder="Nom">
                    <label for="nom">Nom</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="prenom" placeholder="Prenom">
                    <label for="prenom">Prenom</label>
                </div>

                <select name="role" id="role_id" class="form-select mb-3" aria-label="role">
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

                <div class=" mt-3" id="msg"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="window.location.reload();">Fermer</button>
                <button type=" button" class="btn btn-primary" id="validation" data-action="" onclick="Collaborateurs.updateCollaborateur(this.getAttribute('data-action'))">Valider</button>
            </div>
        </div>
    </div>
</div>