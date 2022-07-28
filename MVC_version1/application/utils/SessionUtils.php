<?php
    if(!isset($_SESSION)) {
        session_start();
    }

    function flash($name = '', $val = '') {
        if(!empty($name)) { // name 이 공백이 아니고
            if(!empty($val)){ // val도 공백이 아니면 => 값이 있다면
                $_SESSION[$name] = $val; // 세션 실행
            } else if(empty($val) && !empty($_SESSION[$name])) {
                //val비어있고 name이 공백이 아닌경우
                unset($_SESSION[$name]); // 세션을 끝낸다.
            }
        }
    }