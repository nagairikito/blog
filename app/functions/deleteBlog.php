<?php
require_once '../setting/ini.php';
require_once './sessionStart.php';
require_once '../classes/BlogLogic.php';

$blog_id = $_POST['blog_id'];

$check_delete = BlogLogic::deleteBlog($blog_id);

if( $check_delete == 1 ) {
    $_SESSION['deleteBlog_success'] = 'ブログを削除しました。';
    header('Location: ../src/myblog.php');
    exit;

} else {
    $_SESSION['deleteBlog_fail'] = 'エラーが発生しました。';
    header('Location: ../src/myblog.php');
    exit;

}