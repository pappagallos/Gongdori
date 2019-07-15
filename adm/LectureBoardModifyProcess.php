<!--
    Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.03.20
-->
<meta charset="UTF-8">

<?php
    include_once '../data/database/conn.php';
    include_once './function/is_auth.php';

    if($_POST['lecture_rel_no']==null) {
        echo "<script>alert('강좌분류를 선택해주세요.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=AdminLecture.php?no=1'>";
        exit();
    }

    $query="update tbl_lecture_board set lecture_rel_no='".$_POST['lecture_rel_no']."', lecture_subject='".$_POST['lecture_subject']."', lecture_content='".$_POST['lecture_content']."', lecture_movie_url='".$_POST['lecture_movie_url']."', lecture_download_name='".$_POST['lecture_download_name']."', lecture_download_url='".$_POST['lecture_download_url']."' where lecture_board_no='".$_POST['lecture_board_no']."';";
    $result=$conn->query($query);
    if(!$result) {
        echo "<script>alert('시스템에 장애가 발생하였습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=AdminLecture.php?no=1'>";
        exit();

    }else {
        echo "<script>alert('강좌수정이 성공적으로 완료되었습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=AdminLecture.php?no=1'>";
    }

    $conn->close();
?>