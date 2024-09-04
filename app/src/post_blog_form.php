<?php require('../functions/sessionStart.php'); ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログ投稿フォーム</title>

    <link rel="stylesheet" href="../css/app.css">
</head>
<body>
<?php require("./parts/header.php");?>
<main>
    <h1>ブログ投稿フォーム</h1>
    <form action="../functions/postBlog.php" method="POST">
        <h2>タイトル</h2>
        <input type="text" name="title">
        <?php if( isset($_SESSION["postBlog_err"]["title"]) ) : ?>
            <p class="fail"><?php echo $_SESSION["postBlog_err"]["title"] ?></p><br>
        <?php endif; ?>

        <h3>本文</h3>
        <textarea name="contents" rows="30" cols="150"></textarea><br>
        <?php if( isset($_SESSION["postBlog_err"]["contents"]) ) : ?>
            <p class="fail"><?php echo $_SESSION["postBlog_err"]["contents"] ?></p><br>
        <?php endif; ?>

        <input type="submit" value="投稿">
    </form>
    <?php if( isset($_SESSION["postBlog_failed"]) ) : ?>
        <p class="fail"><?php echo $_SESSION["postBlog_failed"]; ?></p>
    <?php endif; ?>

</main>
</body>
</html>

<?php
require('../functions/sessionDelete.php'); 
sessionDelete("postBlog_err"); 
sessionDelete("postBlog_failed"); 
?>
