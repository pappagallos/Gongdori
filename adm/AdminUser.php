<!--
    Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.02.28
-->
<?php
    include_once '../data/database/conn.php';
    include_once 'function/is_auth.php';
?>

<!DOCTYPE HTML>
<html lang="kor">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="../style/default.css">
    <link rel="stylesheet" href="../style/admin.css">
</head>
<body>
    <!-- main page start { -->
    <div class="main-frame">
        <?php include_once "Menu.php"; ?>
        <div class="admin-user-table">
            <form action="./UserModifyProcess.php" method="post">
            <div style="margin-bottom: 20px;"><span class="admin-title">회원관리</span></div>
            <?php
            $max=$_GET['str']+14; //max of display list

            $query="select email, level, str_pre_date, end_pre_date, point from tbl_user where no between ".$_GET['str']." and ".$max." order by no desc;";
            
            //create member list number process
            $count_query="select count(no) from tbl_user;"; //all member number
            $count_result=$conn->query($count_query);
            $count_result=$count_result->fetch_assoc();
            $member_count=$count_result['count(no)'];
            $member_count/=15;

            echo '<table cellpadding="5" cellspacing="0" width="100%">';
            echo '<tr>';
            echo '<td width="5%" class="admin-user-list" style="border-top-left-radius: 8px;">목록</td>';
            echo '<td width="25%" class="admin-user-list">이메일</td>';
            echo '<td width="10%" class="admin-user-list">권한</td>';
            echo '<td width="25%" class="admin-user-list">구독시작일</td>';
            echo '<td width="25%" class="admin-user-list">구독마감일</td>';
            echo '<td width="10%" class="admin-user-list" style="border-top-right-radius: 8px;">동전</td>';
            echo '</tr>';

            if(($result=$conn->query($query)) == true) {
                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $email=$row['email'];
                        $level=$row['level'];

                        //translate string for level
                        if($level==9) $level="회원";
                        else if($level==1) $level="운영자";

                        //translate date for str_pre_date
                        $str_pre_date=$row['str_pre_date'];
                        if($str_pre_date==0) $str_pre_date="비구독자";
                        else $str_pre_date=date("Y년m월d일 H시i분s초", $str_pre_date);

                        //translate date for end_pre_date
                        $end_pre_date=$row['end_pre_date'];
                        if($end_pre_date==0) $end_pre_date="비구독자";
                        else$end_pre_date=date("Y년m월d일 H시i분s초", $end_pre_date);

                        $point=$row['point'];
                        echo '<tr><td><input type="radio" name="chk_email" value="'.$email.'"></td><td>'.$email.'</td><td>'.$level.'</td><td>'.$str_pre_date.'</td><td>'.$end_pre_date.'</td><td>'.$point.'원</td></tr>';
                    }
                }
            }
            echo '</table>';
            
            //list setter
            for($list=0; $list<=$member_count; $list++) {
                echo '<a href="./AdminUser.php?str='.(($list*15)+1).'"><span class="admin-user-list-number">'.($list+1).'</span></a>';
            }
            ?><br><br>
            <a href="#" class="btn">회원삭제</a>
            <a href="#" class="btn">회원수정</a>
            </div>
            
        </div>
        </form>
    </div>  
    <!-- } main page end -->
</body>
</html>

<?php $conn->close(); ?>