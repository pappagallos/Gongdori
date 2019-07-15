<!--
    Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.03.18
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
    <style>
    td { border: 0; }
    </style>
</head>
<body>
    <!-- main page start { -->
    <div class="main-frame">
        <?php include_once "Menu.php"; ?>
        <div class="admin-lecture-table">
            <form action="./LectureWriteProcess.php" method="post">
            <div style="margin-bottom: 20px;"><span class="admin-title">강의추가</span></div>
            <table cellpadding="5" cellspacing="0">
                <tr>
                    <td class="admin-user-list" style="border-top-left-radius: 8px;">목록</td><td class="admin-user-list" style="border-top-right-radius: 8px;">입력란</td>
                </tr>
                <tr>
                    <td style="text-align: right; font-weight: 400;">강의제목</td><td><input type="text" name="lecture_title" class="admin-input-text" style="width: 250px;" maxlength="15"></td>
                </tr>
                <tr>
                    <td style="text-align: right; font-weight: 400;">강의설명</td><td><textarea name="lecture_discription" class="admin-input-text" style="width: 250px; height: 100px;" maxlength="37"></textarea></td>
                </tr>
                <tr>
                    <td style="text-align: right; font-weight: 400;">강의상태</td><td><input type="text" name="lecture_status" class="admin-input-text" style="width: 250px;" maxlength="20"></td>
                </tr>
                <tr>
                    <td style="text-align: right; font-weight: 400;">동영상URL</td><td><input type="text" name="lecture_str_movie_url" class="admin-input-text" style="width: 250px;"></td>
                </tr>
                <tr>
                    <td style="text-align: right; font-weight: 400;">이미지 파일명</td><td><input type="text" name="lecture_img" class="admin-input-text" style="width: 250px;"></td>
                </tr>
                <tr>
                    <td style="text-align: right; font-weight: 400;">개방여부</td><td><input type="radio" name="chk_open" value="1">열림<input type="radio" name="chk_open" size="15" value="0" style="margin-left: 15px;" checked>닫힘</td>
                </tr>
            </table>
            <input type="submit" class="btn" value="강의추가">
            </form>
        </div>
    </div>  
    <!-- } main page end -->
</body>
</html>

<?php $conn->close(); ?>