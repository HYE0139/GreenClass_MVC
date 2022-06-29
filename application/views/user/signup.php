<!DOCTYPE html>
<html lang="en">
<?php include_once "application/views/template/head.php"; ?>
<body class="container-center">
    <div>
        <h1>회원가입</h1>
        <a href="signin">로그인</a>
        <form action="signup" method="post">
            <div><input type="email" name="email" placeholder="email" autofocus required></div>
            <div><input type="password" name="pw" placeholder="password" required></div>
            <div><input type="txet" name="nm" placeholder="name" required></div>
            <div>
                <input type="submit" value="가입하기">
            </div>
        </form>
    </div>
</body>
</html>