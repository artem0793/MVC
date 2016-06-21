<?php

class InstallController extends AbstractController {
    function constructor() {
        $errors = array();
        $config = array();
        $values = get_request_data(array(
            'host' => TRUE,
            'username' => TRUE,
            'password' => TRUE,
            'dbname' => TRUE,
        ), 'post');

        if (!empty($values)) {
            if (is_writable(FILE_CONFIG_PATH)) {
                file_put_contents(FILE_CONFIG_PATH, '<?php $config = ' . var_export($values, TRUE) . ';' . PHP_EOL, LOCK_EX);
                include FILE_CONFIG_PATH ;

                $result = db_connect($config);

                if (!$result) {
                    $this->model->createTables();
                    header('Location: /');
                    exit;
                }
                $errors[] = $result;
            }
            else {
                $errors[] = 'Создайте файл "' . FILE_CONFIG_PATH . '" и установите права на запись и чтение.';
            }
        }

        return $this->view->render('install-page', array(
            'errors' => $errors,
        ));
    }
}
