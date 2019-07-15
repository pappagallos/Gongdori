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

        <div class="notice-board-table">
            <div class="left-board-name">
                <span class="board-name">보도자료<br>소식</span>
            </div>
            <div class="right-board-list">
                <table>
                    <thead>
                        <th style="width: 525px">내용</th>
                        <th style="width: 100px">등록일</th>
                    </thead>
                    <tbody>
                        <?php
                        $get_notice_board='select no, subject, date from tbl_notice order by no desc;';
                        $result=$conn->query($get_notice_board);
                        if($result == true) {
                            if($result->num_rows > 0) {
                                while($row=$result->fetch_assoc()) {
                                    $no=$row['no'];
                                    $subject=$row['subject'];
                                    $date=$row['date'];
                                    echo
                                    '<tr>
                                        <td class="subject"><a href="./NoticeView.php?board_idx='.$no.'"><p class="on-mouse-subject">'.$subject.'</p></td>
                                        <td class="date"><p>'.date("Y-m-d", $date).'</p></td>
                                    </tr>';
                                }

                            }else {
                                echo
                                '<tr>
                                    <td class="subject" colspan="2" style="text-align: center;">등록된 공지사항이 존재하지 않습니다.</td>
                                </tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="btn-top"><a href="#"><img src="./data/image/btn-top.png" width="40px" height="auto"></a></div>
        </div>

    </div>
    <!-- } main page end -->
</body>
</html>

<?php $conn->close(); ?>