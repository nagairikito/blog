<?php
require_once '../setting/ini.php';
require_once './sessionStart.php';
require_once '../classes/BlogLogic.php';


// エラーメッセージ
$err = [];

// バリデーション
if( !$title = filter_input(INPUT_POST, 'title') ) {
    $err['title'] = "タイトルを入力してください。";
}

if( !$contents = $_POST["contents"] ) {
    $err["contents"] = "本文を入力してください。";
}

// ブログ投稿処理
if( count($err) == 0 ) {
    $blog_data = [
        "id" => $_POST['blog_id'],
        "title" => $title,
        "contents" => $contents,
    ];

    $check_edit = BlogLogic::editBlog($blog_data);

    if( $check_edit == 1 ) {
        $_SESSION['editBlog_success'] = 'ブログを編集しました。';
        header('Location: ../src/myblog.php');
        exit;
    
    } else {
        $_SESSION['editBlog_fail'] = 'エラーが発生しました。';
        header('Location: ../src/myblog.php');
        exit;
    
    }

} else {
    $_SESSION["editBlog_err"] = $err;
    header('Location: ../src/edit_blog_form.php');
    exit;
}






$blog_id = $_POST['blog_id'];

$check_delete = BlogLogic::editBlog($blog_id);

