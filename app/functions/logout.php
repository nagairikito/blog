<?php
require_once '../setting/ini.php';
require_once 'sessionStart.php';

$logout = filter_input(INPUT_POST, 'logout');
if( isset($logout) ) {
    session_destroy();
    session_start();
    $_SESSION["logout"] = "ログアウトしました。";
    header('Location: ../src/home.php');
    exit;

}
