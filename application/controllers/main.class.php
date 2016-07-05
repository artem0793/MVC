<?php

class MainController extends AbstractController {
    function constructor() {
        if ($this->args(0)) {
            switch ($this->args(0)) {
                case 'sms':
                    switch ($this->args(1)) {
                        case 'send':
                            $sms_list = get_request_data(array('sms_list' => TRUE), 'post');

                            if (!empty($sms_list)) {
                                $this->actionSendSMS($sms_list['sms_list']);
                            }
                            else {
                                Router::setError(404);
                            }
                            break;

                        case 'view':
                            return $this->view->render('sms-status-view-page', array(
                                'items' => $this->model->getSMSStatusViewList(),
                            ));
                            break;

                        default:
                            Router::setError(404);
                    }
                    break;
            }
        }

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

    private function actionSendSMS(array $list = array()) {
        $this->model->addSMSToQueue($list);
        //@todo Отправить СМСки.
        exit;
    }
}
