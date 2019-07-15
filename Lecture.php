<!--
    THE GONGDORI Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.03.15
-->

<?php
    include_once './data/database/conn.php';
    include_once './security/security_function.php';
    check_block_user();
    is_user();

    if(isset($_SESSION['user_email'])) {
        $get_mem_info_query='select level, chk_pre from tbl_user where email="'.$_SESSION['user_email'].'";';
        $result=$conn->query($get_mem_info_query);
        if($result) {
            $row=$result->fetch_assoc();
            $chk_pre=$row['chk_pre'];
            $user_level=$row['level'];
        }
    }

    $lecture_download_url='';
    //the process whether lecture is opened
    $get_lecture_list_query='select chk_open from tbl_lecture_list where lecture_no='.$_GET['lecture_no'].';';
    $result=$conn->query($get_lecture_list_query);
    $chk_open=0;
    if($result) {
        $row=$result->fetch_assoc();
        $chk_open=$row['chk_open'];
    }

    if($chk_open == 0 && $user_level > 1) {
        echo "<script>alert('강의가 아직 준비되지 않았습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";
        exit();
    }
    
    if(isset($_SESSION['user_email']) && $chk_pre==0) {
        echo "<script>alert('구독신청 하신 뒤 이용이 가능합니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";
        exit();
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
            <?php echo date("H : i", time()); ?>
            <a href="https://www.youtube.com/channel/UCUiLDqX0HPE0AUeieMEb2-g/featured?view_as=subscriber">
            <div class="broadcast-on">
                <img src="./data/image/youtube.png" class="youtube-rec-on-off">REC
            </div>
            </a>
        </div>

        <!-- display lecture information -->
        <div class="web-lecture-info-table">
            <div class="web-lecture-title">
                <?php echo $_GET['lecture_title']; ?>
            </div>
            <div class="web-lecture-discription">
                <?php echo $_GET['lecture_discription']; ?>
            </div>
        </div>
        
        <div class="movie" style="margin-top: 60px; margin-bottom: 120px;">
            <iframe width="970px" height="600px" src="<?php echo $_GET['lecture_str_movie_url']; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>

        <?php
        $get_lecture_board_query='select lecture_download_name, lecture_download_url from tbl_lecture_board where lecture_board_no='.$_GET['lecture_board_no'].';';
        $result=$conn->query($get_lecture_board_query);
        if($result) {
            $row=$result->fetch_assoc();
            $lecture_download_name=$row['lecture_download_name'];
            $lecture_download_url=$row['lecture_download_url'];
        }
        ?>

        <?php if(!($lecture_download_url==null)) { ?>
        <div class="download">
            <a href="<?php echo $lecture_download_url; ?>" target="_blank";>
            <img src="./data/image/download.png" style="width: 20px; height: auto;"><span style="position: relative; left: 10px; bottom: 3px;"><?php echo $lecture_download_name; ?></span>
            </a>
        </div>
        <?php } ?>

        <!-- display main sub menu -->
        <div class="main-lecture-table">
        <?php
        $get_lecture_board_query='select * from tbl_lecture_board where lecture_rel_no='.$_GET['lecture_no'].';';
        if(($result=$conn->query($get_lecture_board_query)) == true) {
            if($result->num_rows > 0) {
                while($row=$result->fetch_assoc()) {
                    $lecture_rel_no=$row['lecture_rel_no'];
                    $lecture_board_no=$row['lecture_board_no'];
                    $lecture_subject=$row['lecture_subject'];
                    $lecture_content=$row['lecture_content'];
                    $lecture_movie_url=$row['lecture_movie_url'];
                    
                    if(isset($_SESSION['user_email']) && $chk_pre==1) {
                        echo '<a href="./Lecture.php?lecture_no='.$lecture_rel_no.'&lecture_board_no='.$lecture_board_no.'&lecture_title='.$lecture_subject.'&lecture_discription='.$lecture_content.'&lecture_str_movie_url='.$lecture_movie_url.'&lecture_img='.$_GET['lecture_img'].'">';
                    }else if(!isset($_SESSION['user_email'])){ ?>
                        <a href="#" onclick="javascript: alert('로그인 후 구독해주셔야 수강이 가능합니다.');">
                    <?php
                    }else if(isset($_SESSION['user_email']) && $chk_pre==0) { ?>
                        <a href="#" onclick="javascript: alert('구독신청 후 결제완료를 해주셔야 수강이 가능합니다.');">
                    <?php
                    }
                    $lecture_content=mb_substr($lecture_content, 0, 57, 'utf-8');
                    echo '<div class="lecture-box" style="background: url(./data/image/lecture/'.$_GET['lecture_img'].');">';
                    echo '  <div class="lecture-info-content">';
                    echo '  <div class="lecture-title" style="text-overflow: ellipsis;">'.$lecture_subject.'</div>';
                    echo '  <div class="lecture-discription" style="text-overflow: ellipsis;">'.$lecture_content.'...</div>';
                    echo '  </div>';
                    echo '</div>';
                    echo '</a>';
                }
            }
        }
        ?>
        </div>

        <?php include_once './Footer.php'; ?>
    </div>
    <!-- } main page end -->


</body>
</html>

<?php $conn->close(); ?>