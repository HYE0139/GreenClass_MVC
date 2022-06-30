<?php
    namespace application\models;
    use PDO;

    class FeedModel extends Model {
        public function insFeed(&$param) {
            $sql = "INSERT INTO t_feed
                    (location, ctnt, iuser)
                    VALUES
                    (:location, :ctnt, :iuser)
            ";

            $stmt= $this->pdo->prepare($sql);
            $stmt -> execute(array($param["location"],$param["ctnt"],$param["iuser"]));
            return intval($this->pdo->lastInsertId());
        }

        public function insFeedImg(&$param) {
            $sql = "INSERT INTO t_feed_img
                    (ifeed, img)
                    VALUES
                    (:ifeed, :feedImg)
            ";

            $stmt = $this->pdo->prepare($sql);
            $stmt -> execute(array( $param["ifeed"], $param["feedImg"]));
            
        }

        public function selFeedList(&$param) {
            $sql = "SELECT A.ifeed, A.location, A.ctnt, A.iuser, A.regdt
                         , C.nm AS writer, C.mainimg
                         , IFNULL(E.cnt, 0) AS favCnt
                         , IF(D.ifeed IS NULL, 0, 1) AS isFav
                      FROM t_feed A
                INNER JOIN t_user C 
                        ON A.iuser = C.iuser
                 LEFT JOIN
                        (
                            SELECT ifeed, COUNT(ifeed) AS cnt
                              FROM t_feed_fav
                          GROUP BY ifeed
                        ) E
                        ON A.ifeed = E.ifeed
                 LEFT JOIN
                        (
                            SELECT ifeed, COUNT(ifeed) AS isFav
                              FROM t_feed_fav
                             WHERE iuser = :iuser
                          GROUP BY ifeed
                        ) D
                        ON A.ifeed = D.ifeed
                  ORDER BY A.ifeed DESC
                     LIMIT :startIdx, :feedItemCnt;
            ";
            $stmt = $this ->pdo ->prepare($sql);
            $stmt -> execute(array( $param["iuser"], $param["startIdx"], _FEED_ITEM_CNT));
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        // 유저가 올린 feed의 이미지
        public function selFeedImgList($param) {
            $sql = "SELECT img FROM t_feed_img WHERE ifeed = :ifeed";
            $stmt = $this ->pdo ->prepare($sql);
            $stmt -> execute(array($param->ifeed));

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        // Fav(좋아요)
        public function insFeedFav(&$param) {
            $sql = "INSERT INTO t_feed_fav
                    (ifeed, iuser)
                    VALUES
                    (:ifeed, :iuser)
            ";

            $stmt = $this -> pdo ->prepare($sql);
            $stmt -> execute(array($param["ifeed"], $param["iuser"]));
            return $stmt ->rowCount();
        }

        public function delFeedFav(&$param) {
            $sql = "DELETE FROM t_feed_fav WHERE ifeed = :ifeed AND iuser = :iuser";
            $stmt = $this ->pdo ->prepare($sql);
            $stmt ->execute(array($param["ifeed"], $param["iuser"]));
            return $stmt ->rowCount();
        }
    }