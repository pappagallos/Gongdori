<!--
    THE GONGDORI Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.03.29
-->

<?php
    include './data/database/conn.php';
    include_once './security/security_function.php';
    check_block_user();
    is_user();
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

        <!-- customer center -->
        <div class="customer-chat-frame">
            <div class="customer-title"><img src="./data/image/customer-back-btn.png" style="margin-top: 15px; margin-left: 20px;"><img src="./data/image/menu.png" style="float: right; width: 35px; height: auto; margin-top: 17px; margin-right: 20px;"></div>
            <div class="customer-chat-notice">
                <img src="./data/image/notification.png" style="margin-top: 5px; margin-left: 5px;">
                <div style="position: absolute; top: 13px; right: 5px; text-align: right;"><img src="./data/image/down-arrow.png" style="margin-top: 5px; margin-right: 5px;"></div>
                <div class="customer-chat-notice-box">공도리 운영자는 대학생이기 때문에 월요일부터 금요일까지는 오후 6시부터 10시까지 답변해드려요. 주말에는 하고싶을 때 해요. 헤헤.</div>
            </div>

            <table>
                <tr>
                    <td rowspan="2" style="vertical-align: top;"><img src="./data/image/admin-chat-image.png"></td>
                    <td><div class="chat-name"><span>공도리 운영자</span></div></td>
                    <td rowspan="2" style="vertical-align: bottom;"><span class="chat-time"><?php echo date("Y.m.d H:i", time()); ?></span></td>
                </tr>
                <tr>
                    <td style="width: 600px; padding-left: 5px;"><div class="chat"><span>안녕하세요. 공도리 운영자 이우진 입니다. 고객센터에서는 공도리 회원 여러분들의 회원탈퇴/이용문의/강의요청/후원문의 등 제한없이 답변을 드리고 있습니다. 문의하실 내용이 있으시다면 이곳에 여러분들의 문의 내용을 자유롭게 적어주세요.</span></div></td>
                </tr>
            </table>

            <?php
            $get_message_query="select * from tbl_customer_center where email='".$_SESSION['user_email']."';";
            if($result=$conn->query($get_message_query)) {
                while($row=$result->fetch_assoc()) {
                    echo '<div style="float: right;">';
                    echo '  <table style="margin-top: 15px;">';
                    echo '  <tr>';
                    echo '      <td colspan="2"><div class="chat-name" style="text-align: right;"><span>'.$_SESSION['user_email'].'</span></div></td>';
                    echo '  </tr>';
                    echo '  <tr>';
                    echo '      <td style="vertical-align: bottom;"><span class="chat-time">'.date("Y.m.d H:i", $row['que_time']).'</span></td>';
                    echo '      <td style="min-width: 400px; max-width: 600px; padding-left: 5px;"><div class="user-chat">'.$row['question'].'</div></td>';   
                    echo '  </tr>';
                    echo '  <tr>';
                    echo '      <td colspan="2" style="color: #fff; font-size: 14px;"><a href="./CustomerCenterDelete.php?&msg_no='.$row['no'].'"><img src="./data/image/btn_delete.png" width="15px" height="15px" style="float: right; margin: 3px;" alt="삭제"></a></td>';
                    echo '  </tr>';
                    echo '  </table>';
                    echo '</div>';

                    if($row['ans_time']!=NULL) {
                        echo '<table style="margin-top: 15px;">';
                        echo '<tr>';
                        echo '  <td rowspan="2" style="vertical-align: top;"><img src="./data/image/admin-chat-image.png"></td>';
                        echo '  <td><div class="chat-name"><span>공도리 운영자</span></div></td>';
                        echo '  <td rowspan="2" style="vertical-align: bottom;"><span class="chat-time">'.date("Y.m.d H:i", $row['ans_time']).'</span></td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '  <td style="min-height: 100px; min-width: 400px; max-width: 600px; padding-left: 5px;"><div class="chat"><span>'.$row['answer'].'</span></div></td>';
                        echo '</tr>';
                        echo '</table>';
                    }
                }
            }
            ?>

            <form action="SubmitCustomer.php" method="post">
                <div style="margin-left: 290px;">
                    <table style="padding-top: 15px;">
                        <tr>
                            <td colspan="2"><div class="chat-name" style="text-align: right;"><span><?php echo $_SESSION['user_email']; ?></span></div></td>
                        </tr>
                        <tr>
                            <!--<td style="vertical-align: bottom;"><span style="font-size: 14px;"><?php echo date("H시i분", time()); ?></span></td> -->
                            <td style="width: 600px; padding-left: 5px;"><div class="user-chat"><textarea type="text" name="message" class="user-input-chat" rows="5" placeholder="회원님의 문의사항을 입력하세요." required></textarea></div></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right;"><input type="submit" value="전송" class="user-submit-chat-btn"></td>
                        </tr>
                    </table>
                </div>
            </form>

        </div>
    </div>
    <?php include_once './Footer.php'; ?>
    <!-- } main page end -->
</body>
</html>

<?php $conn->close(); ?>