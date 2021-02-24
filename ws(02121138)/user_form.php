<?php
require_once('functions.php');

  if($_SERVER['REQUEST_METHOD'] === "POST"){

    die('このページにはPOSTでアクセス出来ません。');

  }

  remove_auth_session();

  $err_msgs = get_error_msgs();

  $userid = '';
  $password = '';
  $username = '';

  if(isset($_SESSION['user']) && $_SESSION['user'] != ''){
    $userid = $_SESSION['user']['userid'];
    $password = $_SESSION['user']['password'];
    $username = $_SESSION['user']['username'];
    unset($_SESSION['user']);
  }
?>


<!doctype html>
<html lang="ja">
  <head>
    <link rel="stylesheet" href="style.css">
    <title>ユーザー登録</title>
  </head>
  <body>
    <div class="container">
    
    <hr>
        <p>
          ユーザー情報を保存しよう
        </p>
        <hr>
    <?php if(isset($err_msgs) && count($err_msgs)):?>
      <ul>
        <?php foreach($err_msgs as $err_msg):?>
        <li><?=$err_msg?></li>
        <?php endforeach ?>
      </ul>
    <?php endif ?>
    <form action="user_form_confirm.php" method="post">
        <label for="userid">ユーザーID</label>
        <input type="text" name="userid" id="userid" value="<?=$userid?>"placeholder="10文字以内"><br>
        <label for="password">パスワード</label>
        <input type="password" name="password" id="password" value="<?=$password?>"placeholder="20文字以内"><br>
        <label for="username">登録ネーム</label>
        <input type="username" name="username" id="username" value="<?=$username?>"placeholder="20文字以内"><br>
        <button type="submit" class="btn btn-primary">登録</button>
    </form>
    <a href="login.php">戻る</a>
  </body>
</html>