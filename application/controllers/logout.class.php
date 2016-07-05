<?php

class LogoutController extends AbstractController {
    protected $adminAccess = FALSE;
    function constructor() {
        unset($_SESSION['uid']);
        header('Location: ' . l('/login'));
        exit;
    }
}
