<?php

class Repository implements IRepository {
    protected $db;

    public function __construct(protected $tableName) {
        $this->db = ConnexionBD::getInstance();
        
    }

    
    
    public function findAll() : array {
        
        $response = $this->db->query("SELECT * FROM {$this->tableName}  ");
        $elements = $response ->fetchAll(PDO::FETCH_OBJ);
        return $elements;
    }

    public function findById($id) : mixed {
        $response = $this->db->prepare("select * from {$this->tableName} where id=?");
        $response ->execute([$id]);
        return $response->fetch(PDO::FETCH_OBJ);
    }

    public function create($data) : void {
    }

    public function update($id, $data) : void {}

    public function delete($id) : void {
        $response = $this->db->prepare("delete from {$this->tableName} where id =?");
        $response ->execute([$id]);
    }
}