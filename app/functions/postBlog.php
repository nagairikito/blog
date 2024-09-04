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
        $blogData = [
            "title" => $title,
            "contents" => $contents,
        ];

        $hasCreated = BlogLogic::postBlog($blogData);

        if( $hasCreated == 0 ) {
            $_SESSION["postBlog_failed"] = "ブログの投稿に失敗しました。";
            header('Location: ../src/post_blog_form.php');
            exit;

        } elseif( $hasCreated == 1 ) {
            $_SESSION["postBlog_success"] = "ブログを投稿しました。";
            header('Location: ../src/myblog.php');
            exit;

        }

    } else {
        $_SESSION["postBlog_err"] = $err;
        header('Location: ../src/post_blog_form.php');
        exit;
    }