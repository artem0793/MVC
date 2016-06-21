<?php

abstract class AbstractController {

    protected $model;

    protected $view;

    private $arguments;

    final public function __construct($controller_name, array $args) {
        $this->arguments = $args;
        $this->view = new View();

        $model_path = DAPP . '/models/' . $controller_name . '.class.php';

        if (file_exists($model_path)) {
            $controller_class_name = ucwords($controller_name . 'Model');

            require_once $model_path;

            if (class_exists($controller_class_name)) {
                $this->model = new $controller_class_name;
            }
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
