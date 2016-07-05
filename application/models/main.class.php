<?php

class MainModel extends AbstractModel {
    public function getUserList() {
        $result = array();
        $group = array();
        $sth = db_link()->prepare('SELECT u.uid, a.aid, u.name user_name, a.name activity_name, a.short activity_short_name, (SELECT GROUP_CONCAT(fp.value) FROM field_phone fp WHERE fp.uid = u.uid ORDER BY fp.general DESC) phones FROM users u RIGHT JOIN field_activity fa ON fa.uid = u.uid LEFT JOIN activities a ON fa.aid = a.aid WHERE u.deleted IS NULL ORDER BY uid, aid DESC');
        $sth->execute();

        foreach ($sth as $item) {
            if ($item->phones) {
                $result[] = $item;
            }
        }

        for ($i = 0, $c = count($result), $d = 1; $i < $c; $i++) {
            if ($i && $result[$i]->uid == $result[$i - $d]->uid) {
                $result[$i - $d]->rowspan = isset($result[$i - $d]->rowspan) ? $result[$i - $d]->rowspan + 1 : 2;
                $result[$i]->rowspan = NULL;
                $d++;
            }
            else {
                $d = 1;
                $result[$i]->rowspan = 1;
            }
        }
        return $result;
    }
}
