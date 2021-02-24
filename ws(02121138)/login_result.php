<?php

require_once('functions.php');
require_once('DBUsers.php');


if($_SERVER['REQUEST_METHOD'] === "POST"){

    $userid = htmlspecialchars($_POST['userid']);
    $password = htmlspecialchars($_POST['password']);
    $err_msgs = array();

    if(empty($userid)){
        array_push($err_msgs,'ユーザー名が空です、必ず入力してください');
    }

    if(empty($password)){
        array_push($err_msgs,'パスワードが空です、必ず入力してください');
    }

    check_error($err_msgs,'login.php');
    $member = new DBUsers();
    $auth_password = $member->get_password_by_userid($userid);


    if(!empty($auth_password)){
        if(password_verify($password,$auth_password)){
            set_auth_session($userid);
        }else{
            $err_msgs = array('ログインできません');
        }

    }else{  
        $err_msgs = array('該当のユーザーは存在しません');
    }

 check_error($err_msgs,'login.php');

}else{
    die('このページにはGETでアクセス出来ません。');
}

$userid = $_SESSION['auth_user'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="style.css">
    <title>ログイン完了</title>
</head>
    <body>
    <img src="images/kensetutyu.jpg" alt="title"class = "kensetutyu";>
        <h1>ログインが成功しました。</h1>
        <p>ログイン中のユーザー：<?=$userid?>さん</p>
        <p><a href="main.php">ホーム画面に進む</a></p>
        <p><a href="login.php">ログイン画面に戻る</a></p>
    </body>
</html>
