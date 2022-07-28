<?php // 
    spl_autoload_register(function ($path) {
        $path = str_replace('\\','/',$path);//문자열바꾸기 (대상문자, 변경할 문자, 문자열)
        $paths = explode('/', $path);// 문자열 분할 후 배열로 반환(분할기준, 문자열)
        if (preg_match('/model/', strtolower($paths[1]))) { //문자열을 소문자로 바꾸고 대상 문자열 검색
            $className = 'models'; 
        } else if (preg_match('/controller/',strtolower($paths[1]))) {
            $className = 'controllers';
        } else {
            $className = 'libs';
        }

        $loadpath = $paths[0].'/'.$className.'/'.$paths[2].'.php';
        
       // echo 'autoload $path : ' . $loadpath . '<br>';
        
        if (!file_exists($loadpath)) {
            echo " --- autoload : file not found. ($loadpath) ";
            exit();
        }
        require_once $loadpath;
    });
