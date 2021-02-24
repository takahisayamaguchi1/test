<?php

require_once('Validation.php');
require_once('functions.php');
require_once('DBUsers.php');

if($_SERVER['REQUEST_METHOD'] === "GET"){

  die('このページにはGETでアクセス出来ません。');

}else{
  $userid1 = get_auth_session();
  if($userid1 != $_POST['userid']){
    check_error(array("IDがログイン中のユーザーのものではありません。ユーザーIDは変更できません"),'user_e_form.php');
  }

 
  @session_start();
  $err_msgs = get_error_msgs();

  if( !$_POST['userid'] || !$_POST['password'] || !$_POST['username'] ){
    check_error(array("すべての項目を入力してください"),'user_e_form.php');
  }
  
  $userid = htmlspecialchars($_POST['userid']);
  $password = htmlspecialchars($_POST['password']);
  $auth_password = password_hash($password, PASSWORD_DEFAULT);
  $username = htmlspecialchars($_POST['username']);

  $user = array(
    'userid' => $userid,
    'password' => $password,
    'auth_password' => $auth_password,
    'username' => $username,
  );

  $_SESSION['user'] = $user;

  $validate = new Validation($user);

  $err_msgs = $validate->validate();

  check_error($err_msgs,'user_form.php');
}

?>
<!doctype html>
<html lang="ja">
  <head>
    <link rel="stylesheet" href="style.css">
    <title>ユーザー情報変更確認</title>
  </head>
  <body>
    <h1>ユーザー情報変更確認</h1>
    <table class="table mt-2">
        <tr>
            <th>ID</th>
            <th>パスワード</th>
            <th>名前</th>
        </tr>
        <tr>
            <td><?=$userid?></td>
            <td><?=$password?></td>
            <td><?=$username?></td>
        </tr>
    </table>
    <form action="user_e_form_complete.php" method="post">
    <input type="submit" class="btn btn-primary" value="変更確定">
    </form>
    <form action="user_e_form.php" method="get">
        <input type="submit" class="btn btn-primary" value="入力画面に戻る">
    </form>


    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
  </html>
