<?php

class UserModel extends AbstractModel {

    public function getUserByID($uid) {
        $sth = db_link()->prepare('SELECT uid, firstname, lastname, mail FROM users WHERE uid = :uid LIMIT 1;');
        $sth->execute(array(':uid' => $uid));

        return $sth->fetch();
    }

    public function userDeleteByID($uid) {
        $sth = db_link()->prepare('DELETE FROM users WHERE uid = :uid LIMIT 1;');
        $sth->execute(array(':uid' => $uid));
    }

    public function userSave($user) {
        if (empty($user['uid'])) {
            $sth = db_link()
                ->prepare('INSERT INTO users (firstname, lastname, mail) VALUES (:firstname, :lastname, :mail);');

            foreach ($user as $field_name => $value) {
                $sth->bindValue(":$field_name", $value, PDO::PARAM_STR);
            }

            $sth->execute();
            $user['uid'] = db_link()->lastInsertId();

            return (object) $user;
        }
        else {
            $sth = db_link()
                ->prepare('UPDATE users SET firstname = :firstname, lastname = :lastname, mail = :mail WHERE uid = :uid LIMIT 1;');

            foreach ($user as $field_name => $value) {
                if ($field_name == 'uid') {
                    $sth->bindValue(":$field_name", $value, PDO::PARAM_INT);
                }
                else {
                    $sth->bindValue(":$field_name", $value, PDO::PARAM_STR);
                }
            }

            $sth->execute();

            return (object) $user;
        }
    }
}
