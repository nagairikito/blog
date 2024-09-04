<?php
require_once '../setting/ini.php';
require_once './sessionStart.php';
require_once '../classes/BlogLogic.php';

$blog_id = $_POST['blog_id'];

BlogLogic::editBlogForm($blog_id);
exit;
