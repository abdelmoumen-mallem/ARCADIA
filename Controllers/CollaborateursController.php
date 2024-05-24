<?php

require_once '../Models/CollaborateursModel.php';

require_once 'MailerController.php';

require_once '../Utils/utils.php';

class CollaborateursController
{
    private $collaborateurModel;
    private $collaborateurMail;

    public function __construct()
    {
        $this->collaborateurModel = new CollaborateursModel();
        $this->collaborateurMail = new MailerController();
    }

    public function index()
    {
        return $this->collaborateurModel->index();
    }

    public function show()
    {
        $id = $_POST['id'];
        $collaborateurInfo = $this->collaborateurModel->show($id);
        echo json_encode($collaborateurInfo);
    }

    public function update()
    {
        $token = $_POST['csrf'];
        $csrf = decodeTokenCsrf($token);
        if (!block($csrf)) {
            echo json_encode(false);
            exit;
        }

        $id = $_POST['id'];
        $username = $_POST['username'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $statut = isset($_POST['statut']) ? $_POST['statut'] : 0;
        $role_id = $_POST['role_id'];

        if ($statut == 0 && $id == 1) {
            echo json_encode(false);
            exit;
        }

        if (empty($nom) || empty($prenom) || empty($username) || empty($role_id)) {
            echo json_encode(2);
            exit;
        }

        if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(5);
            exit;
        }

        $usernameTest = $this->collaborateurModel->usernameTest($id, $username);

        if ($usernameTest > 0) {
            echo json_encode(3);
            exit;
        }

        $collaborateurInfo = $this->collaborateurModel->update($id, $username, $nom, $prenom, $statut, $role_id);

        echo json_encode($collaborateurInfo);
    }

    public function insert()
    {

        $token = $_POST['csrf'];
        $csrf = decodeTokenCsrf($token);
        if (!block($csrf)) {
            echo json_encode(false);
            exit;
        }
        $username = $_POST['username'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $statut = isset($_POST['statut']) ? $_POST['statut'] : 0;
        $role_id = $_POST['role_id'];

        if (empty($nom) || empty($prenom) || empty($username) || empty($role_id)) {
            echo json_encode(2);
            exit;
        }

        if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(5);
            exit;
        }

        $usernameTest = $this->collaborateurModel->usernameTest(null, $username);

        if ($usernameTest > 0) {
            echo json_encode(3);
            exit;
        }

        $collaborateurInfo = $this->collaborateurModel->insert($username, $nom, $prenom, $statut, $role_id);

        if ($collaborateurInfo) {

            $to = $username;
            $subject = 'Votre mot de passe utlisateur ARCADIA.';

            $template = '../Views/pages/lienPassword.php';
            $body = file_get_contents($template);

            $usernameId = $this->collaborateurModel->usernameId($username);

            $time = time();

            $body = str_replace('{{nom}}', $nom, $body);
            $body = str_replace('{{prenom}}', $prenom, $body);
            $body = str_replace('{{id}}', $time . '_' . encodeId($usernameId, $time), $body);
            $body = str_replace('{{action}}', 'Votre compte utilisateur a été créé sur ARCADIA.', $body);

            $mailer = $this->collaborateurMail->sendMail($to, $subject, $body);
        }

        if (!$mailer) {
            echo json_encode(4);
            exit;
        }

        echo json_encode($collaborateurInfo);
    }

    public function delete()
    {
        $id = $_POST['id'];
        $collaborateurInfo = $this->collaborateurModel->delete($id);
        echo json_encode($collaborateurInfo);
    }

    public function updatePassword()
    {
        $id = $_POST['id'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        $time = $_POST['time'];

        $url = $time . "_" . $id;

        if (empty($password1) || empty($password2)) {
            header("Location: /creationPassword/" . $url . "_error1");
            exit;
        } else if ($password1 !== $password2) {
            header("Location: /creationPassword/" . $url . "_error2");
            exit;
        } else if (strlen($password1) < 8) {
            header("Location: /creationPassword/" . $url . "_error3");
            exit;
        } else if (!preg_match("/[A-Z]/", $password1) || !preg_match("/[a-z]/", $password1) || !preg_match("/[0-9]/", $password1) || !preg_match("/[^a-zA-Z0-9]/", $password1)) {
            header("Location: /creationPassword/" . $url . "_error4");
            exit;
        }
        $collaborateurInfo = $this->collaborateurModel->updatePassword(decodeId($id, $time), $password1);

        if (!$collaborateurInfo) {
            header("Location: /creationPassword/" . $url . "_error5");
        } else {
            header("Location: /connexion");
        }
    }

    public function sendEmail()
    {

        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $username = $_POST['username'];

        $to = $username;
        $subject = 'Votre mot de passe utlisateur ARCADIA.';

        $template = '../Views/pages/lienPassword.php';
        $body = file_get_contents($template);

        $time = time();

        $body = str_replace('{{nom}}', $nom, $body);
        $body = str_replace('{{prenom}}', $prenom, $body);
        $body = str_replace('{{id}}', $time . '_' . encodeId($id, $time), $body);
        $body = str_replace('{{action}}', 'Une demande de modification de mot de passe a été demandé.', $body);

        $mailer = $this->collaborateurMail->sendMail($to, $subject, $body);
    }
}
