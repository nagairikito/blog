<?php require('../functions/sessionStart.php'); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>新規アカウント作成フォーム</title>
    <link rel="stylesheet" href="../css/app.css">

</head>
<body>
    <?php require("./parts/header.php");?>
    
<main>
    <h1>新規アカウント作成フォーム</h1>

    <form action="../functions/signup.php" method="POST">
        <p>ユーザー名</p>
        <input type="text" name="username"><br>
        <?php if( isset($_SESSION["signup_err"]["username"]) ) : ?>
                <p class="fail"><?php echo $_SESSION["signup_err"]["username"]; ?></p>
        <?php endif; ?>

        <p>メールアドレス</p>
        <input type="email" name="email" placeholder="email@example.com"><br>
        <?php if( isset($_SESSION["signup_err"]["email"]) ) : ?>
                <p class="fail"><?php echo $_SESSION["signup_err"]["email"]; ?></p>
        <?php endif; ?>
        <?php if( isset($_SESSION["signup_err"]["duplication_email"]) ) : ?>
                <p class="fail"><?php echo $_SESSION["signup_err"]["duplication_email"]; ?></p>
        <?php endif; ?>


        <p>パスワード</p>
        <input type="password" name="password"><br>
        <?php if( isset($_SESSION["signup_err"]["password"]) ) : ?>
            <p class="fail"><?php echo $_SESSION["signup_err"]["password"]; ?></p>
        <?php endif; ?>
        <?php if( isset($_SESSION["signup_err"]["pass_match_err"]) ) : ?>
                <p class="fail"><?php echo $_SESSION["signup_err"]["pass_match_err"]; ?></p>
        <?php endif; ?>


        <p>確認用パスワード</p>
        <input type="password" name="confirmation_password"><br>
        <?php if( isset($_SESSION["signup_err"]["confirmation_password"]) ) : ?>
                <p class="fail"><?php echo $_SESSION["signup_err"]["confirmation_password"]; ?></p>
        <?php endif; ?>

        <br>
        <input type="submit" value="アカウント作成"><br>
        

        <?php if( isset($_SESSION["signup_err"]["signup_failed"]) ) : ?>
                <p class="fail"><?php echo $_SESSION["signup_err"]["signup_failed"]; ?></p>
        <?php endif; ?>
    </form>

</main>


</body>
</html>

<?php require("../functions/sessionDelete.php"); sessionDelete("signup_err");?>
