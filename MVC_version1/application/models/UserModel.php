<?php
    namespace application\models;
    use PDO;

    class UserModel extends Model {
        public function insUser($param) {
            $sql = "INSERT INTO t_user
                    (uid, upw, nm, gender)
                    VALUES
                    (:uid, :upw, :nm, :gender)
                    ";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':uid', $param["uid"]);
            $stmt->bindValue(':upw', $param["upw"]);
            $stmt->bindValue(':nm', $param["nm"]);
            $stmt->bindValue(':gender', $param["gender"]);
            $stmt->execute();
        }

        public function selUser($param) {
            $sql = "SELECT *
                      FROM t_user
                     WHERE uid = :uid";
                     
             $stmt = $this->pdo->prepare($sql);
             $stmt->bindValue(":uid", $param["uid"]);
             $stmt->execute();

             return $stmt->fetch(PDO::FETCH_OBJ);
        }
    }