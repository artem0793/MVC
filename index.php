<?php
// PHP 5.5.9

// Этот проект был выполнен менее чем за 7 часов с нуля.

// Несколько дней назад я делал тестовое задание построить простой MVC сайтик.
// Потратил 3 часа (подсматривал сюда https://habrahabr.ru/post/150267/) и
// сделал первый коммит d6a2fbe1b9b9687de4167ba74e56d77ac87423dd
// Для задания от вашей компании я потратил еще 4 часа допилив этот MVC шаблон
// Последний коммит c36dd6743788d4217b4ef3f6196d8af9c2199a33


define('DROOT', dirname(__FILE__));
define('DAPP', DROOT . '/application');

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once DAPP . '/bootstrap.php';
