<?php

require_once('functions.php');
require_once('DBReport.php');

if(!verify_login()){
    send_redirect('login.php');
}


if($_SERVER['REQUEST_METHOD'] === "POST"){
    send_redirect('main.php');
}
    @session_start();
    $report_save = new DBReport();
    $report_all = array();
    $report_all = $report_save->get_report_all();

    if(isset($report_all) && $report_all != null){
    }else{
        check_error(array("日報データが存在しません"),'main.php');
    }
    $userid = $_SESSION['auth_user'];
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>日報一覧画面</title>
</head>
    <body>
        <hr>
        <p>日報一覧画面</p>
        <p>ログイン中のユーザー：<?=$userid?>さん</p>
        <hr>
        <?php if(isset($report_all) && count($report_all)):?>
            <table border="1" align ="center";>
                <?php foreach($report_all as $report_pack):?>
                    <tr><td>
                        <ul>
                            <li>NO.<?=$report_pack['id']?></li>
                            <form action="report_read.php" method="post">
                            <input type="hidden" name="id" id="id" value="<?=$report_pack['id']?>"><br>
                            <li><button type="submit"><?=mb_substr($report_pack['report_body'],0,10,"UTF-8")?></button></li>
                            </form>
                            <li><?=$report_pack['userid']?>さん</li>
                            <li>【<?=$report_pack['create_at']?>】</li>
                            <li>承認ステータス【<?=$report_pack['approval']?>】</li>
                            </ul>
                    </tr></td>
            <?php endforeach ?>
            </table>
        <?php endif ?>
        <a href="main.php">ホーム画面に戻る</a>
    </body>
</html>

