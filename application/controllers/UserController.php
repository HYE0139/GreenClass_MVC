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
                $param = ["email" => $email, "pw" => $pw ];
                $dbUser = $this-> model-> selUser($param);

            if(!$dbUser || !password_verify($pw, $dbUSer->pw)) {
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
            case _GET : // 로그인
                return "user/signup.php";
            case _POST : //회원가입
                $param = [
                    "email" => $_POST["email"],
                    "pw" => $_POST["pw"],
                    "nm" => $_POST["nm"],
                ];
                $param["pw"] = password_hash($param["pw"], PASSWORD_BCRYPT);
                $this-> model-> insUser($param);
                return "redirect:signin";
        }
    }
}