<?php

$segmentsParameter = explode('/', $_SERVER['REQUEST_URI']);

$errorParameter = isset($segmentsParameter[2]) ? '' : ' d-none';

if (isset($segmentsParameter[2]) && $segmentsParameter[2] !== 'error') {
    //header('HTTP/1.1 404 Not Found');
    header("Location: /error");

    exit();
}

include $_SERVER['DOCUMENT_ROOT'] . 'layout/header.php';

?>

<div class="container login-card text-center mt-5">
    <h1>Connexion des Collaborateurs</h1>

    <div class="alert alert-warning <?= $errorParameter  ?>" role="alert">
        Erreur d'identification.
    </div>

    <form method="POST" action="/connexion">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>
</div>

</body>

</html>