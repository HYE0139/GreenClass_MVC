<?php
namespace application\controllers;


class UserController extends Controller {
    public function signin() {
        switch(getMethod()) {
            case _GET :
                return "user/signin.php";
            case _POST : 
                $email = $_POST["email"];
                $param = ["email" => $email, "pw" => $_POST["pw"]];
                $dbUser = $this-> model-> selUser($param);

            if(!$dbUser || !password_verify($param["pw"], $dbUSer->pw)) {
                return "redirect:signin?email={$email}&err";
            } 
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