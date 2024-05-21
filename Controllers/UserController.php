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

            $loginSuccessful = $this->userModel->verifyLogin($username, $password);

            if ($loginSuccessful) {
                setcookie('user_arcadia', time(), time() + (86400), '/');

                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['user_arcadia'] = time();

                header("Location: /accueil_admin");
            } else {
                header("Location: /connexion/error");
            }
        }
    }

    public function logout()
    {
        unset($_SESSION['user_arcadia']);

        setcookie('user_arcadia', '', time() - 3600, '/');

        unset($_SESSION['id_user_arcadia']);

        header("Location: /connexion");
        exit();
    }
}
