<!--
    Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.03.20
-->
<meta charset="UTF-8">

<?php
    include_once '../data/database/conn.php';
    include_once './function/is_auth.php';

    $get_latest_list_no_query='select lecture_board_list_no from tbl_lecture_board where lecture_rel_no='.$_POST['lecture_rel_no'].' order by lecture_board_list_no desc limit 1;';
    $result=$conn->query($get_latest_list_no_query);
    if($result) {
        $row=$result->fetch_assoc();
        $lecture_board_list_no=$row['lecture_board_list_no'];
    }

    $query="insert into tbl_lecture_board (lecture_rel_no, lecture_board_list_no, lecture_subject, lecture_content, lecture_movie_url, lecture_download_name, lecture_download_url)
                                values ('".$_POST['lecture_rel_no']."', '".($lecture_board_list_no+1)."', '".$_POST['lecture_subject']."', '".$_POST['lecture_content']."', '".$_POST['lecture_movie_url']."', '".$_POST['lecture_download_name']."', '".$_POST['lecture_download_url']."');";
    $result=$conn->query($query);
    if(!$result) {
        echo "<script>alert('시스템에 장애가 발생하였습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=AdminLecture.php?no=1'>";
        exit();

    }else {
        echo "<script>alert('강좌추가가 성공적으로 완료되었습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=AdminLecture.php?no=1'>";
    }

    $conn->close();
?>