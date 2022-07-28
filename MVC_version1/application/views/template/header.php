<div>
    <?php if(isset($_SESSION[_LOGINUSER])) { ?>
            <div><?=$_SESSION[_LOGINUSER]->nm?> 님, 환영합니다.</div>
            <a href="/board/write">Write</a>
            <a href="/user/logout">Logout</a>
    <?php } else { ?>
        <a href="/user/login">SingIn</a>
        <a href="/user/join">SingUp</a>
    <?php } ?>
    <a href="/board/list">List</a>
        
</div>