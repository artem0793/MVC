<?php

class UserController extends AbstractController {
    function constructor() {
        $args = $this->args();

        switch (array_pop($args)) {
            case 'add':
                return $this->userAddPage();

            case 'edit':
                $uid = array_pop($args);

                if (!is_numeric($uid)) {
                    Router::setError(404);
                }

                $user = $this->model->getUserByID($uid);

                if (empty($user)) {
                    Router::setError(404);
                }

                return $this->userEditPage($user);

            case 'delete':

                $uid = array_pop($args);

                if (!is_numeric($uid)) {
                    Router::setError(404);
                }

                $user = $this->model->getUserByID($uid);

                if (empty($user)) {
                    Router::setError(404);
                }

                return $this->userDeletePage($user);

            default:
                Router::setError(404);
                break;
        }
    }

    private function userValidate(array $values = NULL) {
        $errors = array();

        foreach (array(
            'firstname' => 'Имя',
            'lastname' => 'Фамилия',
            'mail' => 'E-mail',
        ) as $field_name => $label) {
            if (empty($values[$field_name])) {
                $errors[$field_name] = 'Поле "' . $label . '" должно быть заполнено';
            }
        }

        if (empty($errors) && !filter_var($values['mail'], FILTER_VALIDATE_EMAIL)) {
            $errors['mail'] = 'Введен неверный E-mail';
        }

        return $errors;
    }

    private function userAddPage() {
        $values = get_request_data(array(
            'firstname' => TRUE,
            'lastname' => TRUE,
            'mail' => TRUE,
        ), 'post');
        $errors = array();

        if (!empty($values)) {
            $errors = $this->userValidate($values);

            if (empty($errors)) {
                $this->model->userSave($values);
                header('Location: /');
                exit;
            }
        }

        return $this->view->render('user-edit-page', array(
            'values' => $values,
            'is_edit' => FALSE,
            'errors' => $errors,
        ));
    }

    private function userEditPage(stdClass $user) {
        $values = get_request_data(array(
            'firstname' => TRUE,
            'lastname' => TRUE,
            'mail' => TRUE,
        ), 'post');

        $errors = array();

        if (!empty($values)) {
            $errors = $this->userValidate($values);

            if (empty($errors)) {
                $this->model->userSave($values + array('uid' => $user->uid));
                header('Location: /');
                exit;
            }
        }

        return $this->view->render('user-edit-page', array(
            'values' => array_merge((array) $values, (array) $user),
            'is_edit' => TRUE,
            'errors' => $errors,
            'user' => $user,
        ));
    }

    private function userDeletePage(stdClass $user) {
        $values = get_request_data(array('confirm' => FALSE));

        if (!empty($values['confirm'])) {
            $this->model->userDeleteByID($user->uid);
            header('Location: /');
            exit;
        }

        return $this->view->render('user-delete-page', array(
            'user' => $user,
        ));
    }
}
