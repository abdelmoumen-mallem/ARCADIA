<?php

require_once 'DatabaseModel.php';

class ContactModel extends DatabaseModel
{
    protected string $table = 'contact';

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return $this->indexGeneral($this->table);
    }

    public function insert($description, $titre, $email)
    {
        return $this->insertGeneral($this->table, compact('description', 'titre', 'email'));
    }

    public function update($id, $statut)
    {
        return $this->updateGeneral($this->table, $id, compact('statut'));
    }

    public function show($id)
    {
        return $this->showGeneral($this->table, $id);
    }

    public function delete($id)
    {
        return $this->deleteGeneral($this->table, $id);
    }
}
