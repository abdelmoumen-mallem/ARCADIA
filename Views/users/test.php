<?php

require_once '../Controllers/UserController.php';
$userController = new UserController();

$login = $userController->isLogin();

echo $login === true ? 'oui' : 'non';
