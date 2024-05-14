<?php

include $_SERVER['DOCUMENT_ROOT'] . 'layout/header.php';

require_once '../Controllers/ArcadiaController.php';
$arcadiaController = new ArcadiaController();

$arcadiaController->createInDatabase();


include $_SERVER['DOCUMENT_ROOT'] . 'layout/footer.php';
