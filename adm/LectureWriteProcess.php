<!--
    Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.03.18
-->
<meta charset="UTF-8">

<?php
    include_once '../data/database/conn.php';
    include_once './function/is_auth.php';

    $query="insert into tbl_lecture_list (lecture_title, lecture_discription, lecture_status, lecture_str_movie_url, lecture_img, chk_open)
                                values ('".$_POST['lecture_title']."', '".$_POST['lecture_discription']."', '".$_POST['lecture_status']."', '".$_POST['lecture_str_movie_url']."', '".$_POST['lecture_img']."', '".$_POST['chk_open']."');";
    $result=$conn->query($query);
    if(!$result) {
        echo "<script>alert('시스템에 장애가 발생하였습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=AdminLecture.php?no=1'>";
        exit();

    }else {
        echo "<script>alert('강의추가가 성공적으로 완료되었습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=AdminLecture.php?no=1'>";
    }

    $conn->close();
?>