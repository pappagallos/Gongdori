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

    <script language="javascript">
        function btn_click(num) {
            if(num == 1) notice_board_form.action='./AdminNoticeWrite.php';
            else if(num == 2) {
                var is_idx=notice_board_form.document.getElementsByName(chk_board_no);
                if(is_idx='') {
                    alert("수정할 게시글을 선택한 뒤 수정하실 수 있습니다.");
                    notice_board_form.action='#';
                }
                notice_board_form.action='./AdminNoticeModify.php';
            }
            else {
                if(confirm('정말 선택하신 공지사항을 삭제하시겠습니까?')) {
                    notice_board_form.action='./NoticeDeleteProcess.php';
                }else {
                    notice_board_form.action='#';
                }
            }
        }
    </script>
</head>
<body>
    <!-- main page start { -->
    <div class="main-frame" style="text-align: center;">
        <?php include_once "Menu.php"; ?>
        
        <form name="notice_board_form" action="post">
        <div class="notice-board-table">
            <div class="right-board-list">
                <table>
                    <thead>
                        <th style="width: 75px">선택</th>
                        <th style="width: 725px">내용</th>
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
                                        <td><input type="radio" name="chk_board_no" value="'.$no.'"></td>
                                        <td class="subject" style="text-align: left;"><a href="./AdminNoticeView.php?board_idx='.$no.'"><p class="on-mouse-subject">'.$subject.'</p></td>
                                        <td class="date"><p>'.date("Y-m-d", $date).'</p></td>
                                    </tr>';
                                }

                            }else {
                                echo
                                '<tr>
                                    <td class="subject" colspan="3" style="text-align: center;">등록된 공지사항이 존재하지 않습니다.</td>
                                </tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <ul>
                    <li><input type="submit" class="btn-list" value="작성" style="position: relative; padding: 11px;" onclick="btn_click(1);"></li>
                    <li><input type="submit" class="btn-list" value="수정" style="position: relative; padding: 11px;" onclick="btn_click(2);"></li>
                    <li><input type="submit" class="btn-list" value="삭제" style="position: relative; padding: 11px;" onclick="btn_click(3);"></li>
                </ul>
            </div>
        </div>
        </form>

    </div>
    <!-- } main page end -->
</body>
</html>

<?php $conn->close(); ?>