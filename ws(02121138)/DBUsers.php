<?php

require_once('DBConnect.php');
class DBUsers extends DBConnect{

    public function __construct(){
        parent::getDbh();
    }

    //パスワード確認
    public function get_password_by_userid(string $userid):?string{
        $sql = 'SELECT password FROM users WHERE userid = :userid';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':userid',$userid,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        return (!empty($result)) ? $result['password']: null;
    }

    //ユーザー情報保存
    public function store(array $user):bool{
        $sql = 'INSERT into users (userid,password,username) VALUES (:userid,:auth_password,:username)';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':userid',$user['userid'],PDO::PARAM_STR);
        $stmt->bindParam(':auth_password',$user['auth_password'],PDO::PARAM_STR);
        $stmt->bindParam(':username',$user['username'],PDO::PARAM_STR);
        return $flag = $stmt->execute();
    }


    //ユーザー情報更新
    public function update(array $user):bool{
        $sql = 'UPDATE users SET userid = :userid, password = :auth_password, username = :username where userid = :userid';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':userid',$user['userid'],PDO::PARAM_STR);
        $stmt->bindParam(':auth_password',$user['auth_password'],PDO::PARAM_STR);
        $stmt->bindParam(':username',$user['username'],PDO::PARAM_STR);
        return $flag = $stmt->execute();
    }

    //ユーザーID重複チェック
    public function check_same(string $userid):bool{
        $sql = 'SELECT username FROM users WHERE userid = :userid';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':userid',$userid,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        return (!empty($result)) ? false : true;
    }


     //ユーザーデータ全取得
    public function get_user($userid):?array{
        $sql = 'SELECT * FROM users WHERE userid = :userid';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':userid',$userid,PDO::PARAM_STR);
        $stmt->execute();
        $userinfo = $stmt->fetch();
        return (!empty($userinfo)) ? $userinfo: null;
    }

}