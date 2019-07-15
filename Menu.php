<?php
//case of not login
    include_once './security/security_function.php';
    check_block_user();
    if(!isset($_SESSION['user_email'])) {
?>
    <div class="main-top-before-login">
        <form action="./LoginProcess.php" method="post">
            <input type="email" name="email" class="input-text" placeholder="이메일" required>
            <input type="password" name="password" class="input-text" placeholder="비밀번호" required>
            <input type="submit" value="로그인" class="btn">
            <a href="./Join.php" class="btn">회원가입</a>
            <a href="./Subscription.php" class="btn">구독신청</a>
            <a href="./Notice.php" class="btn">공지사항</a>
            <a href="./HomeMain.php" class="btn">홈페이지</a>
        </form>
    </div>

    <?php 
    //case of loging
    } else {
        $query="select user_email from tbl_payment where user_email='".$_SESSION['user_email']."';";
        $result=$conn->query($query);
        if(!$result) {
            echo "<script>alert('시스템에 장애가 발생하였습니다.');</script>";
            exit();
        } else $row=$result->fetch_assoc();

        $get_user_email=$row['user_email'];

        $query="select level from tbl_user where email='".$_SESSION['user_email']."';";
        $result=$conn->query($query);
        if(!$result) {
            echo "<script>alert('시스템에 장애가 발생하였습니다.');</script>";
            exit();
        } else $row=$result->fetch_assoc();

        $get_user_level=$row['level'];
    ?>

    <div class="main-top-login">
    <?php if($get_user_level <= 1) echo '<a href="./adm/AdminMain.php" class="btn">관리자창</a> '; ?>
        <a href="./HomeMain.php" class="btn">홈페이지</a>
        <a href="./Notice.php" class="btn">공지사항</a>
        <a href="./Mypage.php" class="btn">나의정보</a>
        <a href="./Subscription.php" class="btn">구독신청</a>
        <a href="./Receipt.php" class="btn">결제현황</a>
        <a href="./CustomerCenter.php" class="btn">고객센터</a>
        <a href="./Logout.php" class="btn">로그아웃</a>
    </div>

    <?php
    }
    ?>  
</div>