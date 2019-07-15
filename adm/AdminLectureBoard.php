<!--
    Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.03.18
-->
<?php
    include_once '../data/database/conn.php';
    include_once 'function/is_auth.php';
?>

<!DOCTYPE HTML>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="../style/default.css">
    <link rel="stylesheet" href="../style/admin.css">

    <script language="javascript">
    function btn_click(num) {
        if(num == 1) {
            admlectureboard.action="./AdminLectureBoardModify.php";
        }else if(num == 2) {
            if(confirm("정말 해당 강좌를 삭제하시겠습니까?")) {
                admlectureboard.action="./LectureBoardDeleteProcess.php";
            }
        }
    }
    </script>
</head>
<body>
    <!-- main page start { -->
    <div class="main-frame">
        <?php include_once "Menu.php"; ?>
        <div class="admin-user-table">
            <form name="admlectureboard" method="post">
            <input type="hidden" name="end_list" value="<?php echo $_GET['end_list']; ?>">
            <div style="margin-bottom: 15px;"><span class="admin-title">강좌관리</span></div>
            <?php

            $MAX_BOARD_LIST=15; //한 페이지당 출력할 게시글 수

            //create member list number process
            $get_count_query="select count(lecture_rel_no) from tbl_lecture_board where lecture_rel_no=".$_GET['rel_no'].";"; //all member number
            $get_count_result=$conn->query($get_count_query);
            $get_count_result=$get_count_result->fetch_assoc();
            $lecture_count=$get_count_result['count(lecture_rel_no)'];
            $lecture_count=$lecture_count/$MAX_BOARD_LIST;

            echo '<table cellpadding="5" cellspacing="0" width="100%">
            <tr>
                <td width="5%" class="admin-user-list" style="border-top-left-radius: 8px;">목록</td>
                <td width="5%" class="admin-user-list">코드</td>
                <td width="30%" class="admin-user-list">제목</td>
                <td width="60%" class="admin-user-list" style="border-top-right-radius: 8px;">설명</td>
            </tr>';

            $get_lecture_info_query="select * from tbl_lecture_board where lecture_rel_no=".$_GET['rel_no']." and lecture_board_list_no between ".$_GET['str_list']." and ".$_GET['end_list'].";";
            if(($result=$conn->query($get_lecture_info_query)) == true) {
                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $lecture_rel_no=$row['lecture_rel_no'];
                        $lecture_board_no=$row['lecture_board_no'];
                        $lecture_board_list_no=$row['lecture_board_list_no'];
                        $lecture_subject=$row['lecture_subject'];
                        $lecture_content=$row['lecture_content'];
                        $lecture_subject=mb_substr($lecture_subject, 0, 30, 'utf-8');
                        $lecture_content=mb_substr($lecture_content, 0, 40, 'utf-8');

                        echo '<tr>
                                <input type="hidden" name="chk_lecture_board_list_no" value="'.$lecture_board_list_no.'">
                                <input type="hidden" name="chk_lecture_rel_no" value="'.$lecture_rel_no.'">
                                <td width="5%"><input type="radio" name="chk_lecture_board_no" value="'.$lecture_board_no.'"></td>
                                <td width="5%">'.$lecture_rel_no.'</td>
                                <td width="30%" style="text-align: left;">'.$lecture_subject.'...</td>
                                <td width="60%" style="text-align: left;">'.$lecture_content.'...</td>
                            </tr>';
                    }
                }
            }
            echo '</table>';
            
            //list setter
            for($list=0; $list<=$lecture_count; $list++) {
                echo '<a href="./AdminLectureBoard.php?rel_no='.$_GET['rel_no'].'&str_list='.(($list==0)?((($list)*$MAX_BOARD_LIST)+1):($_GET['end_list'])).'&end_list='.(($list+1)*$MAX_BOARD_LIST).'"><span class="admin-user-list-number">'.($list+1).'</span></a>';
            }
            ?><br><br>
            <a href="./AdminLectureBoardWrite.php" class="btn">강좌추가</a>
            <input type="submit" class="btn" onclick="btn_click(1)" value="강좌수정">
            <input type="submit" class="btn" onclick="btn_click(2)" value="강좌삭제">
            </div>
            
        </div>
        </form>
    </div>  
    <!-- } main page end -->
</body>
</html>

<?php $conn->close(); ?>