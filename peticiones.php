<?php
require_once 'metro.php';
// var_dump($_POST);

$controller = $_POST['controller'];
$action = $_POST['action'];

$controller::$action();