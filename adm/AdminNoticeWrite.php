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
        <form action="./NoticeWriteProcess.php" method="post">
            <div class="notice-board-table">
                <table style="width: 100%;">
                    <tr>
                        <td width="15%" style="letter-spacing: -0.1em; font-weight: 500;">게시글 제목</td>
                        <td style="padding: 6px 6px 6px 0;"><input type="text" class="admin-input-text" name="subject" max-length="100" style="width: 100%;" placeholder="제목을 작성해주세요." value=""></td>
                    </tr>
                    <tr>
                        <td width="15%" style="letter-spacing: -0.1em; font-weight: 500;">게시글 내용</td>
                        <td style="padding: 6px 6px 6px 0;"><textarea name="content" class="admin-input-text" style="width: 100%; height: 400px;" placeholder="글을 작성해주세요."></textarea></td>
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