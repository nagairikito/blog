<?php
require_once '../setting/ini.php';
require_once './sessionStart.php';
require_once '../classes/UserLogic.php';

    // エラーメッセージ
    $err = [];

    // バリデーション
    if( !$username = filter_input(INPUT_POST, 'username') ) {
        $err["username"] = "ユーザー名は必須です。";
    }

    if( !$email = filter_input(INPUT_POST, 'email') ) {
        $err["email"] = "メールアドレスは必須です。";
    }

    $password = filter_input(INPUT_POST, 'password');
    $confirmation_password = filter_input(INPUT_POST, 'confirmation_password');

    if( !preg_match("/\A[a-z\d]{8,100}+\z/i", $password) ) {
        $err["password"] = "パスワードは英数字8文字以上100文字以下にしてください。";
    }

    if( !$confirmation_password ) {
        $err["confirmation_password"] = "パスワードを再入力してください。";
    }

    if( $password !== $confirmation_password ) {
        $err["pass_match_err"] = "確認用パスワードと一致しません。";
    }

    // ユーザー登録処理
    if( count($err) == 0 ) {
        $userData = [
            "username" => $username, 
            "email" => $email, 
            "password" => $password
        ];

        $hasCreated = UserLogic::createUser($userData);

        if( $hasCreated == 0 ) {
            $err["signup_failed"] = "エラーが発生しました。";
            $_SESSION["signup_err"] = $err;
            header('Location: ../src/signup_form.php');
            exit;
        } elseif( $hasCreated == 1 ) {
            $err["duplication_email"] = "このメールアドレスは既に別のアカウントで使用されています。";
            $_SESSION["signup_err"] = $err;
            header('Location: ../src/signup_form.php');
            exit;
        } elseif( $hasCreated == 2 ) {
            $_SESSION["signup_success"] = "ログインしました。";
            header('Location: ../src/home.php');
            exit;    
        }
        
    } else {
        $_SESSION["signup_err"] = $err;
        header('Location: ../src/signup_form.php');
        exit;
    }




