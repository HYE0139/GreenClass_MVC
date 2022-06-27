<!DOCTYPE html>
<html lang="en">
<?php include_once "application/views/template/head.php"; ?>
<body class="h-full container-center">
    <div>
        <h1>로그인</h1>
        <div class = "err">
            <?php
                if(isset($_GET["err"])) {
                    echo "로그인을 할 수 없습니다.";
                }
            ?>
        </div>
        <form action="signin" method="post"> <!--getParam : UrlUtils 에서 만든 메소드, 겟방식으로 받아온 값이 있으면 value에 값을 남긴다.-->
            <div><input type="email" name="email" placeholder="email" value="<?=getParam('email')?>" autofocus required></div>
            <div><input type="password" name="pw" placeholder="password" required></div>
            <div>
                <input type="submit" value="로그인">
            </div>
        </form>
        <div>
            <a href="signup">회원가입</a>
        </div>
    </div>
</body>
</html>