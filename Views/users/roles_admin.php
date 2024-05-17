<?php

include $_SERVER['DOCUMENT_ROOT'] . 'layoutUsers/header.php';
require_once '../Controllers/RolesController.php';
$rolesController = new RolesController();

$roles = $rolesController->index();

$roleNames = array_column($roles, 'nom');

echo $roleNames[0];
