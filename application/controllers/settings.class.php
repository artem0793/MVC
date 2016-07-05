<?php

class SettingsController extends AbstractController {

    function constructor() {
        $this->actionSMSFromCheck();

        $values = get_request_data(array(
            'date_timezone' => NULL,
            'sms_datetime_format' => NULL,
            'sms_pattern' => NULL,
            'sms_host' => NULL,
            'sms_username' => NULL,
            'sms_password' => NULL,
            'sms_lifetime' => NULL,
        ), 'post');

        if (!empty($values)) {
            foreach ($values as $field_name => $field_value) {
                if (!is_null($field_value)) {
                    variable_set($field_name, $field_value);
                }
            }

            header('Location: ' . l('/'));
            exit;
        }

        $this->view->addJS('/application/theme/settings.js');
        $this->view->addCSS('/application/theme/settings.css');
        $this->view->addSettings('sms_from', variable_get('sms_from', array()));

        return $this->view->render('settings-page', array(
            'date_timezone' => variable_get('date_timezone', 'Europe/Kiev'),
            'sms_datetime_format' => variable_get('sms_datetime_format', 'd.m.y'),
            'sms_pattern' => variable_get('sms_pattern', "[date]\n[list]"),
            'sms_host' => variable_get('sms_host', 'https://gate.smsclub.mobi/http/'),
            'sms_username' => variable_get('sms_username', ''),
            'sms_password' => variable_get('sms_password', ''),
            'sms_lifetime' => variable_get('sms_lifetime', 10),
        ));
    }

    private function actionSMSFromCheck() {
        $values = get_request_data(array(
            'action' => NULL,
            'value' => NULL,
        ));

        if (!empty($values['action']) && !empty($values['value'])) {
            switch ($values['action']) {
                case 'sms_from_remove':
                    $data = variable_get('sms_from', array());
                    $needle = array_search($values['value'], $data);

                    if ($needle !== FALSE) {
                        unset($data[$needle]);
                        variable_set('sms_from', $data);
                    }
                    exit;

                case 'sms_from_add':
                    $data = variable_get('sms_from', array());
                    array_push($data, $values['value']);
                    variable_set('sms_from', $data);

                    exit;
            }
        }
    }
}
