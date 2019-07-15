<!--
    Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.03.20
    2th modify date, 2018.03.31
-->
<meta charset="UTF-8">

<?php
    include_once '../data/database/conn.php';
    include_once './function/is_auth.php';

    //하위로 분류되는 게시물들을 클릭한 리스트에 맞게 불러오기 위한 기능
    //get latest value of board_list_no
    $get_latest_list_no_query='select lecture_board_list_no from tbl_lecture_board where lecture_rel_no='.$_POST['chk_lecture_rel_no'].' order by lecture_board_list_no desc limit 1;';
    $result=$conn->query($get_latest_list_no_query);
    if($result) {
        $row=$result->fetch_assoc();
        $lecture_board_list_no=$row['lecture_board_list_no'];
    }

    for($i=$_POST['chk_lecture_board_list_no']; $i<$lecture_board_list_no; $i++) {
        $get_lecutre_board_no_query='select lecture_board_no from tbl_lecture_board where lecture_rel_no='.$_POST['chk_lecture_rel_no'].' and lecture_board_list_no='.$i.';';
        $result=$conn->query($get_lecutre_board_no_query);
        if(!$result) {
            echo "<script>alert('데이터 베이스 값을 가져오던 중 시스템에 장애가 발생하였습니다.');</script>";
            echo "<meta http-equiv='refresh' content='0;url=AdminLecture.php?no=1'>";
            exit();

        }else {
            $row=$result->fetch_assoc();
            $get_lecture_board_no=$row['lecture_board_no'];
        }

        $modify_process_query='update tbl_lecture_board set lecture_board_list_no='.$i.' where lecture_board_no='.$get_lecture_board_no.' and lecture_board_list_no='.($i+1).';';
        $result=$conn->query($modify_process_query);
        if(!$result) {
            echo "<script>alert('데이터 베이스 값을 수정하던 중 시스템에 장애가 발생하였습니다.');</script>";
            echo "<meta http-equiv='refresh' content='0;url=AdminLecture.php?no=1'>";
            exit();
        }
    }

    $query="delete from tbl_lecture_board where lecture_board_no='".$_POST['chk_lecture_board_no']."';";
    $result=$conn->query($query);
    if(!$result) {
        echo "<script>alert('시스템에 장애가 발생하였습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=AdminLecture.php?no=1'>";
        exit();

    }else {
        echo "<script>alert('강좌삭제가 성공적으로 완료되었습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=AdminLecture.php?no=1'>";
    }

    $conn->close();
?>