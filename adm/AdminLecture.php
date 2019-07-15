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
        function btn_click(index) {
            if(index==1) {
                frm1.action="AdminLectureModify.php";
            }else if(index==2) {
                if(confirm("삭제하게 되면 하위 강좌들까지 모두 삭제하게 됩니다. 삭제하시겠습니까?")) {
                    frm1.action="LectureDeleteProcess.php";
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

            <form name="frm1" method="post">
            <div style="margin-bottom: 15px;"><span class="admin-title">강의관리</span></div>
            <?php
            $max=$_GET['no']+14; //max of display list
            
            //create member list number process
            $get_count_query="select count(lecture_no) from tbl_lecture_list;"; //all member number
            $get_count_result=$conn->query($get_count_query);
            $get_count_result=$get_count_result->fetch_assoc();
            $lecture_count=$get_count_result['count(lecture_no)'];
            $lecture_count=$lecture_count/15;

            echo '<table cellpadding="5" cellspacing="0" width="100%">
            <tr>
                <td width="5%" class="admin-user-list" style="border-top-left-radius: 8px;">목록</td>
                <td width="5%" class="admin-user-list">코드</td>
                <td width="20%" class="admin-user-list">이미지</td>
                <td width="20%" class="admin-user-list">제목</td>
                <td width="30%" class="admin-user-list">설명</td>
                <td width="10%" class="admin-user-list">상태</td>
                <td width="5%" class="admin-user-list" style="border-top-right-radius: 8px;">개방</td>
            </tr>';

            $get_lecture_info_query="select * from tbl_lecture_list where lecture_no between ".$_GET['no']." and ".$max." order by lecture_no desc;";
            if(($result=$conn->query($get_lecture_info_query)) == true) {
                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $lecture_no=$row['lecture_no'];
                        $lecture_img=$row['lecture_img'];
                        $lecture_title=$row['lecture_title'];
                        $lecture_discription=$row['lecture_discription'];
                        $lecture_status=$row['lecture_status'];
                        $chk_open=$row['chk_open'];
                        $lecture_discription=mb_substr($lecture_discription, 0, 20, 'utf-8');
                        $lecture_img=mb_substr($lecture_img, 0, 15, 'utf-8');
                        $lecture_status=mb_substr($lecture_status, 0, 5, 'utf-8');
                        $lecture_title=mb_substr($lecture_title, 0, 15, 'utf-8');
                        if($chk_open==0) $chk_open='닫힘';
                        else if($chk_open==1) $chk_open='열림';
                        else $chk_open='오류';

                        echo '<tr>
                                <td width="5%"><input type="radio" name="chk_lecture_no" value="'.$lecture_no.'"></td>
                                <td width="5%"><a href="./AdminLectureBoard.php?rel_no='.$lecture_no.'&str_list=1&end_list=15">'.$lecture_no.'</a></td>
                                <td width="20%"><a href="./AdminLectureBoard.php?rel_no='.$lecture_no.'&str_list=1&end_list=15">'.$lecture_img.'...</a></td>
                                <td width="20%" style="text-align: left;"><a href="./AdminLectureBoard.php?rel_no='.$lecture_no.'&str_list=1&end_list=15">'.$lecture_title.'...</a></td>
                                <td width="30%" style="text-align: left;"><a href="./AdminLectureBoard.php?rel_no='.$lecture_no.'&str_list=1&end_list=15">'.$lecture_discription.'...</a></td>
                                <td width="10%"><a href="./AdminLectureBoard.php?rel_no='.$lecture_no.'&str_list=1&end_list=15">'.$lecture_status.'...</a></td>
                                <td width="10%"><a href="./AdminLectureBoard.php?rel_no='.$lecture_no.'&str_list=1&end_list=15">'.$chk_open.'</a></td>
                            </tr>';
                    }
                }
            }
            echo '</table>';
            
            //list setter
            for($list=0; $list<=$lecture_count; $list++) {
                echo '<a href="./AdminLecture.php?no='.(($list*15)+1).'"><span class="admin-user-list-number">'.($list+1).'</span></a>';
            }
            ?><br><br>
            <a href="./AdminLectureWrite.php" class="btn">강의추가</a>
            <input type="submit" class="btn" value="강의수정" onClick="btn_click(1)">
            <input type="submit" class="btn" value="강의삭제" onClick="btn_click(2)">
            </div>
            
        </div>
        </form>
    </div>  
    <!-- } main page end -->
</body>
</html>

<?php $conn->close(); ?>