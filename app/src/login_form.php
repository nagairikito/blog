<?php require('../functions/sessionStart.php'); ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ログインフォーム</title>
    <link rel="stylesheet" href="../css/app.css">

</head>
<body>
    <?php require("./parts/header.php");?>

<main>
    <h1>ログインフォーム</h1>

    <?php if( isset($_SESSION["login_failed"]) ) : ?>
        <p class="fail"><?php echo $_SESSION["login_failed"];?></p>
    <?php endif; ?>

    <form action="../functions/login.php" method="POST">
        <p>メールアドレス</p>
        <input type="email" name="email" placeholder="example@email.com"><br>
        <?php if( isset($_SESSION["login_err"]["email"]) ) : ?>
            <p class="fail"><?php echo $_SESSION["login_err"]["email"] ?></p><br>
        <?php endif; ?>

        <p>パスワード</p>
        <input type="password" name="password"><br>
        <?php if( isset($_SESSION["login_err"]["password"]) ) : ?>
            <p class="fail"><?php echo $_SESSION["login_err"]["password"] ?></p><br>
        <?php endif; ?>

        <input type="submit" value="ログイン">
    </form>

    <p>アカウントをお持ちでない方は<a href="signup_form.php">こちら</a></p>
</main>


</body>
</html>

<?php
require('../functions/sessionDelete.php'); 
sessionDelete("login_err"); 
sessionDelete("login_failed"); 
?>
