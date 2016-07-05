<?php

abstract class AbstractController {

    protected $adminAccess = TRUE;

    protected $model;

    protected $view;

    private $arguments;

    final public function __construct($controller_name, array $args) {
        global $user;

        $GLOBALS['is_installed'] = file_exists(FILE_CONFIG_PATH) && filesize(FILE_CONFIG_PATH) > 0;

        if (!$GLOBALS['is_installed'] && $controller_name != 'install') {
            header('Location: ' . l('/install'));
            exit;
        }

        if ($GLOBALS['is_installed'] && $controller_name == 'install') {
            header('Location: ' .  l('/'));
            exit;
        }
        session_start();
        $this->arguments = $args;

        $config = array();

        if ($GLOBALS['is_installed']) {
            include FILE_CONFIG_PATH;
        }

        $this->view = new View();
        $this->view->addCSS('/application/theme/semantic-ui/semantic.min.css');
        $this->view->addCSS('/application/theme/main.css');
        $this->view->addJS('/application/theme/jQuery/jquery-3.0.0.min.js');
        $this->view->addJS('/application/theme/semantic-ui/semantic.min.js');
        $this->view->addJS('/application/theme/main.js');

        $model_path = DAPP . '/models/' . $controller_name . '.class.php';

        if (file_exists($model_path)) {
            $controller_class_name = ucwords($controller_name . 'Model');

            require_once $model_path;

            if (class_exists($controller_class_name)) {

                $this->model = new $controller_class_name($config);
            }
        }

        if ($GLOBALS['is_installed'] && !empty($_SESSION['uid'])) {
            new UserModel($config);
            $user = UserModel::userLoad($_SESSION['uid']);

            if (empty($user)) {
                unset($_SESSION['uid']);
            }
        }

        if ($this->adminAccess && !UserModel::userAccess($controller_name)) {
            Router::setError(403);
        }

        header('Content-Type: text/html; charset=utf8');

        print call_user_func_array(array($this, 'constructor'), $this->args());

        exit;
    }

    public function args($index = NULL) {
        if (is_null($index)) {
            return $this->arguments;
        }
        else {
            return isset($this->arguments[$index]) ? $this->arguments[$index] : NULL;
        }
    }

    abstract public function constructor();
}
