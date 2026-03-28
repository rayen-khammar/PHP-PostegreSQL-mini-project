php<?php

class SectionsRepository extends Repository {
    const tableName = "section";

    public function __construct() {
        parent::__construct(tableName: self::tableName);
    }

    public function create($data) : void {}
    public function update($id, $data) : void {}
}