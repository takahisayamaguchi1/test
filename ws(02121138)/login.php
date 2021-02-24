<?php
require_once('functions.php');

if($_SERVER['REQUEST_METHOD'] === "GET"){
    
    remove_auth_session();

    $err_msgs = get_error_msgs();
    
}else{
    die('このページにはPOSTでアクセス出来ません。');
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
    <title>ログイン画面</title>
</head>
<body class="login_page">
<img src ="images/omote_logo.png">
<hr>
<p>
    ログイン画面
</p>
<hr>
<?php if(isset($err_msgs) && count($err_msgs)):?>
    <ul>
        <?php foreach($err_msgs as $err_msg):?>
        <li><?=$err_msg?></li>
        <?php endforeach ?>
    </ul>
<?php endif ?>
<form action="login_result.php" method="post">
<div class="container login_form">
<div class="row">
    <div class="col-xs-12 col-sm-2">
        <P></P>
    </div>
    <div class="col-xs-12 col-sm-4">
        <label for="userid">ユーザーID</label>
        <input type="text" name="userid" id="userid">
	</div>
    <div class="col-xs-12 col-sm-4">
        <label for="password">パスワード</label>
        <input type="password" name="password" id="password">
    </div>
    <div class="col-xs-12 col-sm-2">
        <P></P>
        <br>
        <P></P>
    </div>
    <div class="col-xs-12 col-sm-12">
        <button type="submit"class="btn">ログイン</button>
	</div>
</div>
</div>
</form>
<br>
<div class="new_account">
<a href="user_form.php">※新しくアカウントを作成する</a>
</div>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>
</html>


    

    
