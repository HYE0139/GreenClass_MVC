<?php
    namespace application\controllers;
    use application\models\UserModel;

    class UserController extends Controller {
        public function join() {
            $this->addAttribute(_TITLE, "회원가입");
            $this->addAttribute(_HEADER, $this->getView("template/header.php"));
            $this->addAttribute(_MAIN, $this->getView("user/join.php"));
            $this->addAttribute(_FOOTER, $this->getView("template/footer.php"));
            
            return "template/t1.php";
        }

        public function joinProc() {

            $param = [
                "uid" => $_POST["uid"],
                "upw" => $_POST["upw"],
                "nm" => $_POST["nm"],
                "gender" => $_POST["gender"],
            ];

            //비밀번호 암호화
            $param["upw"] = password_hash($param["upw"], PASSWORD_BCRYPT);
            $model = new UserModel();
            $model -> insUser($param);
            return "user/login";
        }

        public function login() {
            $this->addAttribute(_TITLE, "로그인");
            $this->addAttribute(_HEADER, $this->getView("template/header.php"));
            $this->addAttribute(_MAIN, $this->getView("user/login.php"));
            $this->addAttribute(_FOOTER, $this->getView("template/footer.php"));
            
            return "template/t1.php";
        }

        public function loginProc() {
            $param = [
                "uid" => $_POST["uid"],
                "upw" => $_POST["upw"],
            ];

            $model = new UserModel();
            $dbUser = $model ->selUser($param);
            if($dbUser === false) {
                echo "<script>alert('없는 아이디입니다');</script>";
                return $this->login();
            } else if(password_verify($pram["upw"], $dbUser->upw)) {
                echo "<script>alert('비밀번호가 다릅니다.');</script>";
                return $this->login();
            }
            flash(_LOGINUSER, $dbUser);
            return "redirect:/board/list";
        }

        public function logout() {
            flash(_LOGINUSER);// $val 보낸 값이 없어서 세션이 끝난다.
            return "redirect:/board/list";
        }
    }