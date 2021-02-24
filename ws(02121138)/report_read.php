<?php

require_once('functions.php');
require_once('DBReport.php');


if(!verify_login()){
    send_redirect('login.php');
}

if($_SERVER['REQUEST_METHOD'] === "GET"){
    send_redirect('main.php');
}

    @session_start();
    if(!$_POST['id']){
        check_error(array("日報データを取得できません"),'main.php');
    }
    
    $report = new DBReport();
    $report_one = array();
    $report_one = $report->get_report_byid($_POST['id']);
    if(isset($report_one) && $report_one != null){
    }else{
        check_error(array("日報データが存在しません"),'main.php');    }
        $userid = $_SESSION['auth_user'];
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>日報閲覧画面</title>
</head>
    <body>
        <hr>
        <p>日報詳細＆承認画面</p>
        <p>ログイン中のユーザー：<?=$userid?>さん</p>
        <hr>
        <?php if(isset($report_one) && count($report_one)):?>
            <table border="5"align ="center";>
                    <tr><td>
                        <li>NO.<?=$report_one['id']?></li>
                    </tr></td>
                    <tr><td>
                            <li><?=$report_one['report_body']?></li>
                            </tr></td>
                    <tr><td>
                            <li><?=$report_one['userid']?>さん</li>
                    </tr></td>
                    <tr><td>
                            <li>【<?=$report_one['create_at']?>】</li>
                    </tr></td>
                    <tr><td>
                            <li>承認ステータス【<?=$report_one['approval']?>】</li>
                    </tr></td>
            </table>
        <?php endif ?>
    <form action="report_approval.php" method="post">
        <input type="hidden" name="id" id="id" value="<?=$report_one['id']?>">
        <input type="hidden" name="approval" id="approval" value="承認済み">
        <input type="hidden" name="userid" id="userid" value="<?=$userid?>">
        <button type="submit" class="btn btn-primary">上記日報を承認する</button>
    </form>
        <a href="report_list.php">一覧に戻る</a>
    </body>
</html>