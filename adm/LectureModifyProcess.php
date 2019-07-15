<!--
    Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.03.18
-->
<meta charset="UTF-8">

<?php
    include_once '../data/database/conn.php';
    include_once './function/is_auth.php';

    $query="update tbl_lecture_list set lecture_title='".$_POST['lecture_title']."', lecture_discription='".$_POST['lecture_discription']."', lecture_status='".$_POST['lecture_status']."', lecture_str_movie_url='".$_POST['lecture_str_movie_url']."', lecture_img='".$_POST['lecture_img']."', chk_open=".$_POST['chk_open']." where lecture_no=".$_POST['lecture_no'].";";
    $result=$conn->query($query);
    if(!$result) {
        echo "<script>alert('시스템에 장애가 발생하였습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=AdminLecture.php?no=1'>";
        exit();

    }else {
        echo "<script>alert('강의수정이 성공적으로 완료되었습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=AdminLecture.php?no=1'>";
    }

    $conn->close();
?>