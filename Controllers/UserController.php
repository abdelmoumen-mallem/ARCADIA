<?php

require_once '../Models/UserModel.php';


class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Tentative de connexion via le modèle
            $loginSuccessful = $this->userModel->verifyLogin($username, $password);

            if ($loginSuccessful) {
                setcookie('user_arcadia', time(), time() + (86400), '/');
                session_start();
                $_SESSION['user_arcadia'] = time();

                header("Location: /test");
            } else {
                header("Location: /connexion/error");
            }
        }
    }

    public function isLogin()
    {
        session_start();

        if (isset($_COOKIE['user_arcadia']) && isset($_SESSION['user_arcadia'])) {
            // Vérifier si les valeurs du cookie et de la session correspondent
            if ($_COOKIE['user_arcadia'] == $_SESSION['user_arcadia']) {
                return true; // L'utilisateur est connecté
            }
        }
        return false; // L'utilisateur n'est pas connecté
    }
}
