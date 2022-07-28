<?php
/* 
    controller는 model을 통해서 데이터를 가져오고 그 정보를 바탕으로
    시각적인 표현을 담당하는 View를 제어해서 사용자에게 전달한다.
    => 데이터와 사용자인터페이스 요소들을 잇는 다리역할
*/
namespace application\controllers; //내부 식별자에 사용될 수 있는 유효범위
include_once "application/utils/SessionUtils.php";

abstract class Controller { // 각각의 파일로 접근
    public function __construct($action) {        
        $view = $this->$action();
        require_once $this->getView($view); 
    }
    
    protected function addAttribute($key, $val) {
        $this->$key = $val;
    }

    protected function getView($view) {
        if(strpos($view, "redirect:") === 0) { // 0은 해당 문자열의 인덱스 위치
            header("Location: " . substr($view, 9));
            return;
            //BoardController.php 에서 함수 실행 후 이동하는 주소값에
            //redirect라는 문자열이 가장 처음에 적혀있는지 확인
        }
        return _VIEW . $view;
    }
}

