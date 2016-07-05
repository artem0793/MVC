<?php

class UserModel extends AbstractModel {

    public static function userLoad($uid) {
        $sth = db_link()->prepare('SELECT uid, rid, name, mail FROM users WHERE uid = :uid AND deleted IS NULL LIMIT 1;');
        $sth->execute(array(':uid' => $uid));
        $user = $sth->fetch();

        if ($user) {
            $sth = db_link()->prepare('SELECT aid FROM field_activity WHERE uid = :uid;');
            $sth->execute(array(':uid' => $uid));
            $user->activity = array();
            foreach ($sth as $row) {
                $user->activity[] = $row->aid;
            }
            unset($row);

            $sth = db_link()->prepare('SELECT general, value FROM field_phone WHERE uid = :uid;');
            $sth->execute(array(':uid' => $uid));
            $user->phone = (array) $sth->fetchAll(PDO::FETCH_ASSOC);
        }

        return $user;
    }

    public static function userDelete($uid) {
        db_link()
            ->prepare('UPDATE users SET deleted = 1 WHERE uid = :uid LIMIT 1;')
            ->execute(array(':uid' => $uid));
    }

    public static function passwordGenerate($password) {
        return '$A$' . md5('-*!' . strrev($password) . '!*-') . '8==';
    }

    public static function userSave(array $user) {
        $user_fields = array(
            'rid' => TRUE,
            'name' => TRUE,
            'password' => FALSE,
            'mail' => TRUE,
        );
        $values = array();

        foreach ($user_fields as $field_name => $field_required) {
            if (isset($user[$field_name])) {
                $values[":$field_name"] = $user[$field_name];
            }
        }

        if (isset($values[':password'])) {
            $values[':password'] = self::passwordGenerate($values[':password']);
        }

        if (isset($user['uid']) && $user['uid'] > 0) {
            // Update.
            if (count($values)) {
                $update_sql_field = array();

                foreach ($values as $field_name => $field_value) {
                    $update_sql_field[] = substr($field_name, 1) . ' = ' . $field_name;
                }

                db_link()
                    ->prepare('UPDATE users SET ' .
                              implode(', ', $update_sql_field) .
                              ' WHERE uid = :uid LIMIT 1;')
                    ->execute($values + array(':uid' => $user['uid']));
            }
        }
        else {

            // Insert.
            foreach ($values as $field_name => $field_value) {
                $insert_sql_fields[] = substr($field_name, 1);
            }

            db_link()
                ->prepare('INSERT INTO users (' .
                          implode(', ', $insert_sql_fields) .
                          ') VALUES (' .
                          implode(', ', array_keys($values)) .
                          ');')
                ->execute($values);
            $user['uid'] = db_link()->lastInsertId();
        }

        self::updateAttachedFields($user);

        if (isset($user['password'])) {
           unset($user['password']);
        }

        return (object) $user;
    }

    private static function updateAttachedFields($user) {
        // Updated phones.
        if (isset($user['phone'])) {
            db_link()
                ->prepare('DELETE FROM field_phone WHERE uid = :uid;')
                ->execute(array(':uid' => $user['uid']));

            if (!empty($user['phone']) && count($user['phone'])) {
                $values = array();
                $placeholders = array(':uid' => $user['uid']);

                foreach ($user['phone'] as $i => $item) {
                    if (!empty($item['value'])) {
                        $values[] = ":uid, :general_$i, :value_$i";
                        $placeholders[":general_$i"] = !$i ? 1 : NULL;
                        $placeholders[":value_$i"] = $item['value'];
                    }
                }

                if (count($values)) {
                    db_link()
                        ->prepare('INSERT INTO field_phone (uid, general, value) VALUES (' .
                                  implode('), (', $values) .
                                  ')')
                        ->execute($placeholders);
                }
            }
        }

        // Updated activities.
        if (isset($user['activity'])) {
            db_link()
                ->prepare('DELETE FROM field_activity WHERE uid = :uid;')
                ->execute(array(':uid' => $user['uid']));

            if (!empty($user['activity']) && count($user['activity'])) {
                $values = array();
                $placeholders = array(':uid' => $user['uid']);

                foreach ($user['activity'] as $i => $item) {
                    if ($item) {
                        $values[] = ":uid, :aid_$i";
                        $placeholders[":aid_$i"] = $item;
                    }
                }
                if (count($values)) {
                    db_link()
                        ->prepare('INSERT INTO field_activity (uid, aid) VALUES (' .
                                  implode('), (', $values) .
                                  ')')
                        ->execute($placeholders);
                }
            }
        }
    }

    public static function userAccess($name, stdClass $account = NULL) {
        global $user, $permissions;

        if (!$account) {
            $account = $user;
        }

        if (!empty($account->uid) && $account->uid == 1) {
            return TRUE;
        }

        return FALSE;
    }

    public function getUserList() {
        $users = array();

        $sth = db_link()
            ->prepare('SELECT u.uid, u.name, u.mail, r.name role FROM users u
                       LEFT JOIN roles r ON u.rid = r.rid
                       WHERE u.deleted IS NULL ORDER BY u.uid DESC;');
        $sth->execute();

        foreach ($sth as $user) {
            $users[] = $user;
        }

        return $users;
    }

    public function getRoleList() {
        $roles = array();

        $sth = db_link()
            ->prepare('SELECT rid, name FROM roles;');
        $sth->execute();

        foreach ($sth as $role) {
            $roles[] = $role;
        }

        return $roles;
    }
}
