<!--
    Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.03.18
-->
<meta charset="UTF-8">

<?php
    include_once '../data/database/conn.php';
    include_once './function/is_auth.php';

    $query="delete from tbl_lecture_list where lecture_no='".$_POST['chk_lecture_no']."';";
    $result=$conn->query($query);
    if(!$result) {
        echo "<script>alert('시스템에 장애가 발생하였습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=AdminLecture.php?no=1'>";
        exit();

    }else {
        echo "<script>alert('강의삭제가 성공적으로 완료되었습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=AdminLecture.php?no=1'>";
    }

    $conn->close();
?>