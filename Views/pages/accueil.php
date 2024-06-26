<!-- Page accueil -->

<!-- Inclusion navbar -->
<?php

include $_SERVER['DOCUMENT_ROOT'] . 'layout/header.php';

require_once '../Controllers/AvisController.php';
$avisController = new AvisController();

$filtre = 'WHERE visible = 1';
$avis = $avisController->index($filtre);

?>

<header class="fond-vert">
    <div class="container mt-5 text-center ">
        <h1>Bienvenue au Zoo Arcadia</h1>
    </div>
</header>

<!-- Contenu de la page -->
<div class="container">

    <section class="mt-5 text-center">
        <p>
            Le Zoo Arcadia est un magnifique parc zoologique situé en France, près de la forêt de Brocéliande en Bretagne, depuis 1960.
            Nous sommes fiers de vous accueillir dans notre zoo où vous pourrez découvrir une grande diversité d'animaux répartis dans différents habitats.
            Engagé dans la protection de l'environnement et la préservation des espèces, le Zoo Arcadia fonctionne de manière entièrement autonome en termes d'énergie, utilisant des sources renouvelables pour minimiser notre impact sur la planète.
        </p>
        <p class="d-none d-md-block">
            Chaque aspect de notre gestion quotidienne, de la santé animale aux systèmes d'alimentation, est conçu pour être durable et respectueux de l'environnement. Rejoignez-nous pour une expérience où vous pourrez non seulement admirer la beauté naturelle de notre faune mais aussi apprendre l'importance de la conservation écologique dans un cadre inspirant et éducatif.
        </p>
    </section>

    <section>
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://www.conservation-nature.fr/wp-content/uploads/2021/03/lion.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://www.conservation-nature.fr/wp-content/uploads/2020/10/elephant.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://www.conservation-nature.fr/wp-content/uploads/2021/08/guepard.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section><br><br>

    <!-- Habitats -->
    <section class="row d-flex align-items-center mt-5 mb-5 sectionAbs">
        <div class="containerFeuille d-none d-md-block">
            <img class="feuilleDouble" src="https://cdn-images.zoobeauval.com/BZBAj9txWh8gNamnhQL_dn3gNw4=/377x713/https%3A%2F%2Fs3.eu-west-3.amazonaws.com%2Fassets.zoobeauval.com%2F2024%2F5%2Fstatic%2Fleaves%2Fhome-leaf-left.7f147c76.webp" alt="">
        </div>
        <h1 class="text-center">Des habitats naturels <i class="bi bi-house-check"></i></h1>
        <div class="col-md-6">
            <div class="card">
                <img src="https://www.conservation-nature.fr/wp-content/uploads/2020/10/savane-1.jpg" class="card-img-top" alt="Savane">
                <div class="card-body">
                    <h2 class="card-title">Les habitats</h2>
                    <p class="card-text">Le Zoo Arcadia présente trois principaux types d'habitats, chacun représentant un écosystème unique avec sa propre faune et flore</p>
                    <a href="/habitats" class="btn btn-primary">En savoir plus</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <ul class="list-group list-group-square">
                <li class="list-group-item mt-2 mb-2">La jungle est une forêt dense et luxuriante, habitée par une grande variété d'espèces animales et végétales.</li>
                <li class="list-group-item mt-2">Le marais est un écosystème humide caractérisé par une abondance d'eau stagnante et une végétation adaptée aux conditions humides.</li>
                <li class="list-group-item mt-2">La savane est un écosystème caractérisé par une végétation clairsemée, des arbres dispersés et une faune variée.</li>
            </ul>
        </div>
    </section>

    <!-- Services -->
    <section class="row d-flex align-items-center mt-5 mb-5">

        <h1 class="text-center"><i class="bi bi-brightness-high"></i> Des services ecolos</h1>
        <div class="col-md-6">
            <ul class="list-group list-group-square">
                <li class="list-group-item mt-2 mb-2">Visites guidées : Explorez les différents habitats avec un guide qui vous fournira des informations sur les animaux et leurs environnements naturels.</li>
                <li class="list-group-item mt-2">Ateliers éducatifs : Participer à des ateliers conçus pour tous les âges, axés sur la conservation et l'écologie.</li>
                <li class="list-group-item mt-2">Restauration : Profitez de nos multiples points de restauration qui servent une variété de plats, y compris des options végétariennes et locales.</li>
                <li class="list-group-item mt-2">Visites en petit train : Embarquez pour un tour du zoo à bord de notre petit train, une façon confortable et amusante de découvrir tous les animaux.</li>
            </ul>
        </div>
        <div class="col-md-6">
            <div class="card">
                <img src="https://agriculture.gouv.fr/sites/default/files/15240_082.jpg" class="card-img-top" alt="Savane">
                <div class="card-body">
                    <h2 class="card-title">Les services</h2>
                    <p class="card-text">Au Zoo Arcadia, nous offrons une gamme complète de services pour enrichir votre visite et vous faire découvrir la faune de manière immersive et éducative.</p>
                    <a href="/services" class="btn btn-success">En savoir plus</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Animaux -->
    <section class="row d-flex align-items-center mt-5 mb-5 sectionAbs">
        <div class="containerFeuille1 text-end d-none d-md-block">
            <img class="feuilleDouble1" src="https://cdn-images.zoobeauval.com/BZBAj9txWh8gNamnhQL_dn3gNw4=/377x713/https%3A%2F%2Fs3.eu-west-3.amazonaws.com%2Fassets.zoobeauval.com%2F2024%2F5%2Fstatic%2Fleaves%2Fhome-leaf-left.7f147c76.webp" alt="">
        </div>

        <h1 class="text-center">Des animaux protégés <i class="bi bi-life-preserver"></i></h1>
        <div class="col-md-6">
            <div class="card">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSqjrmg5fh6OhC-N575ncnqbw3kaFykXAR-YQ&usqp=CAU" class="card-img-top" alt="Savane">
                <div class="card-body">
                    <h2 class="card-title">Les animaux</h2>
                    <p class="card-text">Découvrez la riche diversité de la faune que nous hébergeons, répartie en fonction de leur habitat naturel, chaque zone vous offre un aperçu unique des espèces qu'elle abrite. Nous participons au programme WWF lié a la protections de nos animaux.</p>
                    <a href="https://www.wwf.fr/" class="btn btn-danger">En savoir plus</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <ul class="list-group list-group-square">
                <li class="list-group-item mt-2 mb-2">Savane: Rencontrez nos lions, girafes et éléphants qui errent dans un espace qui imite leur habitat naturel africain.</li>
                <li class="list-group-item mt-2">Jungle: Plongez dans un monde de verdure dense où vivent des jaguars, des singes araignées, et une multitude d'oiseaux tropicaux.</li>
                <li class="list-group-item mt-2">Marais: Explorez un écosystème humide peuplé par des crocodiles, des loutres et des hippopotames.</li>
            </ul>
        </div>
    </section>

    <!-- Avis -->
    <section>
        <div class="container my-5">
            <h2 class="text-center">Avis des visiteurs</h2>
            <div id="avisCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $premierElement = true;
                    foreach ($avis as $aviss) :
                    ?>
                        <div class="carousel-item <?php echo $premierElement ? 'active' : ''; ?>">
                            <div class="card">
                                <div class="card-body">
                                    <h5><?= $aviss['nom'] ?></h5>
                                    <p class="small text-muted">Le <?= convertDate($aviss['date_creation'], false) ?></p>
                                    <p><?= $aviss['description'] ?></p>
                                    <div>
                                        <div>
                                            <?php

                                            $restant = 5 - $aviss['note'];

                                            for ($i = 0; $i < $aviss['note']; $i++) {
                                                echo '<i class="bi bi-star-fill text-warning"></i>';
                                            }

                                            for ($i = 0; $i < $restant; $i++) {
                                                echo '<i class="bi bi-star"></i>';
                                            }
                                            ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        $premierElement = false;
                    endforeach;
                    ?>
                </div>
            </div>
            <div class="btn btn-primary mt-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">Dèposer un avis <i class="bi bi-plus-square"></i></div>

        </div>

    </section>

    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop1Label1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdrop1Label1"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="window.location.reload();"></button>
                </div>
                <div class=" modal-body">

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="nom" placeholder="Votre pseudo" required>
                        <label for="nom">Pseudo</label>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Votre message" id="description" required></textarea>
                        <label for="description">Message</label>
                    </div>

                    <div class="form-floating mt-3">
                        <div>Votre note</div>
                        <i id="note-1" class="bi bi-star notation" onclick="Avis.notation(0)" style="cursor: pointer;"></i>
                        <i id="note-2" class="bi bi-star notation" onclick="Avis.notation(1)" style="cursor: pointer;"></i>
                        <i id="note-3" class="bi bi-star notation" onclick="Avis.notation(2)" style="cursor: pointer;"></i>
                        <i id="note-4" class="bi bi-star notation" onclick="Avis.notation(3)" style="cursor: pointer;"></i>
                        <i id="note-5" class="bi bi-star notation" onclick="Avis.notation(4)" style="cursor: pointer;"></i>
                    </div>



                    <div class=" mt-3" id="msg"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="window.location.reload();">Fermer</button>
                    <button type=" button" class="btn btn-primary" id="validation" data-action="" onclick="Avis.insert('/creationAvis')">Valider</button>
                </div>
            </div>
        </div>
    </div>

</div>




<!-- Inclusion footer -->
<?php include $_SERVER['DOCUMENT_ROOT'] . 'layout/footer.php'; ?>