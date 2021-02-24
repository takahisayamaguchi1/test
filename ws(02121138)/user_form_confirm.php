<?php

require_once('Validation.php');
require_once('functions.php');
require_once('DBUsers.php');

if($_SERVER['REQUEST_METHOD'] === "GET"){

  //--GETではアクセスできないようにする
  die('このページにはGETでアクセス出来ません。');

}else{

  //セッション、スタート
  @session_start();

  //エラーを取得、と同時に$err_msgsをarrayで宣言している
  $err_msgs = get_error_msgs();

  //POST内のデータが存在しない場合は再入力を促す
  if( !$_POST['userid'] || !$_POST['password'] || !$_POST['username'] ){
    check_error(array("再入力してください"),'user_form.php');
  }
  
  //htmlspecialchars ←色々セキュリティ的にやんちゃされる文字とかを安全にしてくれる
  $userid = htmlspecialchars($_POST['userid']);
  $password = htmlspecialchars($_POST['password']);
  $auth_password = password_hash($password, PASSWORD_DEFAULT);//パスワードを暗号化
  $username = htmlspecialchars($_POST['username']);

  //↑のデータをまとめる君
  $user = array(
    'userid' => $userid,
    'password' => $password,
    'auth_password' => $auth_password,
    'username' => $username,
  );

  //まとめたやつをセッションに保存
  $_SESSION['user'] = $user;

  //validation.phpで作ったvalidationクラスにこれらのデータを渡して、判定してもらう
  $validate = new Validation($user);

  //エラーがあったらエラーメッセージが格納された配列変数を返す
  $err_msgs = $validate->validate();

  //エラーメッセージを数えて、1つ以上あるなら、
  //セッションへエラーメッセージを登録した後、user_form.phpへ戻す
  check_error($err_msgs,'user_form.php');
}

?>



<!doctype html>
<html lang="ja">
  <head>
    <link rel="stylesheet" href="style.css">
    <title>ユーザー登録確認</title>
  </head>
  <body>
    <h1>ユーザー登録確認</h1>

    <li>ID:<?=$userid?></li>
    <li>パスワード:<?=$password?></li>
    <li>名前:<?=$username?></li>
   

    <form action="user_form_complete.php" method="post">
    <input type="submit" class="btn btn-primary" value="保存してOK">
    </form>


    <form action="user_form.php" method="get">
        <input type="submit" class="btn btn-primary" value="やっぱダメ">
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
