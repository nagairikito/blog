<?php
require_once '../setting/ini.php';
require_once './sessionStart.php';
require_once '../classes/BlogLogic.php';

$blog_id = $_GET["request_blog_id"];
$blog_id = intval($blog_id);

$blog_data = BlogLogic::showBlogContents($blog_id);

if( isset($blog_data) ) {
    $_SESSION["blog_data"] = $blog_data[0];
    $_SESSION["blog_title"] = $blog_data[0]["title"];

} else {
    $_SESSION["showBlogContents_err"] = "ブログが見つかりません。";
    // $_SESSION["blog_title"] = "ブログが見つかりません。";

}

header('Location: ../src/blog_contents.php');
exit;
