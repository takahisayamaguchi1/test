<?php

require_once('Validation.php');
require_once('functions.php');
require_once('DBUsers.php');

if($_SERVER['REQUEST_METHOD'] === "GET"){

  die('このページにはGETでアクセス出来ません。');

}else{

  //セッション、よ～いスタート
  @session_start();

  //エラーを取得、と同時に$err_msgsをarrayで宣言している
  $err_msgs = get_error_msgs();

  //セッション内にuserデータがあるか確認、なければ再入力を要求する
  if((isset($_SESSION['user']))&&(!empty($_SESSION['user']))){
    $user = array();
    $user = $_SESSION['user'];
    unset($_SESSION['user']);
  }else{
    //セッションへエラーメッセージを登録した後、user_form.phpへ戻す
    array_push($err_msgs,'もう一度入力してください');
    check_erro($err_msgs,'user_form.php');
  }

  //DBUsersクラス変数を作成、userデータ内のuseridで、データベースの中を調べ、同じuseridがないかチェック
  $member = new DBUsers();

  //存在していれば（falseが返ってくる）既に使用されている、と警告するとともにエラーを登録して、user_form.phpへ戻す
  //  ( 条件式 )　?   trueならこっちを実行　　:    falseならこっちを実行
  ($member->check_same($user['userid'])) ?  : check_error(array('すでに使用されているIDです'),'user_form.php');

  //保存が失敗した場合（falseが返ってくる）エラーを登録して、user_form.phpへ戻す
  ($member->store($user)) ? :  check_error(array('データ保存に失敗しました'),'user_form.php');

}

?>






<!doctype html>
<html lang="ja">
  <head>
    <link rel="stylesheet" href="style.css">
    <title>保存完了</title>
  </head>
  <body>
    <h1>保存完了</h1>
    <li>ID:<?=$user['userid']?></li>
    <li>パスワード:<?=$user['password']?></li>
    <li>名前:<?=$user['username']?></li>

    <a href="login.php">ログイン画面に戻る</a>

  </body>
</html>
