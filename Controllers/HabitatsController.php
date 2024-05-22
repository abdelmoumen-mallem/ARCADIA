<?php

require_once '../Models/HabitatsModel.php';

require_once '../Utils/utils.php';

class HabitatsController
{
    private $habitatsModel;

    public function __construct()
    {
        $this->habitatsModel = new HabitatsModel();
    }

    public function index()
    {
        return $this->habitatsModel->index();
    }

    public function insert()
    {

        $description = $_POST['description'];
        $nom = $_POST['nom'];

        if (empty($description) || empty($nom)) {
            echo json_encode(1);
            exit;
        }

        if (!isset($_FILES["formFile"])) {
            echo json_encode(2);
            exit;
        }



        $nameTest = $this->habitatsModel->nameTest($nom, null);
        if ($nameTest > 0) {
            echo json_encode(3);
            exit;
        }

        if ($_FILES["formFile"]["error"] == UPLOAD_ERR_OK) {
            if ($_FILES["formFile"]["size"] > 10000000) {
                echo json_encode(4);
                exit;
            }

            $fileAutorise = array('jpg', 'jpeg', 'png');
            $fileType = strtolower(pathinfo($_FILES["formFile"]["name"], PATHINFO_EXTENSION));

            if (!in_array($fileType, $fileAutorise)) {
                echo json_encode(5);
                exit;
            }

            $fileDir = '../Public/img/';

            $fileName = strtolower(str_replace(' ', '_', $nom . "." . $fileType));

            $filePath = $fileDir . $fileName;

            if (move_uploaded_file($_FILES["formFile"]["tmp_name"], $filePath)) {

                $services = $this->habitatsModel->insert($nom, $description, $fileName);

                echo json_encode($services);
            } else {
                echo json_encode(6);
                exit;
            }
        } else {
            echo json_encode(7);
            exit;
        }
    }

    public function update()
    {
        $description = $_POST['description'];
        $nom = $_POST['nom'];
        $id = $_POST['id_service'];
        $image_url = $_POST['image_url'];

        $nameTest = $this->habitatsModel->nameTest($nom, $id);

        if (empty($description) || empty($nom)) {
            echo json_encode(1);
            exit;
        }

        if ($nameTest > 0) {
            echo json_encode(3);
            exit;
        }

        if (!isset($_FILES["formFile"])) {

            $services = $this->habitatsModel->update($id, $nom, $description, $image_url);

            echo json_encode($services);
        } else {

            if ($_FILES["formFile"]["error"] == UPLOAD_ERR_OK) {
                if ($_FILES["formFile"]["size"] > 10000000) {
                    echo json_encode(4);
                    exit;
                }

                $fileAutorise = array('jpg', 'jpeg', 'png');
                $fileType = strtolower(pathinfo($_FILES["formFile"]["name"], PATHINFO_EXTENSION));

                if (!in_array($fileType, $fileAutorise)) {
                    echo json_encode(5);
                    exit;
                }

                $fileDir = '../Public/img/';

                $fileName = strtolower(str_replace(' ', '_', $nom . "." . $fileType));

                $filePath = $fileDir . $fileName;

                if (move_uploaded_file($_FILES["formFile"]["tmp_name"], $filePath)) {

                    $services = $this->habitatsModel->update($id, $nom, $description, $fileName);

                    echo json_encode($services);
                } else {
                    echo json_encode(6);
                    exit;
                }
            } else {
                echo json_encode(7);
                exit;
            }
        }
    }

    public function show()
    {
        $id = $_POST['id'];
        $services = $this->habitatsModel->show($id);
        echo json_encode($services);
    }

    public function delete()
    {
        $id = $_POST['id'];
        $service = $this->habitatsModel->delete($id);
        echo json_encode($service);
    }
}
