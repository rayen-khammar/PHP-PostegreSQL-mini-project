<?php

class StudentsRepository extends Repository {
    const tableName = "students";

    public function __construct() {
        parent::__construct(tableName: self::tableName);
    }

    public function findAllWithSection() : array {
    $response = $this->db->query("SELECT s.id, s.img, s.name, s.date_de_naiss, 
                                  s.section as section_id, sec.des as section 
                                  FROM students s 
                                  LEFT JOIN section sec ON s.section = sec.id");
    return $response->fetchAll(PDO::FETCH_OBJ);
}

public function findBySection($sectionId) : array {
    $response = $this->db->prepare("SELECT s.id, s.img, s.name, s.date_de_naiss, 
                                    s.section as section_id, sec.des as section 
                                    FROM students s 
                                    LEFT JOIN section sec ON s.section = sec.id
                                    WHERE s.section = ?");
    $response->execute([$sectionId]);
    return $response->fetchAll(PDO::FETCH_OBJ);
}

    public function create($data) : void {
        $response = $this->db->prepare("INSERT INTO students (name, date_de_naiss, img, section) VALUES (?, ?, ?, ?)");
        $response->execute([$data['name'], $data['date'], $data['img'], $data['section']]);
    }

    public function update($id, $data) : void {
        $response = $this->db->prepare("UPDATE students SET name=?, date_de_naiss=?, section=? WHERE id=?");
        $response->execute([$data['name'], $data['date'], $data['section'], $id]);
    }
}