<!--
    THE GONGDORI Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.03.14
-->

<?php
    include_once './data/database/conn.php';
    include_once './security/security_function.php';
    check_block_user();
    session_start();

    //get sub notice title and content
    $get_notice_query="select title, content from tbl_main_notice;";
    $result=$conn->query($get_notice_query);
    if(!$result) {
        echo "<script>alert('시스템 문제로 공지사항을 불러오는데 실패하였습니다.');</script>";
        exit();
    }else {
        $row=$result->fetch_assoc();
        $notice_title=$row['title'];
        $notice_content=$row['content'];
    }

    if(isset($_SESSION['user_email'])) {
        $get_mem_info_query='select chk_pre from tbl_user where email="'.$_SESSION['user_email'].'";';
        $result=$conn->query($get_mem_info_query);
        if($result) {
            $row=$result->fetch_assoc();
            $chk_pre=$row['chk_pre'];
        }
    }
?>

<!DOCTYPE HTML>
<html lang="ko">
<head>
<?php include_once 'Header.php'; ?>
</head>
<body>
    <!-- main page start { -->
    <div class="main-frame" style="text-align: center;">
        <?php include_once "Menu.php"; ?>
        
        <!-- gongdori logo -->
        <div class="gongdori-logo">
            <img src="./data/image/gongdori-logo-200.png">
        </div>

        <!-- display connection time -->
        <div class="connection-time">
            <div id="time-zone"><?php echo '<script language="javascript">getRealTimer();</script>'; ?></div>
            <a href="https://www.youtube.com/channel/UCUiLDqX0HPE0AUeieMEb2-g/featured?view_as=subscriber">
            <div class="broadcast-on">
                <img src="./data/image/youtube.png" class="youtube-rec-on-off">REC
            </div>
            </a>
        </div>

        <!-- display main notice -->
        <div class="main-notice-table">
            <div class="main-notice-title">
                <img src="./data/image/main-information.png" class="main-info-img"><?php echo $notice_title; ?>
            </div>
            <div class="main-notice-content">
                <?php echo $notice_content; ?>
            </div>
        </div>

        <!-- display main sub menu -->
        <div class="main-lecture-table">
        <?php
        $get_lecture_list_query='select * from tbl_lecture_list;';
        if(($result=$conn->query($get_lecture_list_query)) == true) {
            if($result->num_rows > 0) {
                while($row=$result->fetch_assoc()) {
                    $lecture_no=$row['lecture_no'];
                    $lecture_img=$row['lecture_img'];
                    $lecture_str_movie_url=$row['lecture_str_movie_url'];
                    $lecture_title=$row['lecture_title'];
                    $lecture_discription=$row['lecture_discription'];
                    $lecture_status=$row['lecture_status'];
                    
                    if(isset($_SESSION['user_email']) && $chk_pre==1) {
                        echo '<a href="./Lecture.php?lecture_no='.$lecture_no.'&lecture_board_no=&lecture_title='.$lecture_title.'&lecture_discription='.$lecture_discription.'&lecture_str_movie_url='.$lecture_str_movie_url.'&lecture_img='.$lecture_img.'">';
                    }else if(!isset($_SESSION['user_email'])){ ?>
                        <a href="#" onclick="javascript: alert('로그인 후 구독해주셔야 수강이 가능합니다.');">
                    <?php
                    }else if(isset($_SESSION['user_email']) && $chk_pre==0) { ?>
                        <a href="#" onclick="javascript: alert('구독신청 후 결제완료를 해주셔야 수강이 가능합니다.');">
                    <?php
                    }
                    echo '<div class="lecture-box" style="background: url(./data/image/lecture/'.$lecture_img.');">';
                    echo '  <div class="lecture-info-content">';
                    echo '  <div class="lecture-title">'.$lecture_title.'</div>';
                    echo '  <div class="lecture-discription">'.$lecture_discription.'</div>';
                    echo '  <div class="lecture-status">'.$lecture_status.'</div>';
                    echo '  </div>';
                    echo '</div>';
                    echo '</a>';
                }
            }
        }
        ?>
        </div>
    </div>
    <?php include_once './Footer.php'; ?>
    <!-- } main page end -->
</body>
</html>

<?php $conn->close(); ?>