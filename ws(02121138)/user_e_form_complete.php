<?php

require_once('Validation.php');
require_once('functions.php');
require_once('DBUsers.php');

if($_SERVER['REQUEST_METHOD'] === "GET"){

  die('このページにはGETでアクセス出来ません。');

}else{

  
  @session_start();

  
  $err_msgs = get_error_msgs();

  if((isset($_SESSION['user']))&&(!empty($_SESSION['user']))){
    $user = array();
    $user = $_SESSION['user'];
    unset($_SESSION['user']);
  }else{

    array_push($err_msgs,'もう一度入力してください');
    check_erro($err_msgs,'user_e_form.php');
  }

  $member = new DBUsers();
    ($member->update($user)) ? :  check_error(array('データ保存に失敗しました'),'user_e_form.php');
}

?>


<!doctype html>
<html lang="ja">
  <head>
    <link rel="stylesheet" href="style.css">
    <title>変更完了</title>
  </head>
  <body>
    <h1>変更完了</h1>
      <table>
        <tr>
            <th>ID</th>
            <th>パスワード</th>
            <th>名前</th>
        </tr>
        <tr>
            <td><?=$user['userid']?></td>
            <td><?=$user['password']?></td>
            <td><?=$user['username']?></td>
        </tr>
      </table>
    <a href="main.php">ホーム画面に戻る</a>
  </body>
</html>
