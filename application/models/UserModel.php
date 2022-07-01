<?php
namespace application\models;
use PDO;


//$pdo -> lastInsertId();

class UserModel extends Model {
    public function insUser(&$param) {
        $sql = "INSERT INTO t_user
                ( email, pw, nm ) 
                VALUES 
                ( :email, :pw, :nm )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":email", $param["email"]);
        $stmt->bindValue(":pw", $param["pw"]);
        $stmt->bindValue(":nm", $param["nm"]);
        $stmt->execute();
        return $stmt->rowCount();

    }
    public function selUser(&$param) {
        $sql = "SELECT * FROM t_user
                WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":email", $param["email"]);        
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function selUserProfile(&$param) {
        $feediuser = $param["feediuser"];
        $loginiuser = $param["loginiuser"];
        $sql = "SELECT iuser, email, nm, cmt, mainimg
		              ,(SELECT COUNT(ifeed) FROM t_feed WHERE iuser = {$feediuser}) AS feedcnt
                      ,(SELECT COUNT(fromiuser) FROM t_user_follow WHERE fromiuser = {$feediuser} AND toiuser = {$loginiuser}) AS follower
		              ,(SELECT COUNT(fromiuser) FROM t_user_follow WHERE fromiuser = {$loginiuser} AND toiuser = {$feediuser}) AS following
                  FROM t_user
                 WHERE iuser = {$feediuser}";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function updUser(&$param) {
        $sql = "UPDATE t_user SET nm = :nm, cmt = :cmt WHERE iuser = :iuser";
        $stmt = $this->pdo->prepare($sql);
        $stmt -> execute(array($param['nm'], $param['cmt'], $param['iuser']));
        return $stmt->fetch(PDO::FETCH_OBJ);

    }
    
}