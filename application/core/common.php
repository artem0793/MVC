<?php

function theme($template, array $vars = array()) {
    $template_file = DAPP . '/views/' . $template .'.tpl.php';

    if (!file_exists($template_file)) {
        return NULL;
    }

    if (!empty($vars)) {
        extract($vars);
    }

    ob_start();

    include $template_file;

    return ob_get_clean();
}
