<?php

require_once '../Models/StatistiquesModel.php';

require_once '../Utils/utils.php';

class StatistiquesController
{
    private $statistiquesModel;

    public function __construct()
    {
        $this->statistiquesModel = new StatistiquesModel();
    }

    public function index()
    {
        return $this->statistiquesModel->index();
    }

    public function indexB()
    {
        return $this->statistiquesModel->indexB();
    }

    public function insert()
    {
        $id = $_POST['id'];

        $verifyRow = $this->statistiquesModel->verifyStats($id, 0);

        if ($verifyRow == 0) {
            $this->statistiquesModel->insert($id, 1);
        } else {
            $verifyStat = $this->statistiquesModel->verifyStats($id, 1);
            $verifyStat++;
            $date = date('Y-m-d');
            $this->statistiquesModel->update($id, $verifyStat, $date);
        }
    }
}
