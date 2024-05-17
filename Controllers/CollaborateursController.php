<?php

require_once '../Models/CollaborateursModel.php';

class CollaborateursController
{
    private $collaborateurModel;

    public function __construct()
    {
        $this->collaborateurModel = new CollaborateursModel();
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
}
