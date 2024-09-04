<?php
require_once '../setting/ini.php';
require_once './sessionStart.php';
require_once '../classes/UserLogic.php';

    // エラーメッセージ
    $err = [];

    // バリデーション
    $email = filter_input(INPUT_POST, 'email');
    if( !$email ) {
        $err["email"] = "メールアドレスを入力してください。";
    }

    $password = filter_input(INPUT_POST, 'password');
    if( !$password ) {
        $err["password"] = "パスワードを入力してください。";
    }

    // ログイン処理
    if( count($err) == 0 ) {
        $result = UserLogic::login($email, $password);

        if( $result == true ) {
            $_SESSION["login_success"] = "ログインしました。";
            header('Location: ../src/home.php');
            exit;
        } else {
            $_SESSION["login_failed"] = "メールアドレスかパスワードに誤りがあります。" ;
            header('Location: ../src/login_form.php');
            exit;
        }
        
    } else {
        $_SESSION["login_err"] = $err;
        header('Location: ../src/login_form.php');
        exit;
    }
