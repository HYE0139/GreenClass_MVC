<?php
namespace application\libs;

require_once "application/utils/UrlUtils.php";
require_once "application/utils/SessionUtils.php";
require_once "application/utils/FileUtils.php";

class Application{
    
    public $controller;
    public $action;
    private static $modelList = [];
    // Application 객체와 직접적인 관계는 없음
    // 다만, 접근하기 위해선 Application 객체를 통해 접근가능

    public function __construct() {        
        $urlPaths = getUrlPaths();//url 주소값들을 배열로 저장한 함수
        $controller = isset($urlPaths[0]) && $urlPaths[0] != '' ? $urlPaths[0] : 'board';
        $action = isset($urlPaths[1]) && $urlPaths[1] != '' ? $urlPaths[1] : 'index';

        if (!file_exists('application/controllers/'. $controller .'Controller.php')) {
            echo "해당 컨트롤러가 존재하지 않습니다.";
            exit();
        }

        $controllerName = 'application\controllers\\' . $controller . 'controller';                
        $model = $this->getModel($controller);
        new $controllerName($action, $model);
    }
    // static : 공통으로 값을 유지하고 싶을 떄 인스턴스 생성 없이 바로 사용.
    public static function getModel($key) {
        if(!in_array($key, static::$modelList)) {
            $modelName = 'application\models\\' . $key . 'model';
            static::$modelList[$key] = new $modelName();
        }
        return static::$modelList[$key];
    }
}
