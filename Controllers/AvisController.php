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

    public function index($filtre)
    {
        return $this->avisModel->index(secureQuery($filtre));
    }
    public function insert()
    {
        $description = $_POST['description'];
        $nom = $_POST['nom'];
        $note = $_POST['note'];


        if (empty($nom) || empty($description)) {
            echo json_encode(1);
            exit;
        } else if (empty($note)) {
            echo json_encode(2);
            exit;
        }

        $avis = $this->avisModel->insert($nom, $description, $note);

        echo json_encode($avis);
    }

    public function update()
    {
        $id = $_POST['id'];
        $visible = $_POST['visible'];

        $avisVisible = $this->avisModel->update($id, $visible);
    }
}
