<?php

require_once('functions.php');
require_once('DBUsers.php');




 
    @session_start();
    $userinfo = new DBUsers();
    $err_msgs = get_error_msgs();

    if(isset($_POST['userid'])){
      $userinfo2 = array();
      $userinfo2 = $userinfo->get_user($_POST['userid']);
      $_SESSION['userid'] = $userinfo2['userid'];
      $_SESSION['password'] = $userinfo2['password'];
      $_SESSION['username'] = $userinfo2['username']; 
    }else{

      $userinfo2 = array();
      $userinfo2 = $userinfo->get_user($_SESSION['userid']);
      $_SESSION['userid'] = $userinfo2['userid'];
      $_SESSION['password'] = $userinfo2['password'];
      $_SESSION['username'] = $userinfo2['username']; 
    }

    

  $userid = '';
  $password = '';
  $username = '';

  $userid = $_SESSION['userid'];
  $password = $_SESSION['password'];
  $username = $_SESSION['username'];
  
?>


<!doctype html>
<html lang="ja">
  <head>
    <link rel="stylesheet" href="style.css">
    <title>ユーザー情報確認・変更</title>
  </head>
  <body>
    <div class="container">
        <hr>
        <p>ユーザー情報変更画面</p>
        <p>ログイン中のユーザー：<?=$userid?>さん</p>
        <hr>
    <?php if(isset($err_msgs) && count($err_msgs)):?>
      <ul>
        <?php foreach($err_msgs as $err_msg):?>
        <li><?=$err_msg?></li>
        <?php endforeach ?>
      </ul>
    <?php endif ?>
    <form action="user_e_form_confirm.php" method="post">
        <label for="userid">ユーザーID</label>
        <input type="text" name="userid" id="userid" value="<?=$userid?>"><br>
        <label for="password">パスワード</label>
        <input type="password" name="password" id="password" value=""><br>
        <label for="username">登録ネーム</label>
        <input type="username" name="username" id="username" value="<?=$username?>"><br>
        <button type="submit" class="btn btn-primary">変更する</button>
    </form>
    <p>※入力するパスワードは以前と同じものでも新しいものでも構いません</p>
    <br>    
    <a href="main.php">ホームに戻る</a>
  </body>
</html>