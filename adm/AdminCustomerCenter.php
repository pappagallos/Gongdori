<!--
    THE GONGDORI Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.04.12
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
                var board_no=document.getElementsByName('chk_customer_center_no');
                for(var index=0; index<board_no.length; index++) {
                    if(board_no[index].checked == true) {
                        customer_center_form.action="AdminCustomerCenterWrite.php?no="+board_no[index].value;
                    }
                }
            }else if(index==2) {
                if(confirm("정말 회원의 문의사항을 무시하시겠습니까?")) {
                    customer_center_form.action="#";
                }
            }
        }
    </script>

</head>
<body>
    <!-- main page start { -->
    <div class="main-frame" style="text-align: center;">
        <?php include_once "Menu.php"; ?>

        <div class="admin-user-table">
            <div style="margin-bottom: 15px;"><span class="admin-title">문의관리</span></div>

            <form name="customer_center_form" method="post">
            <!-- idle status customer center -->
            <table cellpadding="5" cellspacing="0" width="100%">
                <tr>
                    <td width="5%" class="admin-user-list" style="border-top-left-radius: 8px;">번호</td>
                    <td width="20%" class="admin-user-list">작성자</td>
                    <td width="45%" class="admin-user-list">내용</td>
                    <td width="20%" class="admin-user-list">작성일자</td>
                    <td width="10%" class="admin-user-list">여부</td>
                </tr>
                <?php
                $board_count = 1;
                $get_customer_center_query='select no, email, question, que_time, ans_time, answer from tbl_customer_center;';
                if($result=$conn->query($get_customer_center_query)) {
                    if($result->num_rows > 0) {
                        while($row=$result->fetch_assoc()) {
                            $no=$row['no'];
                            $email=$row['email'];
                            $question=$row['question'];
                            $que_time=$row['que_time'];
                            $ans_time=$row['ans_time'];
                            $answer=$row['answer'];

                            echo '<input type="hidden" name="email" value="'.$email.'">';
                            echo '<input type="hidden" name="question" value="'.$question.'">';
                            echo '<input type="hidden" name="question_time" value="'.$que_time.'">';
                            
                            echo '<tr>';
                            echo '<td><input type="radio" name="chk_customer_center_no" value="'.$no.'"></td>';
                            echo '<td>'.$email.'</td>';
                            echo '<td style="text-align: left;">'.mb_substr($question, 0, 30, 'utf-8').'...</td>';
                            echo '<td>'.date("Y.m.d H:i:s", $que_time).'</td>';

                            if($ans_time == null || $answer == null) echo '<td>미등록</td>';
                            else echo '<td>완료</td>';
                            echo '</tr>';
                        }

                    }else {
                        echo '<tr>';
                        echo '<td colspan="5">등록된 고객센터 문의글이 없습니다.</td>';
                        echo '</tr>';
                    }
                }
                ?>
            </div>
            </table>

            <input type="submit" class="btn" value="문의답변" onClick="btn_click(1)">
            <input type="submit" class="btn" value="문의무시" onClick="btn_click(2)">
            </form>
        </div>
    </div>
    <!-- } main page end -->
</body>
</html>

<?php $conn->close(); ?>