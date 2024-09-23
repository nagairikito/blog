<header>
    <div class="search_bar_layout">
        <form action="../../functions/searchResult.php" method="GET" class="search_bar">
            <input type="search" name="keyword" class="keyword_bar" value="<?php if( isset($_SESSION['keyword']) ){echo $_SESSION['keyword'];} ?>">
            <!-- <input type="search" name="keyword" class="keyword_bar" value="<?php // if( isset( $keyword ) ){echo $keyword;} ?>"> -->
            <input type="submit" value="検索">
        </form>
    </div>

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