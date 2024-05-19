<?php

require_once '../Models/AvisModel.php';

require_once '../Utils/utils.php';

class AvisController
{
    private $avisModel;

    public function __construct()
    {
        $this->avisModel = new AvisModel();
    }

    public function index()
    {
        return $this->avisModel->index();
    }
    public function insert()
    {
        // Récupérer les données postées depuis le formulaire
        $description = $_POST['description'];
        $nom = $_POST['nom'];
        $note = $_POST['note'];


        // Vérifier les données obligatoires
        if (empty($nom) || empty($description)) {
            echo json_encode(1);
            exit;
        } else if (empty($note)) {
            echo json_encode(2);
            exit;
        }

        // Effectuer la mise à jour
        $avis = $this->avisModel->insert($nom, $description, $note);

        echo json_encode($avis);
    }

    public function update()
    {
        // Récupérer les données postées depuis le formulaire
        $id = $_POST['id'];
        $visible = $_POST['visible'];


        // Effectuer la mise à jour
        $avisVisible = $this->avisModel->update($id, $visible);
    }
}
