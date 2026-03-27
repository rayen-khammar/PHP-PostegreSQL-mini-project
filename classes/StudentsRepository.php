<?php

abstract class UserRepository extends Repository {
    const tableName="users";

    public function __construct() {
        return parent::__construct(tableName: self ::tableName);

    }

}