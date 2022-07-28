<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "application/views/template/head.php";?>
</head>
<body>
    <h1>디테일</h1>
    <button id="btnDel" data-iboard="<?=$this->data->i_board?>">삭제</button>
    <?php if(isset($_SESSION[_LOGINUSER]) && $this->data->i_user == $_SESSION[_LOGINUSER]->i_user) { ?>
    <a href="mod?i_board=<?=$this->data->i_board?>"><button>수정</button></a>
    <?php } ?>
   
    <div>

        <div>제목 : <?=$this->data->title?></div>
        <div>작성자 : <?=$this->data->nm?></div>
        <div>내용 : <?=$this->data->ctnt?></div>
        <div>작성일 : <?=$this->data->created_at?></div>
    </div>


</body>
</html>