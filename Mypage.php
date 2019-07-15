<!--
    Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.02.26
-->
<?php
    include_once './data/database/conn.php';
    include_once './security/security_function.php';
    check_block_user();
    is_user();

    //get information in gongdori member
    $get_mem_info_query='select chk_pre, end_pre_date from tbl_user where email="'.$_SESSION['user_email'].'";';
    $result=$conn->query($get_mem_info_query);
    if($result) {
        $row=$result->fetch_assoc();
        $chk_pre=$row['chk_pre'];
        $end_pre_date=$row['end_pre_date'];
    }
?>

<!DOCTYPE HTML>
<html lang="kor">
<head>
    <?php include_once 'Header.php'; ?>

</head>
<body>
    <!-- main page start { -->
    <div class="main-frame" style="text-align: center;">
        <?php include_once "Menu.php"; ?>

        <!-- gongdori logo -->
        <div class="gongdori-logo">
            <img src="./data/image/gongdori-logo-200.png">
        </div>
        
        <div class="member-table">
            <p><span class='subscription-title'>회원정보수정</span></p>
            <form action="./ModifyProcess.php" method="post">
                <p><input type="email" class="input-text" value="<?php echo $_SESSION['user_email']; ?>" readonly></p>
                <p><input type="password" name="password" class="input-text" placeholder="비밀번호" required></p>
                
                <p><span class='subscription-title'>구독마감일자</span></p>
                <?php if($chk_pre==1) {?>
                <p style="margin-bottom: 60px;"><?php echo date("Y년m월d일 H시i분s초", $end_pre_date); ?></p>
                <?php }else if($chk_pre==0) { ?>
                    <p style="margin-bottom: 60px;">미구독자</p>
                <?php } ?>
                <p><input type="submit" value="정보수정" class="btn"> <a href="./HomeMain.php" class="btn">돌아가기</a></p>
            </form>
        </div>
    </div>
    <!-- } main page end -->

</body>
</html>

<?php $conn->close(); ?>