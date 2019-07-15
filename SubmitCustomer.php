<meta charset="UTF-8">

<?php
    //connect database
    include_once './data/database/conn.php';
    include_once './security/security_function.php';
    check_block_user();
    is_user();

    //get post method source
    $get_message=$_POST['message'];
    gongdori_scanning_keyword($get_message);

    //protect XSS
    $get_message=htmlspecialchars($get_message);

    //check input
    if($get_message == '') {
        echo "<script>alert('문의 내용을 입력해주세요.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=CustomerCenter.php'>";
        exit();
    }

    //insert into table query
    $insert="insert into tbl_customer_center (
            email,
            question,
            que_time) values ('".$_SESSION['user_email']."', '".$get_message."', ".time().");";

    if($conn->query($insert) == true) {
        echo "<meta http-equiv='refresh' content='0;url=CustomerCenter.php'>";
        
    }else {
        echo "<script>alert('시스템 문제로 문의에 실패하였습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=CustomerCenter.php'>";
        exit();
    }

    $conn->close();
?>