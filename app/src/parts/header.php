<header>
    <ul class="nav">
            <li><a class="a_reset_css" href="home.php">トップページへ</a></li>
        <?php if( isset($_SESSION["login_user"]) ) : ?>
            <li>
                <form action="../functions/logout.php" method="POST">
                    <input type="hidden" name="logout" value="logout">
                    <input class="btn_reset_css" type="submit" value="ログアウト">
                </form>
            </li>
            <li><a class="a_reset_css" href="login_form.php">別のアカウントでログイン</a></li>
            <li><a class="a_reset_css" href="../../functions/showMyBlog.php">マイブログ</a></li>
            <li><a href="./post_blog_form.php" class="a_reset_css">投稿する</a></li>
        <?php else : ?>
            <li><a class="a_reset_css" href="login_form.php">ログイン</a></li>
        <?php endif; ?>
    </ul>
</header>