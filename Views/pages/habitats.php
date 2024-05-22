<?php
include $_SERVER['DOCUMENT_ROOT'] . 'layout/header.php';

require_once '../Controllers/HabitatsController.php';
$habitatController = new HabitatsController();
$habitats = $habitatController->index();

require_once '../Controllers/AnimalController.php';
$animalController = new AnimalController();

?>

<header class="fond-vert-habitats">
    <div class="container mt-5 text-center ">
        <h1>Les habitats</h1>
    </div>
</header>

<div class="container">

    <?php
    foreach ($habitats as $habitat) :
    ?>
        <div class="card mb-5 mt-5">
            <img src="./img/<?= $habitat['image_url'] ?>" class="cardImg" alt="<?= $habitat['nom'] ?>  Arcadia">
            <div class="card-body">
                <h2 class="card-title"><?= $habitat['nom'] ?></h2>
                <p class="card-text">
                    <?= nl2br($habitat['description']) ?>
                </p>
                <h3 class="card-title text-center">Les animaux</h3>
                <div class="row justify-content-center">

                    <?php
                    $animals = $animalController->indexB($habitat['id']);
                    foreach ($animals as $animal) :
                    ?>
                        <div class="col-auto text-center">
                            <img src="./img/<?= $animal['race_image'] ?>" class="img-thumbnail square-img" alt="<?= $animal['race_nom'] ?>  Arcadia"><br>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <?= $animal['race_nom'] ?>
                            </button>
                        </div>
                    <?php
                    endforeach;
                    ?>

                </div>
            </div>
        </div>
    <?php
    endforeach;
    ?>

</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>


<?php include $_SERVER['DOCUMENT_ROOT'] . 'layout/footer.php'; ?>