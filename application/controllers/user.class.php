<?php

class UserController extends AbstractController {
    function constructor() {
        $args = $this->args();

        $this->view->addJS('/application/theme/user.js');
        $this->view->addCSS('/application/theme/user.css');

        switch (array_pop($args)) {
            case '':
            case 'list':
                return $this->userListPage();

            case 'add':
                return $this->userAddPage();

            case 'edit':
                $uid = array_pop($args);

                if (!is_numeric($uid)) {
                    Router::setError(404);
                }

                $user = $this->model->userLoad($uid);

                if (empty($user)) {
                    Router::setError(404);
                }

                return $this->userEditPage($user);

            case 'delete':

                $uid = array_pop($args);

                if (!is_numeric($uid)) {
                    Router::setError(404);
                }

                $user = $this->model->userLoad($uid);

                if (empty($user)) {
                    Router::setError(404);
                }

                return $this->userDeletePage($user);

            default:
                Router::setError(404);
        }
    }

    private function userAddPage() {
        $values = get_request_data(array(
            'name' => NULL,
            'mail' => NULL,
            'rid' => NULL,
            'password' => NULL,
            'phone' => array(),
            'activity' => array(),
        ), 'post');

        if (!empty($values)) {
            $this->model->userSave($values);

            header('Location: ' . l('/user/list'));
            exit;
        }

        return $this->view->render('user-edit-page', array(
            'roles' => $this->model->getRoleList(),
            'activity_list' => ActivityModel::getActivityOptionList(),
            'values' => $values,
            'is_edit' => FALSE,
        ));
    }

    private function userEditPage(stdClass $user) {
        $values = get_request_data(array(
            'name' => NULL,
            'mail' => NULL,
            'rid' => NULL,
            'password' => NULL,
            'phone' => array(),
            'activity' => array(),
        ), 'post');

        if (empty($values['password'])) {
            unset($values['password']);
        }

        if (!empty($values)) {
            $this->model->userSave($values + array('uid' => $user->uid));

            header('Location: ' . l('/user/list'));

            exit;
        }

        return $this->view->render('user-edit-page', array(
            'roles' => $this->model->getRoleList(),
            'activity_list' => ActivityModel::getActivityOptionList(),
            'values' => array_merge((array) $values, (array) $user),
            'is_edit' => TRUE,
            'user' => $user,
        ));
    }

    private function userDeletePage(stdClass $user) {
        if ($user->uid == 1) {
            Router::setError(403);
        }

        $values = get_request_data(array('confirm' => TRUE));

        if (!empty($values['confirm']) && $values['confirm'] == 'confirmed') {
            $this->model->userDelete($user->uid);
            header('Location: ' . l('/user/list'));
            exit;
        }

        return $this->view->render('user-delete-page', array(
            'user' => $user,
        ));
    }


    private function userListPage() {
        return $this->view->render('user-list-page', array(
            'user_list' => $this->model->getUserList(),
        ));
    }
}
