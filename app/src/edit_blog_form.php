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
    <?php //echo$_SESSION['blog_data'][0]['id'] ?>
    <h1>ブログ編集フォーム</h1>
    <form action="../functions/editBlog.php" method="POST">
        <h2>タイトル</h2>
        <input type="hidden" name="blog_id" value="<?php echo $_SESSION['blog_data'][0]['id'] ?>">
        <input type="text" name="title" value="<?php echo $_SESSION['blog_data'][0]['title'] ?>">
        <?php if( isset($_SESSION["editBlog_err"]["title"]) ) : ?>
            <p class="fail"><?php echo $_SESSION["editBlog_err"]["title"] ?></p><br>
        <?php endif; ?>

        <h3>本文</h3>
        <!-- <div contenteditable="true" name="contents" class="contents-box"><?php // echo $_SESSION['blog_data'][0]['contents'] ?></div><br> -->
        <textarea name="contents" rows="30" cols="200"><?php echo $_SESSION['blog_data'][0]['contents'] ?></textarea><br>

        <?php if( isset($_SESSION["editBlog_err"]["contents"]) ) : ?>
            <p class="fail"><?php echo $_SESSION["editBlog_err"]["contents"] ?></p><br>
        <?php endif; ?>

        <input type="submit" value="編集">
    </form>
    <?php if( isset($_SESSION["editBlog_failed"]) ) : ?>
        <p class="fail"><?php echo $_SESSION["editBlog_failed"]; ?></p>
    <?php endif; ?>

</main>
</body>
</html>

<?php
require('../functions/sessionDelete.php'); 
sessionDelete("postBlog_err"); 
sessionDelete("postBlog_failed"); 
sessionDelete("editBlog_err"); 
sessionDelete("editBlog_failed"); 
?>
