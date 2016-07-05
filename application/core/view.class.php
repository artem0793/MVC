<?php

class View {
    private $css = array();
    private $js = array(
        'head' => array(),
        'settings' => array(),
        'top' => array(),
        'bottom' => array(),
    );

    public function render($template, array $vars) {
        $this->addSettings('global', array(
            'path_suffix' => trim(Router::$path_suffix, '/'),
        ));
        return theme('html', array(
            'page' => theme('pages/' . $template, $vars),
            'css' => $this->css,
            'js' => $this->js,
            'is_installed' => $GLOBALS['is_installed'],
        ));
    }

    public function addCSS($path) {
        $this->css[$path] = $path;
    }

    public function addJS($path, $position = 'head') {
        if (isset($this->js[$position])) {
            $this->js[$position][$path] = $path;
        }
    }

    public function addSettings($name, array $settings) {
        if (isset($this->js['settings'][$name])) {
            $this->js['settings'][$name] = array_merge($settings, $this->js['settings'][$name]);
        }
        else {
            $this->js['settings'][$name] = $settings;
        }
    }
}
