<?php require('../functions/sessionStart.php');?>
<?php require_once('../functions/showAllBlogs.php');?>

<!DOCTYPE html>
<html lang="ja">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>blog.</title>
    <link rel="stylesheet" href="../css/app.css">

</head>
<body>

<?php require("./parts/header.php");?>

<main>
    <h1>トップページ</h1>
    
        <?php if( isset($_SESSION["signup_success"]) ) : ?>
            <p class="success"><?php echo $_SESSION["signup_success"]; ?></p>
        <?php endif; ?>
        <?php if( isset($_SESSION["login_success"]) ) : ?>
            <p class="success"><?php print_r( $_SESSION["login_success"]); ?></p>
        <?php endif; ?>
        <?php if( isset($_SESSION["logout"]) ) : ?>
            <p class="success"><?php echo $_SESSION["logout"]; ?></p>
        <?php endif; ?>
        <?php if( isset($_SESSION["showBlog_err"]) ) : ?>
            <p class="success"><?php echo $_SESSION["showBlog_err"]; ?></p>
        <?php endif; ?>

        <?php if( isset($_SESSION['all_blogs_err']) ) : ?>
            <p><?php echo $_SESSION["all_blogs_err"]; ?></p>
        <?php endif; ?>



    <p >注目トピック（スライド形式）</p>
    <p>ブログ全件取得（更新順）</p>
    <p>注目のユーザー</p>

    <?php if( isset($_SESSION['allBlogData']) ) : ?>
        <ul>
            <?php foreach( $_SESSION['allBlogData'] as $key => $blog) : ?>
                <li class="article">
                    <a href="../functions/showBlogContents.php?request_blog_id=<?php echo $blog['id'] ?>" class="a_reset_css">
                        <div><?php echo $blog['title'] ?></div>
                        <div><?php echo $blog['contents'] ?></div>
                        <div><?php echo $blog['name'] ?></div>
                        <div><?php echo $blog['created_at'] ?></div>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</main>

<footer>
    
</footer>


</body>
</html>

<?php 
require('../functions/sessionDelete.php'); 
sessionDelete("signup_success"); 
sessionDelete("login_success"); 
sessionDelete("logout"); 
sessionDelete("showBlog_err"); 
?>
