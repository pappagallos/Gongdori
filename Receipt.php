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

    //get member information
    $query="select user_email, user_pay_name, pay_option, request_pay_date, check_pay_date, check_cash_receipt, pay_status, cash_status, cash_phone from tbl_payment where user_email='".$_SESSION['user_email']."';";
    $result=$conn->query($query);
    if($result == true) {
        $row=$result->fetch_assoc();
        $user_email=$row['user_email'];
        $user_pay_name=$row['user_pay_name'];
        $pay_option=$row['pay_option'];
        $request_pay_date=$row['request_pay_date'];
        $check_pay_date=$row['check_pay_date'];
        $check_cash_receipt=$row['check_cash_receipt'];
        $pay_status=$row['pay_status'];
        $cash_status=$row['cash_status'];
        $cash_phone=$row['cash_phone'];

    }else {
        echo "<script>alert('시스템에 장애가 발생하였습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";
        exit();
    }

    if(isset($_SESSION['user_email']) && $user_email==NULL) {
        echo "<script>alert('구독신청 내역이 존재하지 않습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";
        exit();
    }

    if(strcmp($user_email, $_SESSION['user_email'])) {
        echo "<script>alert('비정상적인 접근이 반복되면 차단됩니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";
        exit();
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

        <div class="receipt-info-table">
            <?php
            $query="select request_option from tbl_user where email='".$_SESSION['user_email']."';";
            $result=$conn->query($query);
    
            if($result) {
                $row=$result->fetch_assoc();
                $option=$row['request_option'];

                $query="select price from tbl_price where goods_option='".$option."';";
                $result=$conn->query($query);
                $row=$result->fetch_assoc();
                $price=$row['price'];

                if(!$result) {
                    echo "<script>alert('시스템 문제로 은행정보를 불러오는데 실패하였습니다.');</script>";
                    echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";
                    exit();
                }

            }else {
                echo "<script>alert('시스템에 장애가 발생하였습니다.');</script>";
                echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";
                exit();
            }

            ?>
            <p><span class='subscription-title'>구독신청 무통장입금 결제 현황</span></p>
            <div class="receipt-time-table"><span class="receipt-time"><?php echo date("Y년 m월 d일 H시 i분 s초 발행", $request_pay_date); ?></span></div>
            <div class="subscription-box-content"><span class="bank-info-title">입금자명</span><br><?php echo $user_pay_name; ?></div>
            <div class="subscription-box-content"><span class="bank-info-title">연락처</span><br><?php echo $cash_phone; ?></div>
            <div class="subscription-box-content"><span class="bank-info-title">입금계좌번호</span><br><?php echo $bank_name." ".$account_number." (".$account_name.")"; ?></div>
            <div class="subscription-box-content"><span class="bank-info-title">결제금액</span><br><?php echo $price; ?>원</div>
            <div class="subscription-box-content"><span class="bank-info-title">입금확인현황</span><br><?php echo $pay_status; ?></div>
            <div class="subscription-box-content"><span class="bank-info-title">현금영수증 발행 현황</span><br><?php echo $cash_status; ?></div>
            <p><a href="./HomeMain.php" class="btn">확인완료</a> <a href="./ReceiptCancel.php" class="btn">신청철회</a></p>
        </div>
    </div>
    <!-- } main page end -->

</body>
</html>

<?php $conn->close(); ?>