<?php
require_once '../setting/ini.php';
require_once './sessionStart.php';
require_once '../classes/BlogLogic.php';

if( isset($_SESSION['keyword']) ) {
    unset($_SESSION['keyword']);
}
if( isset($_SESSION['stay_keyword']) ) {
    unset($_SESSION['stay_keyword']);
}

$keyword = $_GET['keyword'];
$_SESSION['keyword'] = $keyword;

$result_check = BlogLogic::search($keyword);

if( $result_check == 0 ) {
    header('Location: ../src/home.php');
    exit;
} elseif( $result_check == 2 ) {
    $_SESSION['search_err'] = "該当する商品が見つかりませんでした。";
} else {
    $_SESSION['search_err'] = "エラーが発生しました。";
}

header('Location: ../src/search_result.php');
exit;
