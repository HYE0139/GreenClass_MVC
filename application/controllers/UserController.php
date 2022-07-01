<?php
namespace application\controllers;


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
        $this->addAttribute(_MAIN, $this->getView("user/feedwin.php"));
        return "template/t1.php";
    }

    

   
}