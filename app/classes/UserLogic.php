<?php

require_once '../setting/ini.php';
require_once '../functions/sessionStart.php';
require_once '../functions/sessionDelete.php';
require_once '../functions/dbconnect.php';

class UserLogic {
    /**
     * ユーザー登録
     * @param array $userData
     * @return bool $result
     */
    public static function createUser($userData) {

        $result = 0;

        $email = $userData["email"];
        $pre_sql = "SELECT id FROM users WHERE email = '$email' ";
        $pre_stmt = dbconnect()->query($pre_sql);
        $check_email = $pre_stmt->fetchAll(PDO::FETCH_ASSOC);

        if( count($check_email) > 0 ) {
            $result = 1;
            return $result;
        }
        
        $arr = [];
        $arr[] = $userData['username'];
        $arr[] = $userData['email'];
        $arr[] = password_hash($userData['password'], PASSWORD_DEFAULT);
        $arr[] = date("Y_m_d_H:i:s");


        $sql = 'INSERT INTO users (name, email, password, created_at) VALUES (?, ?, ?, ?)';
        

        try { // DBを操作するときは必ずtry{}catch{}をつかう
            $stmt = dbconnect()->prepare($sql);
            $check_result = $stmt->execute($arr); // execute()はbool値を返す
            if( $check_result == true ) {
                $result = 2;
            }
        } catch(\Exception $e) {
            return $result;
        }

        return $result;

    }

    /**
     * ログイン
     * @param string $email
     * @param string $password
     * @return bool $result
     */
    public static function login($email, $password) {

        $false_count = 0;
        $result = false;

        $user = self::getUserByEmail($email);

        if( $user == false ) {
            $false_count += 1;
        }


        if( $false_count == 0 && password_verify($password, $user['password']) ) {
                sessionDelete('login_user');
                // session_regenerate_id(true);
                $_SESSION['login_user'] = $user;
                $result = true;
        }

        return $result;



    }

    /**
     * emailによるユーザー情報の取得
     * @param string $email
     * @return array|bool $user|false
     */
    public static function getUserByEmail($email) {

        $sql = 'SELECT * FROM users WHERE email = ?';

        $arr = [];
        $arr[] = $email;

        try {
            $stmt = dbconnect()->prepare($sql);
            $stmt->execute($arr);
            $user = $stmt->fetch();
            return $user;
        } catch(\Exception $e) {
            return false;
        }


    }


    
}