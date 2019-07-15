<!--
    THE GONGDORI Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.05.03
-->

<?php
    include_once '../data/database/conn.php';
    include_once './function/is_auth.php';
?>

<!DOCTYPE HTML>
<html lang="ko">
<head>
    <link rel="stylesheet" href="../style/default.css">
    <link rel="stylesheet" href="../style/admin.css">
</head>
<body>
    <!-- main page start { -->
    <div class="main-frame" style="text-align: center;">
        <?php include_once "Menu.php"; ?>

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
                <p class="board-name" style="text-align: left;"><?php echo $subject; ?><br><br>
                <span class="board-name" style="font-weight: 300; text-align: left;"><?php echo date('Y-m-d', $date); ?></span></p>
            </div>
            <div class="right-board-list">
                <div class="board-content" style="text-align: left;"><?php echo $content; ?></div>
                <a href="./AdminNotice.php"><div class="btn-list">목록</div></a>
            </div>
            <div class="btn-top"><a href="#"><img src="../data/image/btn-top.png" width="40px" height="auto"></a></div>
        </div>

    </div>
    <!-- } main page end -->
</body>
</html>

<?php $conn->close(); ?>