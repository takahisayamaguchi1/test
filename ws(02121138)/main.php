<?php
require_once('functions.php');

if(!verify_login()){
    send_redirect('login.php');

}
    $err_msgs = get_error_msgs();
    unset($_SESSION['report_body']);
    $userid = $_SESSION['auth_user'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="style.css">
    <title>ホーム画面</title>
</head>
    <body>
    <img src="images/kensetutyu.jpg" alt="title"class = "kensetutyu";>
        <?php if(isset($err_msgs) && count($err_msgs)):?>
        <hr>
            <ul>
                <?php foreach($err_msgs as $err_msg):?>
                <li><?=$err_msg?></li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
        <hr>
        <p>ホーム画面</p>
        <p>ログイン中のユーザー：<?=$userid?>さん</p>
        <hr>
        <div class ="menu">            
            <a href="report.php">新規日報作成</a>
            <br>
            <a href="report_list.php">日報一覧</a>
            <br>
            <a href="logout.php">ログアウト</a>
            <br>
            <form action="user_e_form.php" method="POST">
            <input type="hidden" name="userid" id="userid" value="<?=$_SESSION['auth_user']?>"><br>
            <li><button type="submit">ユーザー情報変更</button></li>
            </form>
        </div>
    </body>
</html>
