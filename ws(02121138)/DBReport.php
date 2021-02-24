<?php

require_once('DBConnect.php');
class DBReport extends DBConnect{

    public function __construct(){
        parent::getDbh();
    }

    //日報データ保存
    public function store(array $report):bool{
        $sql = 'INSERT into report (userid,report_body) VALUES (:userid,:report_body)';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':userid',$report['userid'],PDO::PARAM_STR);
        $stmt->bindParam(':report_body',$report['report_body'],PDO::PARAM_STR);
        return $flag = $stmt->execute();
    }

    //日報データ取得
    public function get_report_all():?array{
        $sql = 'SELECT * FROM report';
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchall();
        return (!empty($result)) ? $result: null;
    }

    //日報データ詳細取得
    public function get_report_byid($id):?array{
        $sql = 'SELECT * FROM report WHERE id = :id';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':id',$id,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        return (!empty($result)) ? $result: null;
    }

    // 承認の承認、非承認を更新
    public function update_approval(string $approval,string $userid):bool{
        $sql = "UPDATE report SET approval = :approval WHERE id = :userid";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':approval',$approval,PDO::PARAM_STR);
        $stmt->bindParam(':userid',$userid,PDO::PARAM_STR);
        return $result = $stmt->execute();
    }

    // レポートの承認ステータスを更新
    public function approval(string $approval,string $id):bool{
        $sql = "UPDATE report SET approval = :approval WHERE id = :id";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':approval',$approval,PDO::PARAM_STR);
        $stmt->bindParam(':id',$id,PDO::PARAM_STR);
        return $result = $stmt->execute();
        }




}