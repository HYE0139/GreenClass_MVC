<?php
    
    namespace application\controllers; 
    use application\models\BoardModel;

    class BoardController extends Controller{ //Controller.php
        public function list() {
            $model = new BoardModel();
            $page = 1;
            if(isset($_GET["page"])) {       
                $page = intval($_GET["page"]);
            }
            $rowCount = 20;
            $param = [
                "rowCount" => $rowCount,
                "startIdx" => ($page - 1) * $rowCount
            ];
            //$list = $model->selBoardList();
            $this->addAttribute("list", $model->selBoardList($param));
            $this->addAttribute("data", $page);
            $this->addAttribute("data", $model->pagingCount($param));
            $this->addAttribute("js", ["board/list"]);
            $this->addAttribute("css", ["common"]);
            $this->addAttribute(_TITLE, "리스트");
            $this->addAttribute(_HEADER, $this->getView("template/header.php"));
            $this->addAttribute(_MAIN, $this->getView("board/list.php"));
            $this->addAttribute(_FOOTER, $this->getView("template/footer.php"));
            
            return "template/t1.php"; //view 파일명.
            
        }

        public function write() {
    
            $this->addAttribute(_TITLE, "글쓰기");
            $this->addAttribute(_HEADER, $this->getView("template/header.php"));
            $this->addAttribute(_MAIN, $this->getView("board/write.php"));
            $this->addAttribute(_FOOTER, $this->getView("template/footer.php"));

            return "template/t1.php";
        }

        public function writeProc() {
            
            $param = [
                "i_user" =>$_SESSION[_LOGINUSER]->i_user,
                "title" =>$_POST["title"],
                "ctnt" =>$_POST["ctnt"],
            ];

            $model = new boardModel();
            $model -> insboard($param);
            return "redirect:/board/list";
        }

        public function detail() {
            $i_board = $_GET["i_board"];

            $model = new BoardModel();
            $param = ["i_board" => $i_board];
            $this -> addAttribute("data", $model->selBoard($param));
            $this->addAttribute("js", ["board/detail"]);
            $this->addAttribute(_TITLE, "게시글");

            return "board/detail.php";
           

        }

        public function del() {
            $i_board = $_GET["i_board"];

            $model = new BoardModel();
            $param = ["i_board" => $i_board];
            $model->delBoard($param);
            
            return "redirect:/board/list";
        }

        public function mod() {
            $i_board = $_GET["i_board"];

            $model = new BoardModel();
            $param = ["i_board" => $i_board];

            $this -> addAttribute("data", $model->selBoard($param));

            $this->addAttribute(_TITLE, "게시글 수정");
            $this->addAttribute(_HEADER, $this->getView("template/header.php"));
            $this->addAttribute(_MAIN, $this->getView("board/mod.php"));
            $this->addAttribute(_FOOTER, $this->getView("template/footer.php"));

            return "template/t1.php";
        }

        public function modProc() {
            $i_board = $_POST["i_board"];
            $title = $_POST["title"];
            $ctnt = $_POST["ctnt"];

            $model = new BoardModel();
            $param = ["i_board" => $i_board, "title" => $title, "ctnt" => $ctnt];
            $this -> addAttribute("data", $model->updBoard($param));

            return "redirect:/board/detail?i_board=${i_board}";
        }

       
    }