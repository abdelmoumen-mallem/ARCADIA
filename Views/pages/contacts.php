<?php

include $_SERVER['DOCUMENT_ROOT'] . 'layout/header.php';

$segment = explode('/', $_SERVER['REQUEST_URI']);

$message =  "";
$colorMessage = "";

if (isset($segment[2])) {
    if ($segment[2] === 'error1') {
        $message =  "Les informations sont manquantes";
        $colorMessage = "warning";
    } else if ($segment[2] === 'error2') {
        $message =  "Une erreur s'est produite";
        $colorMessage = "warning";
    } else {
        $message =  "Votre message a bien été envoyé";
        $colorMessage = "success";
    }
}


?>
<div class="container login-card text-center mt-5">
    <h1>Contact</h1>
    <div class="alert alert-<?= $colorMessage ?>" role="alert">
        <?= $message ?>
    </div>

    <form method="POST" action="/contacts">

        <div class="form-floating mb-3">
            <input type="text" name="titre" class="form-control" id="titre" placeholder="titre" required>
            <label for="titre">Titre</label>
        </div>

        <div class="form-floating mb-3">
            <textarea class="form-control" name="description" placeholder="Leave a comment here" id="description" style="height: 100px" required></textarea>
            <label for="description">Description</label>
        </div>

        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
            <label for="email">Votre email</label>
        </div>

        <button type="submit">Envoyer</button>
    </form>
</div>