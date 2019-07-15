<meta charset="UTF-8">

<?php
    //connect database
    include_once './data/database/conn.php';
    include_once './security/security_function.php';
    check_block_user();
    is_user();

    //get post method source
    $get_email=$_SESSION['user_email'];
    $get_pay_name=$_POST['user_name'];
    $get_pay_phone=$_POST['user_phone'];
    $get_option=$_POST['option'];
    if(!empty($_POST['chkcash'])) { 
        $get_cash=$_POST['chkcash'];
        $cash_comment="발행대기";
    } else {
        $get_cash=0;
        $cash_comment="미요청";
    }

    gongdori_scanning_keyword($get_email);
    gongdori_scanning_keyword($get_pay_name);
    gongdori_scanning_keyword($get_pay_phone);
    gongdori_scanning_keyword($get_option);

    //protect sql injection
    $patch_pay_phone=str_replace("-", "", $get_pay_phone);
    $get_pay_name=mysqli_real_escape_string($conn, $_POST['user_name']);
    $get_pay_phone=mysqli_real_escape_string($conn, $_POST['user_phone']);
    $get_option=mysqli_real_escape_string($conn, $_POST['option']);

    //re-check phone number
    if(!is_numeric($patch_pay_phone)) {
        echo "<script>alert('수상한 값이 입력되어 구독신청을 실패하였습니다.')</script>";
        echo "<meta http-equiv='refresh' content='0;url=Subscription.php'>";
        exit();
    }

    //korea time
    $timestamp=time();
    //$timestamp+=28800; //add 28800 second is korea time.

    //insert into table query
    $insert="insert into tbl_payment (
            user_email,
            user_pay_name,
            pay_option,
            request_pay_date,
            check_pay_date,
            check_cash_receipt,
            pay_status,
            cash_status,
            cash_phone) values ('".$get_email."', '".$get_pay_name."', ".$get_option.", ".$timestamp.", 0, ".$get_cash.", '입금대기', '".$cash_comment."', '".$patch_pay_phone."');";

    $result=$conn->query($insert);
    
    if($result == true && $get_option != 1) {
        //insert user option
        $insert="update tbl_user set request_option=".$get_option.", where email='".$_SESSION['user_email']."';";
        $result=$conn->query($insert);

        if($result == true) {
            echo "<meta http-equiv='refresh' content='0;url=Receipt.php'>";
            
        }else {
            echo "<script>alert('시스템 문제로 구독신청을 실패하였습니다.')</script>";
            echo "<meta http-equiv='refresh' content='0;url=Subscription.php'>";
            exit();
        }
    
    //option 1 case
    }else if($result == true && $get_option == 1) {

        $day=86400; //하루 초
        $quote=0; //몫
        $remain=0; //나머지
        $timestamp=time();
        $quote_sec=$timestamp+31536000;

        $insert="update tbl_user set request_option=".$get_option.", str_pre_date=".$timestamp.", end_pre_date=".$quote_sec.", chk_pre=1 where email='".$_SESSION['user_email']."';";
        $conn->query($insert);

        $insert="update tbl_payment set pay_status='결제완료', cash_status='발행불가' where user_email='".$_SESSION['user_email']."';";
        $conn->query($insert);

        $insert="update tbl_payment set cash_phone='입금확인 후 개인정보 제거 완료' where user_email='".$_SESSION['user_email']."';";
        $result=$conn->query($insert);
        
        if($result == true) {
            echo "<script>alert('무료구독 신청이 완료되었습니다. 바로 강의를 수강하실 수 있습니다.')</script>";
            echo "<meta http-equiv='refresh' content='0;url=Receipt.php'>";

        }else {
            echo "<script>alert('시스템 문제로 개인정보 제거가 완료되지 않았습니다. 즉시 고객센터에 문의해주십시오.')</script>";
            echo "<meta http-equiv='refresh' content='0;url=Subscription.php'>";
            exit();
        }

    }else {
        echo "<script>alert('시스템 문제로 구독신청을 실패하였습니다.')</script>";
        echo "<meta http-equiv='refresh' content='0;url=Subscription.php'>";
        exit();
    }
    
    $conn->close();
?>