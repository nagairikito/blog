<?php //require('../classes/BlogLogic.php');?>
<?php require('../functions/sessionStart.php'); ?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイブログ</title>

    <link rel="stylesheet" href="../css/app.css">

</head>
<body>
    <?php require("./parts/header.php");?>
    
<main>
    <h1>マイブログ</h1>   
    <?php if( isset($_SESSION["login_user"]) ) : ?>
        <ul>
            <li class="bold"><?php echo $_SESSION["login_user"]["name"]; ?></li>
            <li><?php echo "@" . $_SESSION["login_user"]["email"]; ?></li>
        </ul>

        <h2>マイブログ一覧</h2>
        <button><a href="./post_blog_form.php" class="a_reset_css">投稿する</a></button><br>

        <?php if( isset($_SESSION["postBlog_success"]) ) : ?>
            <p class="success"><?php echo $_SESSION["postBlog_success"]; ?></p>
        <?php endif; ?>

        <?php if( isset($_SESSION["showBlog_err"]) ) : ?>
            <p class="fail"><?php echo $_SESSION["showBlog_err"]; ?></p>
        <?php endif; ?>

        <?php if( isset($_SESSION["deleteBlog_success"]) ) : ?>
            <p class="success"><?php echo $_SESSION["deleteBlog_success"]; ?></p>
        <?php endif; ?>

        <?php if( isset($_SESSION["deleteBlog_fail"]) ) : ?>
            <p class="fail"><?php echo $_SESSION["deleteBlog_fail"]; ?></p>
        <?php endif; ?>

        <?php if( isset($_SESSION["editBlog_success"]) ) : ?>
            <p class="success"><?php echo $_SESSION["editBlog_success"]; ?></p>
        <?php endif; ?>

        <?php if( isset($_SESSION["editBlog_fail"]) ) : ?>
            <p class="fail"><?php echo $_SESSION["editBlog_fail"]; ?></p>
        <?php endif; ?>


        <table border="0">
            <?php foreach($_SESSION['blogData'] as $blog) : ?>
                <tr>
                    <td>
                        <form action="../functions/showBlogContents.php" method="GET">
                            <input type="hidden" name="request_blog_id" value="<?php echo $blog['id']; ?>">
                            <input type="submit" value="<?php echo $blog['title'] ?>" class="btn_reset_css">
                        </form>
                    </td>
                    <td>
                        <form action="../functions/editBlogForm.php" method="POST">
                            <input type="hidden" name="blog_id" value="<?php echo $blog['id'] ?>">
                            <input type="submit" value="編集">
                        </form>
                    </td>
                    <td>
                        <form action="../functions/deleteBlog.php" method="POST">
                            <input type="hidden" name="blog_id" value="<?php echo $blog['id'] ?>">
                            <input type="submit" value="削除" onclick="return confirm('削除してもよろしいですか。')">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>



    <?php else : ?>
        <p>ログインしてください。</p>
    <?php endif; ?>
</main>

</body>
</html>

<?php 
require_once("../functions/sessionDelete.php"); 
sessionDelete("postBlog_success");
sessionDelete("showBlog_err");
sessionDelete("deleteBlog_success");
sessionDelete("deleteBlog_fail");
sessionDelete("editBlog_success");
sessionDelete("editBlog_fail");
?>
