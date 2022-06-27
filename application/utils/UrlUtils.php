<?php
    function getParam($key) { // 쿼리스트링에 있었으면 GET방식으로 아니면 빈값으로
        return isset($_GET[$key]) ? $_GET[$key] : "";
    }
    function getUrl() {
        return isset($_GET['url']) ? rtrim($_GET['url'], '/') : "";
    }
    function getUrlPaths() {
        $getUrl = getUrl();        
        return $getUrl !== "" ? explode('/', $getUrl) : "";
    }

    function getMethod() {
        return $_SERVER['REQUEST_METHOD'];
        // $headers = getallheaders();
        // return $headers['Accept'];
    }

    function isGetOne() {
        $urlPaths = getUrlPaths();
        if(isset($urlPaths[2])) { //one
            return $urlPaths[2];
        }
        return false;
    }