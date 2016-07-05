<?php

class MainController extends AbstractController {
    function constructor() {
        $items = $this->model->getUserList();
        $this->view->addJS('/application/theme/dashboard.js');
        $this->view->addCSS('/application/theme/dashboard.css');

        $sms_datetime_format = variable_get('sms_datetime_format');
        $sms_pattern = variable_get('sms_pattern');
        $is_configured = $sms_datetime_format && $sms_pattern;

        $this->view->addSettings('main', array(
            'is_configured' => $is_configured,
        ));

        if ($is_configured) {
            $this->view->addSettings('main', array(
                'sms_pattern' => str_replace('[date]', date($sms_datetime_format), $sms_pattern),
            ));
        }


        return $this->view->render('main-page', array(
            'items' => $items,
            'sms_from' => variable_get('sms_from', array()),
        ));
    }
}
