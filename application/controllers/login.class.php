<?php

class LoginController extends AbstractController {

    protected $adminAccess = FALSE;

    function constructor() {
        if (!empty($_POST['user']) && !empty($_POST['user']['mail']) && !empty($_POST['user']['password'])) {
            $this->userLogin($_POST['user']['mail'], $_POST['user']['password']);
        }

        if (!empty($_SESSION['uid'])) {
            header('Location: ' . l('/'));
            exit;
        }

        $this->view->addJS('/application/theme/login.js');
        $this->view->addCSS('/application/theme/login.css');

        return $this->view->render('login-page', array());
    }

    public function userLogin($mail, $password) {
        global $user;

        $uid = $this->model->userLogin($mail, $password);

        if (!empty($uid)) {
            $_SESSION['uid'] = $uid->uid;

            $user = UserModel::userLoad($uid->uid);

            return TRUE;
        }

        return FALSE;
    }
}
