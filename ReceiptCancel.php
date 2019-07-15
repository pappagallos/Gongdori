<?php
    include_once './data/database/conn.php';
    include_once './security/security_function.php';
    check_block_user();
    is_user();

    //get member information
    $query="select user_email from tbl_payment where user_email='".$_SESSION['user_email']."';";
    $result=$conn->query($query);
    if($result == true) {
        $row=$result->fetch_assoc();
        $user_email=$row['user_email'];

    }else {
        echo "<script>alert('시스템에 장애가 발생하였습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";
        exit();
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

    if(isset($_SESSION['user_email']) && $user_email==NULL) {
        echo "<script>alert('구독신청 내역이 존재하지 않습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=Subscription.php'>";
        exit();
    }

    if(strcmp($user_email, $_SESSION['user_email'])) {
        echo "<script>alert('비정상적인 접근이 반복되면 차단됩니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";
        exit();
    }

    if($chk_pre != 1) {
    //cancel subscription
        $query="delete from tbl_payment where user_email='".$_SESSION['user_email']."';";
        $result=$conn->query($query);
        if($result == true) {
            echo "<script>alert('구독신청이 정상적으로 철회되었습니다.');</script>";
            echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";
            exit();

        }else {
            echo "<script>alert('시스템 문제로 구독신청 철회에 실패하였습니다.');</script>";
            echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";
            exit();
        }
    }else if($chk_pre == 1) {
        echo "<script>alert('이미 구독 신청에 대한 결제가 완료되어 철회하실 수 없습니다. 철회를 하시는 경우 이용약관에 의거 환불이 불가능합니다. 철회하고 싶으시다면 고객센터에 문의부탁드립니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";
        exit();
    }
?>