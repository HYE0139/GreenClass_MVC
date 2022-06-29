<?php
namespace application\controllers;

class FeedController extends Controller {
    public function index() {
        $this -> addAttribute(_MAIN, $this->getView("feed/index.php"));
        $this -> addAttribute(_JS, ["feed/index"]);
        $this -> addAttribute(_CSS, ["feed/index"]);
        return "template/t1.php";
    }

    public function rest() {
        switch(getMethod()) {
            case _POST:
                if(!is_array($_FILES) || !isset($_FILES["imgs"])) {
                    return ["result" => 0];
                }
                
                $param = [
                    "location" => $_POST["location"],
                    "ctnt" => $_POST["ctnt"],
                    "iuser" => getIuser()//SessionUtils
                ];

                $ifeed = $this-> model-> insFeed($param);
                
                foreach($_FILES["imgs"]["name"] as $key => $originFileNm) {
                    // $file_name = explode(".", $value); =>  이미지 파일 이름을 '.' 기준 배열로 반환
                    // $ext = end($file_name);  => 배열의 마지막 = 확장자
                    $saveDirectory = _IMG_PATH . "/feed/" . $ifeed; // 이미지 저장경로
                    if(!is_dir($saveDirectory)) {
                        mkdir($saveDirectory, 0777, true); //디렉토리 생성
                    }
                    
                    $tempName = $_FILES["imgs"]["tmp_name"][$key]; // FileUtils
                    $randomImg = getRandomFileNm($originFileNm);
                    if(move_uploaded_file($tempName, $saveDirectory. "/".$randomImg)) {
                        $param = ["feedImg" => $randomImg, "ifeed" => $ifeed];
                        $this-> model-> insFeedImg($param);
                    }
                }
                return ["result" => 1];
            case _GET :
                $page = 1;
                if(isset($_GET["page"])) {
                    $page = intval($_GET["page"]);
                }
                $startIdx = ($page - 1) * _FEED_ITEM_CNT;
                $param = [
                    "startIdx" => $startIdx,
                    "iuser" => getIuser()
                ];
                $list = $this->model->selFeedList($param);
                foreach($list as $item) {
                    $imgs = $this->model ->selFeedImgList($item);
                    $item->imgList = $imgs;
                }
                return $list;
        }
    }
}