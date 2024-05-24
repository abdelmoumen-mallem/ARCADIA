<?php

require_once '../Models/AnimalModel.php';

class AnimalController
{
    private $animalModel;
    private $statistiquesModel;

    public function __construct()
    {
        $this->animalModel = new AnimalModel();
    }

    public function index()
    {
        return $this->animalModel->index();
    }

    public function indexB($id)
    {
        return $this->animalModel->indexB($id);
    }

    public function indexC()
    {
        $id = $_POST['id'];
        return $this->animalModel->indexC($id);
    }

    public function indexD($filtre)
    {
        return $this->animalModel->indexD($filtre);
    }

    public function show()
    {
        $id = $_POST['id'];
        $animal = $this->animalModel->show($id);
        echo json_encode($animal);
    }

    public function insert()
    {
        $token = $_POST['csrf'];
        $csrf = decodeTokenCsrf($token);
        if (!block($csrf)) {
            echo json_encode(false);
            exit;
        }

        $prenom = $_POST['prenom'];
        $statut = isset($_POST['statut']) ? $_POST['statut'] : 0;
        $habitat_id = $_POST['habitat'];
        $race_id = $_POST['race'];

        if (empty($prenom) || empty($habitat_id) || empty($race_id)) {
            echo json_encode(2);
            exit;
        }

        $nameTest = $this->animalModel->usernameTest(null, $prenom);

        if ($nameTest > 0) {
            echo json_encode(3);
            exit;
        }

        $animaux = $this->animalModel->insert($prenom, $statut, $habitat_id, $race_id);

        echo json_encode($animaux);
    }

    public function update()
    {

        $token = $_POST['csrf'];
        $csrf = decodeTokenCsrf($token);
        if (!block($csrf)) {
            echo json_encode(false);
            exit;
        }

        $prenom = $_POST['prenom'];
        $statut = isset($_POST['statut']) ? $_POST['statut'] : 0;
        $habitat_id = $_POST['habitat'];
        $race_id = $_POST['race'];
        $id = $_POST['id'];

        if (empty($prenom) || empty($habitat_id) || empty($race_id)) {
            echo json_encode(2);
            exit;
        }

        $nameTest = $this->animalModel->usernameTest($id, $prenom);

        if ($nameTest > 0) {
            echo json_encode(3);
            exit;
        }

        $animal = $this->animalModel->update($id, $prenom, $race_id, $habitat_id, $statut);

        echo json_encode($animal);
    }


    public function delete()
    {
        $id = $_POST['id'];
        $collaborateurInfo = $this->animalModel->delete($id);
        echo json_encode($collaborateurInfo);
    }
}
