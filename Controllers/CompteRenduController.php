<?php

require_once '../Models/CompteRenduModel.php';

class CompteRenduController
{
    private $compteRenduModel;

    public function __construct()
    {
        $this->compteRenduModel = new CompteRenduModel();
    }

    public function index($filtre)
    {
        return $this->compteRenduModel->index($filtre);
    }

    public function show()
    {
        $id = $_POST['id'];
        $collaborateurInfo = $this->compteRenduModel->show($id);
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
        $etat = $_POST['etat'];
        $nouriture = $_POST['nouriture'];
        $grammage = $_POST['grammage'];
        $description = $_POST['description'];
        $utilisateur_id = $_POST['utilisateur_id'];

        // Si information manquante
        if (empty($animal_id) || empty($etat) || empty($nouriture) || empty($grammage) || empty($utilisateur_id)) {
            echo json_encode(1);
            exit;
        }

        // Si information de mauvais type
        if (!is_numeric($animal_id) || !is_numeric($etat) || !is_numeric($grammage) || !is_numeric($utilisateur_id)) {
            echo json_encode(2);
            exit;
        }

        // Envoi vers model
        $animaux = $this->compteRenduModel->insert($animal_id, $etat, $nouriture, $grammage, $utilisateur_id, $description);
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
        $etat = $_POST['etat'];
        $nouriture = $_POST['nouriture'];
        $grammage = $_POST['grammage'];
        $description = $_POST['description'];
        $utilisateur_id = $_POST['utilisateur_id'];

        // Si information manquante
        if (empty($animal_id) || empty($etat) || empty($nouriture) || empty($grammage) || empty($utilisateur_id)) {
            echo json_encode(2);
            exit;
        }

        // Si information de mauvais type
        if (!is_numeric($animal_id) || !is_numeric($etat) || !is_numeric($grammage) || !is_numeric($utilisateur_id)) {
            echo json_encode(1);
            exit;
        }

        $animal = $this->compteRenduModel->update($id, $animal_id, $etat, $nouriture, $grammage, $utilisateur_id, $description);

        echo json_encode($animal);
    }


    public function delete()
    {
        $id = $_POST['id'];
        $collaborateurInfo = $this->compteRenduModel->delete($id);
        echo json_encode($collaborateurInfo);
    }
}
