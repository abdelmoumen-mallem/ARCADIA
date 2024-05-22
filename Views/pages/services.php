<?php

include $_SERVER['DOCUMENT_ROOT'] . 'layout/header.php';

require_once '../Controllers/ServicesController.php';
$servicesController = new ServicesController();

$services = $servicesController->index();

?>

<header class="fond-vert-services">
    <div class="container mt-5 text-center ">
        <h1>Les services</h1>
    </div>
</header>

<div class="container">


    <?php
    foreach ($services as $service) :
    ?>
        <div class="card mb-5 mt-5">
            <img src="./img/<?= $service['image_url'] ?>" class="cardImg" alt="<?= $service['nom'] ?> Arcadia">
            <div class="card-body">
                <h2 class="card-title"><?= $service['nom'] ?></h2>
                <p class="card-text">
                    <?= nl2br($service['description']) ?>
                </p>
            </div>
        </div>
    <?php
    endforeach;
    ?>

</div>


<?php include $_SERVER['DOCUMENT_ROOT'] . 'layout/footer.php'; ?>