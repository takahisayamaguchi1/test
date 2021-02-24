<?php

require_once('functions.php');
require_once('DBReport.php');
require_once('Validation.php');


if(!verify_login()){
    
    send_redirect('login.php');
}



if($_SERVER['REQUEST_METHOD'] === "GET"){

    
    $err_msgs = get_error_msgs();

    $report_body = "";
    if(isset($_SESSION['report_body'])){
        $report_body = $_SESSION['report_body'];
        unset($_SESSION['report_body']);
    }

}else{

    @session_start();

    if(!$_POST['report_body']){
        check_error(array("再入力してください"),'report.php');
    }
    
    $userid = get_auth_session();
    $report_body = htmlspecialchars($_POST['report_body']);

    $_SESSION['report_body'] = $report_body;

    $report = array(
        'userid' => $userid,
        'report_body' => $report_body,
    );

    $report_check = new Report_Validation($report);

    $err_msgs = $report_check->validate();

    check_error($err_msgs,'report.php');

    
    $report_save = new DBReport();

    
    ($report_save->store($report)) ? :  check_error(array('データ保存に失敗しました'),'report.php');

    check_error(array("保存完了しました"),'main.php');
}
$userid = $_SESSION['auth_user'];
?>



<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>新規日報作成画面</title>
</head>
    <body>
        <hr>
        <p>新規日報作成画面</p>
        <p>ログイン中のユーザー：<?=$userid?>さん</p>
        <hr>
        <?php if(isset($err_msgs) && count($err_msgs)):?>
        <ul>
            <?php foreach($err_msgs as $err_msg):?>
            <li><?=$err_msg?></li>
            <?php endforeach ?>
        </ul>
        <?php endif ?>
        <form action="report.php" method="post">
            <!-- ここに業務内容を記載<text name="report_title" placeholder="業務内容を入力してください"></text><br> -->
            <!-- ここに訪問先企業名を記載<text name="report_company" placeholder="訪問先を入力してください"></text><br> -->
            <!-- 以下は内容詳細を記載-->
            <textarea name="report_body" cols="50" rows="30" maxlength="510" placeholder="日報内容を入力してください。最低でも30文字以上入力してください。"><?=$report_body?></textarea><br>
            <button type="submit"class = "btn">送信</button>
        </form>
        <a href="main.php">ホーム画面に戻る</a>
    </body>
</html>