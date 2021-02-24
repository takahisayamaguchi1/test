<?php
//ログイン情報を$_SESSIONに保存
function set_auth_session(string $authuser):void{
    @session_start();
    $_SESSION['auth_user'] = $authuser;
}

//ログイン情報を$_SESSIONから取得
function get_auth_session():string{
    @session_start();
    return $_SESSION['auth_user'];
}

//$_SESSIONに存在するログイン情報を確認
function verify_login():bool{
    @session_start();
    return (isset($_SESSION['auth_user']) && !empty($_SESSION['auth_user'])) ? true : false;
}

//$_SESSION内容を破棄
function remove_auth_session():void{
    @session_start();
    if(isset($_SESSION['auth_user'])){
        unset($_SESSION['auth_user']);
    }
}



//リダイレクト処理
function send_redirect(string $url){
    header('location:'.$url);
    exit();
}


//エラー処理
function get_error_msgs():array{
    @session_start();
    $err_msgs = array();
    if(isset($_SESSION['err_msgs'])){
        $err_msgs = $_SESSION['err_msgs'];
        unset($_SESSION['err_msgs']);
    }
    return $err_msgs;
}

//エラーメッセージがあれば、$url　へ移動する
function check_error(array $err_msgs,string $url):void{
    if(count($err_msgs)){
        @session_start();
        $_SESSION['err_msgs'] = $err_msgs;
        send_redirect($url);
    }
}

















