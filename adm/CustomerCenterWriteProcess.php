<!--
    Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.04.29
-->
<meta charset="UTF-8">

<?php
    include_once '../data/database/conn.php';
    include_once './function/is_auth.php';

    $query='update tbl_customer_center set answer="'.$_POST['customer-center-reply'].'", ans_time="'.time().'" where no='.$_POST['chk_customer_center_no'].';';
    $result=$conn->query($query);
    if(!$result) {
        echo "<script>alert('시스템에 장애가 발생하였습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=AdminLecture.php?no=1'>";
        exit();

    }else {
        echo "<script>alert('답변이 성공적으로 작성되었습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=AdminLecture.php?no=1'>";
    }

    $conn->close();
?>