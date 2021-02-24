<?php

require_once('functions.php');
require_once('DBReport.php');


if(!verify_login()){
    send_redirect('login.php');
}

$userid = htmlspecialchars($_POST['userid']);

if($_SERVER['REQUEST_METHOD'] === "GET"){
    send_redirect('main.php');
}

?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>日報承認完了</title>
</head>
    <body>
        <p>承認完了しました</p>
        <a href="report_list.php">日報一覧に戻る</a>
    </body>
</html>