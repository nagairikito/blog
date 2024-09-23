<?php require('../functions/sessionStart.php');?>
<?php 
if( isset($_SESSION['stay_keyword']) ){
    $_SESSION['keyword'] = $_SESSION['stay_keyword'];
}

if( isset($_SESSION['keyword']) ) {
    $_SESSION['stay_keyword'] =  $_SESSION['keyword'];

}
?>

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
    <h1>検索結果</h1>
    <?php if( isset($_SESSION['search_err']) ) : ?>
        <p><?php echo $_SESSION['search_err'] ?></p>
    <?php endif ; ?>
    
    <?php if( isset($_SESSION['searchResult']) ) : ?>
        <ul>
            <?php foreach( $_SESSION['searchResult'] as $key => $blog) : ?>
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
sessionDelete('keyword');
?>
