<?php

require_once '../Models/ConsommationsModel.php';

class ConsommationsController
{
    private $consommationsModel;

    public function __construct()
    {
        $this->consommationsModel = new ConsommationsModel();
    }

    public function index($filtre)
    {
        return $this->consommationsModel->index($filtre);
    }

    public function show()
    {
        $id = $_POST['id'];
        $collaborateurInfo = $this->consommationsModel->show($id);
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

        $animal_id = $_POST['animal_id'];
        $nouriture = $_POST['nouriture'];
        $grammage = $_POST['grammage'];
        $utilisateur_id = $_POST['utilisateur_id'];

        // Si information manquante
        if (empty($animal_id) || empty($nouriture) || empty($grammage) || empty($utilisateur_id)) {
            echo json_encode(1);
            exit;
        }

        // Si information de mauvais type
        if (!is_numeric($animal_id) || !is_numeric($grammage) || !is_numeric($utilisateur_id)) {
            echo json_encode(2);
            exit;
        }

        // Envoi vers model
        $animaux = $this->consommationsModel->insert($animal_id, $nouriture, $grammage, $utilisateur_id);
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

        $id = $_POST['id'];
        $animal_id = $_POST['animal_id'];
        $nouriture = $_POST['nouriture'];
        $grammage = $_POST['grammage'];
        $utilisateur_id = $_POST['utilisateur_id'];

        // Si information manquante
        if (empty($animal_id) || empty($nouriture) || empty($grammage) || empty($utilisateur_id)) {
            echo json_encode(2);
            exit;
        }

        // Si information de mauvais type
        if (!is_numeric($animal_id) || !is_numeric($grammage) || !is_numeric($utilisateur_id)) {
            echo json_encode(1);
            exit;
        }

        $animal = $this->consommationsModel->update($id, $animal_id, $nouriture, $grammage, $utilisateur_id);

        echo json_encode($animal);
    }


    public function delete()
    {
        $id = $_POST['id'];
        $collaborateurInfo = $this->consommationsModel->delete($id);
        echo json_encode($collaborateurInfo);
    }

    public function top()
    {
        echo 'test';
    }
}
