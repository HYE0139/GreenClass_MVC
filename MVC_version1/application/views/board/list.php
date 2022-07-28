
    <h1>리스트</h1>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>제목</th>
                <th>작성일</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($this->list as $item) { ?>
                <tr data-iboard="<?=$item->i_board?>">
                    <td><?=$item->i_board?></td>
                    <td><?=$item->title?></td>
                    <td><?=$item->created_at?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
    <?php  for($i=1; $i<=$this->data->cnt; $i++) { ?>
        <span class="<?=$i===$this->page ? "pageSelected" : ""?>">
            <a href="list?page=<?=$i?>"><?=$i?></a>
        </span>
    <?php }  ?>
    

