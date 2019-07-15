<!--
    Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.03.01
-->
<meta charset="UTF-8">

<?php
    include_once '../data/database/conn.php';
    include_once 'function/is_auth.php';

    $query="update tbl_bank set bank_name='".$_POST['bank_name']."', account_name='".$_POST['account_name']."', account_number='".$_POST['account_number']."';";
    $result=$conn->query($query);
    if(!$result) {
        echo "<script>alert('시스템에 장애가 발생하였습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=AdminBank.php'>";
        exit();

    }else {
        echo "<script>alert('계좌수정이 성공적으로 완료되었습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=AdminBank.php'>";
    }

    $conn->close();
?>