<?php require('../functions/sessionStart.php'); ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/app.css">

    <title><?php echo $_SESSION["blog_title"] ?></title>
</head>

<?php require("./parts/header.php");?>

<body>
    <?php if( isset($_SESSION["showBlogContents_err"]) ) : ?>
        <p><?php echo $_SESSION["showBlogContents_err"] ?></p>
    <?php endif ; ?>

    <?php if( isset($_SESSION["blog_data"]) ) : ?>
        <h1><?php echo $_SESSION["blog_data"]["title"] ?></h1>
        <p><?php echo $_SESSION["blog_data"]["contents"] ?></p>
    <?php endif ; ?>

</body>
</html>