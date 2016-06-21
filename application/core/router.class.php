<?php

final class Router
{
    const DEFAULT_CONTROLLER_NAME = 'main';

    private static $_instance;

    private function __construct() {

        $request_uri = trim(urldecode($_SERVER['REQUEST_URI']), '/');

        if (!$request_uri) {
            $request_uri = self::DEFAULT_CONTROLLER_NAME;
        }

        $args = explode('/', $request_uri);
        $controller_name = strtolower(array_shift($args));
        $path_to_controller = DAPP . '/controllers/' . $controller_name . '.class.php';

        if (!file_exists($path_to_controller)) {
            self::setError(404);
        }

        include_once $path_to_controller;

        $controller_class_name = ucwords($controller_name) . 'Controller';

        if (!class_exists($controller_class_name)) {
            self::setError(404);
        }

        new $controller_class_name($controller_name, $args);
    }

    private function __clone() {

    }

    public static function setStatus($status) {
        switch ($status) {
            case 200:
                header('HTTP/1.1 200 Ok');
                break;

            case 403:
                header('HTTP/1.1 404 Forbidden');
                break;

            case 404:
                header('HTTP/1.1 404 Not Found');
                break;
        }
    }

    public static function setError($status) {
        switch ($status) {
            case 403:
                header('Content-type: text/html; charset=utf8');
                self::setStatus($status);
                print '<h3>You are forbidden!</h3>';
                exit;
                break;

            case 404:
                header('Content-type: text/html; charset=utf8');
                self::setStatus($status);
                print '<h3>Page not found</h3>';
                exit;
                break;
        }
    }

    public static function init() {
        if (empty(self::$_instance)) {
            self::$_instance = new self;
        }
    }
}
