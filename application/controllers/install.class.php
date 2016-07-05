<?php

class InstallController extends AbstractController {

    protected $adminAccess = FALSE;

    function constructor() {
        $config = array('db' => array());
        $user = array();

        if (!empty($_POST['db']) && $_POST['user']) {
            foreach (array(
                'host' => 'localhost',
                'port' => '3306',
                'username' => NULL,
                'password' => NULL,
                'name' => NULL,
            ) as $field_name => $default_value) {
                $config['db'][$field_name] = !empty($_POST['db'][$field_name]) ? $_POST['db'][$field_name] : $default_value;
            }

            foreach (array(
                'name' => NULL,
                'password' => NULL,
                'mail' => NULL,
                'rid' => NULL,
            ) as $field_name => $default_value) {
                $user[$field_name] = !empty($_POST['user'][$field_name]) ? $_POST['user'][$field_name] : $default_value;
            }

            if (is_writable(FILE_CONFIG_PATH)) {
                file_put_contents(FILE_CONFIG_PATH, '<?php $config = ' . var_export($config, TRUE) . ';' . PHP_EOL, LOCK_EX);

                include FILE_CONFIG_PATH;

                $result = db_connect($config);

                if (!$result) {
                    $this->model->createTables();
                    UserModel::userSave($user);

                    header('Location: ' . l('/login'));

                    exit;
                }
            }
        }

        $this->view->addJS('/application/theme/install.js');
        $this->view->addCSS('/application/theme/install.css');

        return $this->view->render('install-page', array());
    }
}
