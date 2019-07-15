<!--
    THE GONGDORI Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.05.04
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
        <form action="./NoticeModifyProcess.php" method="post">
            <input type="hidden" name="chk_board_no" value="<?php echo $_GET['chk_board_no']; ?>">
            <?php
            //공지사항 수정폼 콘텐츠 불러오기
            $get_notice_board_query='select no, subject, content from tbl_notice where no='.$_GET['chk_board_no'].';';
            $get_notice_result=$conn->query($get_notice_board_query);
            if($get_notice_result == true) {
                $row=$get_notice_result->fetch_assoc();
                $no=$row['no'];
                $subject=$row['subject'];
                $content=str_replace("<br />", "\r\n", $row['content']);
            }
            ?>
            <div class="notice-board-table">
                <table style="width: 100%;">
                    <tr>
                        <td width="15%" style="letter-spacing: -0.1em; font-weight: 500;">게시글 제목</td>
                        <td style="padding: 6px 6px 6px 0;"><input type="text" class="admin-input-text" name="subject" max-length="100" style="width: 100%;" placeholder="제목을 작성해주세요." value="<?php echo $subject; ?>"></td>
                    </tr>
                    <tr>
                        <td width="15%" style="letter-spacing: -0.1em; font-weight: 500;">게시글 내용</td>
                        <td style="padding: 6px 6px 6px 0;"><textarea name="content" class="admin-input-text" style="width: 100%; height: 400px;" placeholder="글을 작성해주세요."><?php echo $content; ?></textarea></td>
                    </tr>
                </table>
            </div>
            <input type="submit" value="작성">
        </form>
    </div>
    <!-- } main page end -->
</body>
</html>

<?php $conn->close(); ?>