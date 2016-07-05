<?php

class LoginModel extends AbstractModel {
    public function userLogin($mail, $password) {
        $sth = db_link()->prepare('SELECT uid FROM users WHERE mail = :mail AND password = :password LIMIT 1');
        $sth->execute(array(
            ':mail' => $mail,
            ':password' => UserModel::passwordGenerate($password),
        ));

        return $sth->fetch();
    }
}
