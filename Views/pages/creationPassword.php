<?php
require_once '..//Utils/utils.php';

$segmentsParameter = explode('/', $_SERVER['REQUEST_URI']);

$valueParameter = explode('_', $segmentsParameter[2]);

$time = $valueParameter[0];
$id = $valueParameter[1];

$timeDifference = (time() - $time) / 60;

if ($timeDifference > 30) {
    header("Location: /error");
}

$showMessage = ' d-none';
$errorMessage = '';

if (isset($valueParameter[2])) {
    $showMessage = '';

    if ($valueParameter[2] == "error1") {
        $errorMessage = 'Les informations sont manquantes';
    } else if ($valueParameter[2] == "error2") {
        $errorMessage = 'Les mots de passe sont differents';
    } else if ($valueParameter[2] == "error3") {
        $errorMessage = 'Le mot de passe doit avoir au moins 8 caractères';
    } else if ($valueParameter[2] == "error4") {
        $errorMessage = 'Le mot de passe doit avoir au moins une majuscule, une minuscule, un chiffre et un caractère spécial';
    } else if ($valueParameter[2] == "error5") {
        $errorMessage = 'Une erreur s\'est produite';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo Arcadia</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="../js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container login-card text-center mt-5">
        <h1>Enregistrement du mot de passe</h1>
        <div class="alert alert-warning <?= $showMessage  ?>" role="alert">
            <?= $errorMessage ?>
        </div>

        <form method="POST" action="/creationPassword/<?= $segmentsParameter[2] ?>">
            <input type="password" name="password1" placeholder="Saisissez le mot de passe" required>
            <input type="password" name="password2" placeholder="Resaisissez le mot de passe" required>
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="time" value="<?= $time ?>">
            <button type="submit">Se connecter</button>
        </form>
    </div>

</body>

</html>