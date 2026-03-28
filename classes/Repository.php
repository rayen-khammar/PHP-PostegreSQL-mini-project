<?php
require_once 'IRepository.php';

abstract class Repository implements IRepository {
    protected $db;

    public function __construct(protected $tableName) {
        $this->db = ConnexionBD::getInstance();
    }

    public function findAll() : array {
        $response = $this->db->query("SELECT * FROM {$this->tableName}");
        return $response->fetchAll(PDO::FETCH_OBJ);
    }

    public function findById($id) : mixed {
        $response = $this->db->prepare("SELECT * FROM {$this->tableName} WHERE id = ?");
        $response->execute([$id]);
        return $response->fetch(PDO::FETCH_OBJ);
    }

    public function delete($id) : void {
        $response = $this->db->prepare("DELETE FROM {$this->tableName} WHERE id = ?");
        $response->execute([$id]);
    }

    abstract public function create($data) : void;
    abstract public function update($id, $data) : void;
}