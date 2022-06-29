<?php
namespace application\controllers;

class Controller {    
    protected $model;
    private static $needLoginUrlArr = ["feed"]; //주소값 feed에 접근하려면 로그인이 필요

    public function __construct($action, $model) {    
        if(!isset($_SESSION)) {
            session_start();
        }    
        $urlPaths = getUrl(); // UrlUtils
        foreach(static::$needLoginUrlArr as $url) {
            if(strpos( $urlPaths, $url) === 0 && !isset($_SESSION[_LOGINUSER]) ) {
                //echo "권한이 없습니다.";
                //exit(); 주소로 접근하려고 하면 signin 페이지로 대신 이동함
                $this->getView("redirect:/user/signin");
            }
        }

        $this->model = $model;
        $view = $this->$action(); //string 값이 비어있을 때 오류
        if(empty($view) && gettype($view) === "string" ) {
            echo "Controller 에러 발생";
            exit();
        }

        if(gettype($view) === "string") {
            require_once $this->getView($view);             
        } else if(gettype($view) === "object" || gettype($view) === "array") { // $view 에 객체나 배열이 저장되면
            header("Content-Type:application/json"); // JSON(배열,객체를 보여주는 화면)으로 넘어간다.
            echo json_encode($view);
        }        
    }
    private function chkLoginUrl() {

    }
    
    protected function addAttribute($key, $val) {
        $this->$key = $val;
    }

    protected function getView($view) {//주소
        if(strpos($view, "redirect:") === 0) {
            header("Location: " . substr($view, 9));
            exit();
        }
        return _VIEW . $view;
    }

    protected function flash($name = '', $val = '') {
        if(!empty($name)) { //$name 값을 받아오고
            if(!empty($val)) { //$val 값도 받아왔다면!
                $_SESSION[$name] = $val; // 세션이 만들어진다.
            } else if(empty($val) && !empty($_SESSION[$name])) {
                unset($_SESSION[$name]); // 받아온 값이 다 없다면 세션이 내려감
            }
        }
    }
}