<?php
    namespace application\models;
    use PDO;

    class BoardModel extends Model {//Model.php 의 Model 클래스를 참조 < 데이터베이스에 접근하는 클래스
        public function selBoardList($param) {
            $sql = " SELECT i_board, title, ctnt, created_at
                       FROM t_board
                   ORDER BY i_board DESC
                   LIMIT :startIdx, :rowCount";
            $stmt = $this->pdo->prepare($sql); // 데이터베이스에 구문 삽입
            $stmt->bindValue(':startIdx', $param["startIdx"]);
            $stmt->bindValue(':rowCount', $param["rowCount"]);
            $stmt->execute(); // sql 구문 실행
            return $stmt->fetchAll(PDO::FETCH_OBJ); // 배열 레코드를 익명객체로 가져온다.
        }

        public function insBoard($param) {
            $sql = "INSERT INTO t_board
                    (title, ctnt, i_user)
                    VALUES
                    (?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(array($param["title"], $param["ctnt"], $param["i_user"]));
            
        }

        public function selBoard($param) { //BoardController.php > detail()
            $sql = "SELECT A.i_board, A.title, A.ctnt, A.created_at
                         , B.i_user, B.nm
                      FROM t_board A
                INNER JOIN t_user B
                        ON A.i_user = B.i_user
                     WHERE A.i_board = :i_board";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':i_board', $param["i_board"]);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function updBoard($param) {
            $sql = "UPDATE t_board
                       SET title = :title
                           , ctnt = :ctnt
                     WHERE i_board = :i_board";

            $stmt = $this->pdo->prepare($sql);   
            $stmt->bindValue(':i_board', $param["i_board"]);
            $stmt->bindValue(':title', $param["title"]);
            $stmt->bindValue(':ctnt', $param["ctnt"]);
            $stmt->execute();     
        }

        public function delBoard($param) {
            $sql = "DELETE FROM t_board
                          WHERE i_board = :i_board";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':i_board', $param["i_board"]);
            $stmt->execute();
        }
// 리스트 페이징, 게시글 next-prev
        public function pagingCount($param) {    
            $sql = "SELECT CEIL(COUNT(i_board) / :rowCount) as cnt
                      FROM t_board";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':rowCount', $param["rowCount"]);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
            

        }

        
    }