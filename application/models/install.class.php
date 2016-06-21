<?php

class InstallModel extends AbstractModel {
    public function createTables() {
        db_link()->exec('CREATE TABLE users (
          uid int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
          firstname varchar(255) NOT NULL,
          lastname varchar(255) NOT NULL,
          mail varchar(255) NOT NULL
        ) COLLATE "utf8_general_ci";');
    }
}
