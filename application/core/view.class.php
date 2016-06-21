<?php

class View {
    public function render($template, array $vars) {
        return theme('html', array(
            'page' => theme($template, $vars),
        ));
    }
}
