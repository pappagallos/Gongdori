<!--
    Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.05.04.
-->
<meta charset="UTF-8">

<?php
    include_once '../data/database/conn.php';
    include_once './function/is_auth.php';
    include_once '../security/security_function.php';

    $query='delete from tbl_notice where no='.$_GET['chk_board_no'].';';
    $result=$conn->query($query);
    if(!$result) {
        echo "<script>alert('삭제하는 과정에서 시스템에 장애가 발생하였습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=AdminNotice.php'>";
        exit();

    }else {
        echo "<script>alert('공지사항이 성공적으로 삭제되었습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=AdminNotice.php'>";
        exit();
    }

    $conn->close();
?>