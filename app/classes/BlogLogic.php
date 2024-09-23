<?php

require_once '../setting/ini.php';
require_once '../functions/sessionStart.php';
// require_once '../functions/sessionDelete.php';
require_once '../functions/dbconnect.php';

class BlogLogic {
    /**
     * ブログ全件表示
     */
    public static function showAllBlogs() {
        if( isset($_SESSION['all_blogs_err']) ) {
            unset($_SESSION['all_blogs_err']);
        }
        if( isset($_SESSION['allBlogData']) ) {
            unset($_SESSION['allBlogData']);
        }

        try {
            $sql = "SELECT b.id, b.user_id, b.title, b.contents, u.name, b.created_at FROM blogs as b INNER JOIN users as u ON b.user_id = u.id ORDER BY b.created_at DESC";

            $stmt = dbconnect()->query($sql);
            $allBlogData = $stmt->fetchAll(PDO::FETCH_ASSOC);


            $_SESSION['allBlogData'] = $allBlogData;

        } catch(\Exception $e) {
            $_SESSION['all_blogs_err'] = 'エラーが発生しました。';
        }
        return;

        //header('Location: ../functions/showAllBlogs.php');
    }

    
    /**
     * 検索機能
     */
    public static function search($keyword) {
        if( isset($_SESSION['searchResult']) ) {
            unset($_SESSION['searchResult']);
        }
        if( isset($_SESSION['search_err']) ) {
            unset($_SESSION['search_err']);
        }
        $result_check = 0;

        if( isset($keyword) ) {
            try {
                $sql = "SELECT b.id, b.user_id, b.title, b.contents, u.name, b.created_at FROM blogs as b INNER JOIN users as u ON b.user_id = u.id WHERE b.title LIKE '%$keyword%' OR b.contents LIKE '%$keyword%' ORDER BY b.created_at DESC";

                $stmt = dbconnect()->query($sql);
                $search_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if( count($search_result) == 0 ) {
                    $result_check = 2;
                    return $result_check;
                }

                $_SESSION['searchResult'] = $search_result;
                $result_check = 1;

            } catch(\Excption $e) {
                $result_check = 3;
            }
        } else {
            $result_check = 0;
        }

        return $result_check;

    }


    /**
     * ブログの投稿
     */
    public static function postBlog($blogData) {
        $result = 0;

        $arr = [];
        $arr[] = $_SESSION["login_user"]["id"];
        $arr[] = $blogData["title"];
        $arr[] = $blogData["contents"];
        $arr[] = date("Y_m_d_H:i:s");

        $sql = "INSERT INTO blogs (user_id, title, contents, created_at) VALUES (?,?,?,?)";

        try {
            $stmt = dbconnect()->prepare($sql);
            $check_result = $stmt->execute($arr);
            if( $check_result == true ) {
                $result = 1;
            }

            // マイブログページのセッションの上書き
            self::showMyBlog();

        } catch(\Exception $e) {
            return $result;
        }

        return $result;

    }

    /**
     * マイブログページの表示
     */
    public static function showMyBlog() {
        $user_id = $_SESSION["login_user"]["id"];
        
        try {
            $sql = "SELECT * FROM blogs WHERE user_id = '$user_id' ORDER BY created_at DESC";

            $stmt = dbconnect()->query($sql);
            $blogData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $_SESSION['blogData'] = $blogData;
            header('Location: ../src/myblog.php');
            // exit;

        } catch(\Exception $e) {
            $_SESSION["showBlog_err"] = "エラーが発生しました。";
            header('Location: ../src/myblog.php');
            // exit;
        }

    }

    /**
     * idによるブログデータの取得
     */
    public static function getBlogData($blog_id) {
        try {
            $sql = "SELECT * FROM blogs WHERE id = '$blog_id'";

            $stmt = dbconnect()->query($sql);
            $blogData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $blogData;

        } catch(\Exception $e) {
            $blogData = null;
            return $blogData;
        }

    }

    /**
     * ブログのコンテンツを表示
     */
    public static function showBlogContents($blog_id) {

        $blog_data = self::getBlogData($blog_id);

        if( isset($blog_data) ) {
            $_SESSION["blog_data"] = $blog_data[0];
            $_SESSION["blog_title"] = $blog_data[0]["title"];

        } else {
            $_SESSION["showBlogContents_err"] = "ブログが見つかりません。";
            $_SESSION["blog_title"] = "ブログが見つかりません。";

        }

        header('Location: ../src/blog_contents.php');
        exit;

    }


    /**
     * ブログの削除
     */
    public static function deleteBlog($blog_id) {
        try {
            // ブログを削除
            $sql = "DELETE FROM blogs WHERE id = '$blog_id'";
            $stmt = dbconnect()->query($sql);
            $stmt->execute();

            // マイブログページのセッションを上書き
            self::showMyBlog();
            
            $result = 1;
            return $result;
    
        } catch(\Exception $e) {
            $result = 0;
            return $result;
        }
    }

    /**
     * ブログ編集フォーム
     */
    public static function editBlogForm($blog_id) {
        $blog_data = self::getBlogData($blog_id);
        $_SESSION['blog_data'] = $blog_data;
        header('Location: ../src/edit_blog_form.php');
        exit;
    }


    /**
     * ブログの編集
     */
    public static function editBlog($blog_data) {
        $blog_id = $blog_data['id'];
        $title = $blog_data['title'];
        $contents = $blog_data['contents'];

        try {
            // ブログを編集
            $sql = "UPDATE blogs SET title='$title', contents='$contents' WHERE id='$blog_id'";
            $stmt = dbconnect()->query($sql);
            $stmt->execute();

            // マイブログページのセッションを上書き
            self::showMyBlog();
            
            $result = 1;
            return $result;
    
        } catch(\Exception $e) {
            $result = 0;
            return $result;
        }
    }

}