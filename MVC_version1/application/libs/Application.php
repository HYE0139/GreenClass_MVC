<?php
    namespace application\libs;

    class Application{
        
        public $controller;
        public $action;

        public function __construct() {
            $getUrl = ''; // url = localhost/뒤에 입력된 주소 ex) borad/list
            if (isset($_GET['url'])) {
                $getUrl = rtrim($_GET['url'], '/'); // rtrim() : 문자열 왼쪽의 반복적인 문자를 제거
                $getUrl = filter_var($getUrl, FILTER_SANITIZE_URL); //filter_var : 필터링된 데이터를 반환
                // FILTER_SANITIZE_URL : 모든 불법 URL 문자열 문자를 제거
            }        
            $getParams = explode('/', $getUrl); // '/'를 기준으로 분할하여 배열로 저장
            $controller = isset($getParams[0]) && $getParams[0] != '' ? $getParams[0] : 'board'; //첫번째 주소
            $action = isset($getParams[1]) && $getParams[1] != '' ? $getParams[1] : 'index'; //두번째주소

            if (!file_exists('application/controllers/'. $controller .'Controller.php')) {
                echo "해당 컨트롤러가 존재하지 않습니다."; // ^ 경로가 아닌 namespace
                // file_exists : 파일존재유무, 첫번째 주소와 동일한 controller.php 파일을 확인 
                exit();
            }
            $controllerName = 'application\controllers\\' . $controller . 'controller';        
            new $controllerName($action);
        }
    }