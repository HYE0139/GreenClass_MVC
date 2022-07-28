<?php
/*
    Model : 애플리케이션의 정보, 데이타
    데이타베이스, 처음의 정의하는 상수, 초기화값, 변수 등의
     DATA, 정보들의 가공을 책임지는 컴포넌트
*/
namespace application\models;

use Exception; // 예외처리
use PDO; // Php Data Object : 객체스타일의 API만을 제공

class Model { // MySql 에 접속하여 데이터베이스에 접근
    public function __construct() {
        $dsn = _DBTYPE . ':host=' ._HOST. ';dbname=' . _DBNAME . ';charset=' . _CHARSET;
        try {
            $this->pdo = new PDO($dsn, _DBUSER, _DBPASSWORD);

            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(Exception $e) {
            var_dump("DB 접속 중 에러가 발생하였습니다. :::: " . $e->getMessage());
        }
    }
}