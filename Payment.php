<!--
    Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.02.27.
-->

<?php
    include_once './data/database/conn.php';
    include_once './security/security_function.php';
    check_block_user();
    is_user();

    $query="select user_email from tbl_payment where user_email='".$_SESSION['user_email']."';";
    $result=$conn->query($query);
    if(!$result) {
    echo "<script>alert('시스템에 장애가 발생하였습니다.');</script>";
    exit();
    
    }else {
        $row=$result->fetch_assoc();
        $get_user_email=$row['user_email'];
    }

    //is premium check
    $query="select chk_pre from tbl_user where email='".$_SESSION['user_email']."';";
    $result=$conn->query($query);
    if($result) {
        $row=$result->fetch_assoc();
        $chk_pre=$row['chk_pre'];
    }else {
        echo "<script>alert('구독중인 회원인지에 대한 정보를 가져오지 못했습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=Subscription.php'>";
        exit();
    }

    if($chk_pre==1) {
        echo "<script>alert('이미 구독을 진행중이시므로 신청하실 수 없습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=Subscription.php'>";
        exit();
    }

    if(!isset($_GET['goods_option'])) {
        echo "<script>alert('구독신청에 필요한 정보가 전달되지 않았습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";
        exit();
    }
    if(!($_GET['goods_option'] >= 1 && $_GET['goods_option'] <= 3)) {
        echo "<script>alert('구독신청에 필요한 정보가 조작되어 전달되었습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";
        exit();
    }
    if(!(strcmp($_SESSION['user_email'], $get_user_email) && $get_user_email === NULL)) {
        echo "<script>alert('새로 구독신청을 하고 싶으시다면 신청하셨던 구독신청을 철회해주셔야 합니다. 결제현황 메뉴에서 철회하실 수 있습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";
        exit();
    }

    //goods information setting
    $query="select * from tbl_price where goods_option=".$_GET['goods_option'].";";
    $result=$conn->query($query);

    if($result) {
        $row=$result->fetch_assoc();
        $option=$row['goods_option'];
        $title=$row['title'];
        $price=$row['price'];
    }

    //bank information setting
    $query="select * from tbl_bank;";
    $result=$conn->query($query);
    $row=$result->fetch_assoc();
    if(!$result) { 
        echo "<script>alert('시스템 문제로 은행정보를 불러오는데 실패하였습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";
        exit();
    }else {
        $bank_name=$row['bank_name'];
        $account_name=$row['account_name'];
        $account_number=$row['account_number'];
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
        
        <div class="bank-info-table">
            <p><span class='subscription-title'><?php echo $title; ?></span></p>
            <form action="./PayProcess.php" method="post">
                <input type="hidden" name="option" value="<?php echo $option; ?>">
                <p><input type="text" name="user_name" class="input-text" placeholder="입금자명" required></p>
                <p><input type="text" name="user_phone" class="input-text" placeholder="휴대폰번호" required></p>
                <div class="subscription-bank-info">
                    <p style="margin-bottom: 30px;"><span class="subscription-title">무통장입금 결제</span></p>
                    <p><span class="subscription-content"><?php echo $bank_name." <strong>".$account_name."</strong>"; ?></span></p>
                    <p><span class="subscription-content" style="letter-spacing:0.1em;"><?php echo $account_number; ?></span></p>
                    <p><span class="subscription-content" style="letter-spacing:0.1em;"><?php echo $price; ?>원</span></p>
                    <p><input type="checkbox" name="chkcash" value="1" style="width: 14px; height: 14px;"><span class="subscription-content" style="font-size: 1em;">현금영수증 신청</span></p>
                </div>
                <p><input type="submit" value="구독신청" class="btn"> <a href="./HomeMain.php" class="btn">돌아가기</a></p>
            </form>
        </div>
    </div>
    <!-- } main page end -->

</body>
</html>

<?php $conn->close(); ?>