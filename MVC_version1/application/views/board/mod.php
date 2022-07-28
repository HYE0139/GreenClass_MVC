<div>
    <h1>수정</h1>
    <form action="modProc" method="post">
        <input type="hidden" name="i_board" value="<?=$this->data->i_board?>">
        <div> 제목 : <input type="text" name="title" value="<?=$this->data->title?>" style="width:300px;"></div>
        <textarea name="ctnt" style="width:400px; height:300px;"><?=$this->data->ctnt?></textarea>
        <div>
            <input type="submit" value="완료">
        </div>    
    </form>
</div>