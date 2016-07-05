<?php

// PHP 5.5.9

require_once DAPP . '/core/common.php';
require_once DAPP . '/core/sms.api.php';
require_once DAPP . '/core/database.php';
require_once DAPP . '/core/controller.class.php';
require_once DAPP . '/core/model.class.php';
require_once DAPP . '/core/view.class.php';
require_once DAPP . '/core/router.class.php';

function __autoload($name) {
    $args = explode(' ', trim(preg_replace('/(?<![\^A-Z])([A-Z])/', ' $1', $name)));

    switch (array_pop($args)) {
        case 'Model':
            $args[0] = strtolower($args[0]);

            require_once DAPP . '/models/' . implode('', $args) . '.class.php';
            break;

        case 'Controller':
            $args[0] = strtolower($args[0]);

            require_once DAPP . '/controllers/' . implode('', $args) . '.class.php';
            break;
    }
}

Router::init();
