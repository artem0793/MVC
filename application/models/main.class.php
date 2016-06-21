<?php

class MainModel extends AbstractModel {
    public function getUserList() {
        $sth = db_link()->prepare('SELECT uid, firstname, lastname, mail FROM users ORDER BY uid DESC');
        $sth->execute();

        return $sth->fetchAll();
    }
}
