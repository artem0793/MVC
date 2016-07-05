<?php

class InstallModel extends AbstractModel {
    public function createTables() {
        db_link()->exec('DROP TABLE IF EXISTS users;');
        db_link()->exec('CREATE TABLE users (
          uid int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
          rid int(11) NULL,
          name varchar(255) NOT NULL,
          password varchar(255) NULL,
          mail varchar(255) NOT NULL,
          deleted tinyint(1) NULL
        ) DEFAULT CHARSET=utf8;');

        db_link()->exec('DROP TABLE IF EXISTS roles;');
        db_link()->exec('CREATE TABLE roles (
          rid int NOT NULL AUTO_INCREMENT PRIMARY KEY,
          name varchar(255) NOT NULL
        ) DEFAULT CHARSET=utf8;');
        db_link()->exec('INSERT INTO roles (rid, name) VALUES (1, \'Администратор\');');
        db_link()->exec('INSERT INTO roles (rid, name) VALUES (2, \'Импортер\');');

        db_link()->exec('DROP TABLE IF EXISTS variables;');
        db_link()->exec('CREATE TABLE variables (
          name varchar(255) NOT NULL,
          value text NOT NULL,
          UNIQUE KEY name (name)
        ) DEFAULT CHARSET=utf8;');

        db_link()->exec('DROP TABLE IF EXISTS activities;');
        db_link()->exec('CREATE TABLE activities (
          aid int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
          name varchar(255) NOT NULL,
          short varchar(255) NOT NULL,
          deleted tinyint(1) NULL
        ) DEFAULT CHARSET=utf8;');

        db_link()->exec('DROP TABLE IF EXISTS field_phone;');
        db_link()->exec('CREATE TABLE field_phone (
          uid int NOT NULL,
          general tinyint NULL,
          value varchar(255) NOT NULL
        ) DEFAULT CHARSET=utf8;');

        db_link()->exec('DROP TABLE IF EXISTS field_activity;');
        db_link()->exec('CREATE TABLE field_activity (
          uid int NOT NULL,
          aid int NOT NULL
        );');

//        db_link()->exec('DROP TABLE IF EXISTS permissions;');
//        db_link()->exec('CREATE TABLE permissions (
//          name varchar(255) NOT NULL,
//          rid int(11) NOT NULL,
//          UNIQUE KEY name_rid (name, rid)
//        ) DEFAULT CHARSET=utf8;');
    }
}
