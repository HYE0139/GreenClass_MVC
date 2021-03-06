<?php
namespace application\controllers;
use application\libs\Application;;

class UserController extends Controller {
    public function signin() {
        switch(getMethod()) {
            case _GET :
                return "user/signin.php";
            case _POST : 
                $email = $_POST["email"];
                $pw = $_POST["pw"];
                $param = ["email" => $email];
                $dbUser = $this-> model-> selUser($param);

            if(!$dbUser || !password_verify($pw, $dbUser->pw)) {
                return "redirect:signin?email={$email}&err";
            }
            $dbUser->pw = null; // 비밀번호 유출을 막기 위해 null값을 세션에 넣는다.
            $dbUser->regdt = null; // created_at ...메모리 사용을 줄이기 위해 필요없는 부분은 삭제
            $this->flash(_LOGINUSER, $dbUser); 
            return "redirect:/feed/index";
        }
    }

    public function signup() {
        switch(getMethod()) {
            case _GET:
                return "user/signup.php";
            case _POST:
                $email = $_POST["email"];
                $pw = $_POST["pw"];
                $hashedPw = password_hash($pw, PASSWORD_BCRYPT);
                $nm = $_POST["nm"];
                $param = [
                    "email" => $email,
                    "pw" => $hashedPw,
                    "nm" => $nm
                ];

                $this->model->insUser($param);

                return "redirect:signin";
        }
    }

    public function logout() {
        $this->flash(_LOGINUSER);
        return "redirect:/user/signin";
    }

    public function feedwin() {
        $iuser = isset($_GET["iuser"]) ? intval($_GET["iuser"]) : 0;
        $param = [ "feediuser" => $iuser, "loginiuser" => getIuser() ];
        $this->addAttribute(_DATA, $this->model->selUserProfile($param));
        
        $this->addAttribute(_JS, ["user/feedwin", "https://unpkg.com/swiper@8/swiper-bundle.min.js"]);
        $this->addAttribute(_CSS, ["user/feedwin", "https://unpkg.com/swiper@8/swiper-bundle.min.css", "feed/index"]);        
        $this->addAttribute(_MAIN, $this->getView("user/feedwin.php"));
        return "template/t1.php"; 
    }

    public function feed() {
        if(getMethod() === _GET) {    
            $page = 1;
            if(isset($_GET["page"])) {
                $page = intval($_GET["page"]);
            }
            $startIdx = ($page - 1) * _FEED_ITEM_CNT;
            $param = [
                "startIdx" => $startIdx,
                "toiuser" => $_GET["iuser"],
                "loginiuser" => getIuser()
            ];        
            $list = $this->model->selFeedList($param);
            foreach($list as $item) {         
                $param2 = [ "ifeed" => $item->ifeed ];       
                $item->imgList = Application::getModel("feed")->selFeedImgList($param2);
                $item->cmt = Application::getModel("feedcmt")->selFeedCmt($param2);

            }
            return $list;
        }
    }

    public function follow() {
        $param = [
            'fromiuser' => getIuser()
        ];

        switch (getMethod()) {
            case _POST:
                $json = getJson();
                $param["toiuser"] = $json["toiuser"];
                return [_RESULT => $this->model->insFollow($param)];

            case _DELETE:
                $param["toiuser"] = $_GET["toiuser"];
                return [_RESULT => $this->model->delFollow($param)];
        }
    }

    public function profile() {
        switch(getMethod()) {
            case _DELETE :
                $loginUser = getLoginUser();
                if($loginUser && $loginUser->mainimg !== null) {
                    $path = "static/img/profile/{$loginUser->iuser}/{$loginUser->mainimg}";
                    if(file_exists($path) && unlink($path)) {
                        $param = ["iuser" => $loginUser->iuser, "delMainImg" => 1];
                        if($this->model->upUser($param)) {
                            rmdir("static/img/profile/{$loginUser->iuser}");
                            $loginUser->mainimg = null;
                            return [_RESULT => 1];
                        }
                    }
                }
            case _POST :
                if(!is_array($_FILES) || !isset($_FILES["imgs"])) {
                    return ["result" => 0];
                }
                
                $iuser = getLoginUser()->iuser;
                $saveDirectory = _IMG_PATH . "/profile/" . $iuser; 
                    if(!is_dir($saveDirectory)) {
                        mkdir($saveDirectory, 0777, true); 
                    }
                $profilePic = $_FILES["imgs"]["name"];
                $tempName = $_FILES["imgs"]["tmp_name"];
                $randomProfile = getRandomFileNm($profilePic);
                if(move_uploaded_file($tempName, $saveDirectory. "/".$randomProfile)) {
                   if(getMainImgSrc()) {
                        $saved_img = "static/img/profile/".getMainImgSrc();
                        if(file_exists($saved_img)) {   
                            unlink($saved_img);
                        }
                   }
                   
                   $param = [
                        "iuser" => $iuser,
                        "mainimg" => $randomProfile
                   ]; 
                    if($this->model->upUser($param)) {
                        getLoginUser()->mainimg = $randomProfile;
                        return [_RESULT => 1];
                    }
                }
            
            return [_RESULT => 0];

        }
    }

}