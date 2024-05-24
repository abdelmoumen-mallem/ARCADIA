<?php

require_once '../Models/ContactModel.php';

class ContactController
{
    private $contactModel;

    public function __construct()
    {
        $this->contactModel = new ContactModel();
    }

    public function index()
    {
        return $this->contactModel->index();
    }

    public function insert()
    {
        $description = $_POST['description'];
        $titre = $_POST['titre'];
        $email = $_POST['email'];

        if (empty($description) || empty($titre) || empty($email)) {
            header('Location: /contacts/error1');
            exit();
        }

        $contact = $this->contactModel->insert($description, $titre, $email);
        if ($contact) {
            header('Location: /contacts/success');
            exit();
        } else {
            header('Location: /contacts/error2');
            exit();
        }
    }

    public function update()
    {

        $token = $_POST['csrf'];
        $csrf = decodeTokenCsrf($token);
        if (!block($csrf)) {
            echo json_encode(false);
            exit;
        }

        $statut = isset($_POST['visible']) ? $_POST['visible'] : 0;
        $id = $_POST['id'];

        $contact = $this->contactModel->update($id, $statut);
    }

    public function show()
    {
        $id = $_POST['id'];
        $contact = $this->contactModel->show($id);
        echo json_encode($contact);
    }

    public function delete()
    {
        $id = $_POST['id'];
        $contact = $this->contactModel->delete($id);
        echo json_encode($contact);
    }
}
