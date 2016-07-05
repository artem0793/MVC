<?php

class ActivityModel extends AbstractModel {

    public static function getActivityList() {
        $result = array();
        $sth = db_link()->prepare('SELECT aid, name FROM activities WHERE deleted IS NULL ORDER BY aid DESC;');
        $sth->execute();

        foreach ($sth as $activity) {
            $result[] = $activity;
        }

        return $result;
    }

    public static function activityLoad($aid) {
        $sth = db_link()->prepare('SELECT aid, name, short FROM activities WHERE aid = :aid AND deleted IS NULL LIMIT 1;');
        $sth->execute(array(':aid' => $aid));

        return $sth->fetch();
    }

    public static function activityDelete($aid) {
        db_link()
            ->prepare('UPDATE activities SET deleted = 1 WHERE aid = :aid LIMIT 1;')
            ->execute(array(':aid' => $aid));
    }

    public static function activitySave($activity) {
        if (empty($activity['aid'])) {
            $sth = db_link()
                ->prepare('INSERT INTO activities (name, short)
                                VALUES (:name, :short);');

            foreach ($activity as $field_name => $value) {
                $sth->bindValue(":$field_name", $value);
            }

            $sth->execute();
            $activity['aid'] = db_link()->lastInsertId();

            return (object) $activity;
        }
        else {
            $sth = db_link()
                ->prepare('UPDATE activities SET
                                name = :name,
                                short = :short
                            WHERE aid = :aid AND deleted IS NULL LIMIT 1;');

            foreach ($activity as $field_name => $value) {
                $sth->bindValue(":$field_name", $value);
            }

            $sth->execute();

            return (object) $activity;
        }
    }

    public static function getActivityOptionList() {
        $result = array();
        $sth = db_link()->prepare('SELECT aid, name FROM activities WHERE deleted IS NULL ORDER BY aid DESC;');
        $sth->execute();

        foreach ($sth as $activity) {
            $result[$activity->aid] = $activity->name;
        }

        return $result;
    }
}
