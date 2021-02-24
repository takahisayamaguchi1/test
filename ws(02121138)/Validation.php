<?php

//ユーザー登録
class Validation{
    private $userid;
    private $password;
    private $username;
    private $error_array;

    public function __construct(array $user){
        $this->userid = $user['userid'];
        $this->password = $user['password'];
        $this->username = $user['username'];
        $this->error_array = array();
    }

    public function validate():array{
        //ユーザー登録内容をチェック
        if( mb_strlen($this->userid)<=0 || mb_strlen($this->userid)>10)       array_push($this->error_array,'IDは10文字以内で入力してください');
        if( mb_strlen($this->password)<=0 || mb_strlen($this->password)>20)   array_push($this->error_array,'パスワードは20文字以内で入力してください');
        if( mb_strlen($this->username)<=0 || mb_strlen($this->username)>20)  array_push($this->error_array,'名前は20文字以内で入力してください');
        return $this->error_array;
    }
}

// 日報
class Report_Validation{
    private $report_body;
    private $error_array;

    public function __construct(array $report){
        $this->report_body = $report['report_body'];
        $this->error_array = array();
    }

    public function validate():array{
        //レポート内容をチェックする
        if(mb_strlen($this->report_body)<30)  array_push($this->error_array,'30文字以上は入力してください');
        if(mb_strlen($this->report_body)>600)  array_push($this->error_array,'日報は600文字以内で入力してください');
        return $this->error_array;
    }
}

?>
