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

        <?php
            $get_notice_board='select no, subject, date, content from tbl_notice where no='.$_GET['board_idx'].';';
            $result=$conn->query($get_notice_board);
            if($result == true) {
                $row=$result->fetch_assoc();
                $no=$row['no'];
                $subject=$row['subject'];
                $date=$row['date'];
                $content=$row['content'];
            }
            ?>

        <div class="notice-board-table">
            <div class="left-board-name">
                <p class="board-name"><?php echo $subject; ?><br><br>
                <span class="board-name" style="font-weight: 300;"><?php echo date('Y-m-d', $date); ?></span></p>
            </div>
            <div class="right-board-list">
                <div class="board-content"><?php echo $content; ?></div>
                <a href="./Notice.php"><div class="btn-list">목록</div></a>
            </div>
            <div class="btn-top"><a href="#"><img src="./data/image/btn-top.png" width="40px" height="auto"></a></div>
        </div>

    </div>
    <!-- } main page end -->
</body>
</html>

<?php $conn->close(); ?>