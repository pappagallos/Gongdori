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
</head>
<body>
    <!-- main page start { -->
    <div class="main-frame">
        <?php include_once "Menu.php"; ?>
        <div class="admin-user-table">
            <form action="./LectureProcess.php" method="post">
            <div style="margin-bottom: 20px;"><span class="admin-title">강의추가</span></div>
            <table>
                <tr>
                    <td>첨부 이미지 파일명</td><td><input type="text" name="file_name" size="15"></td>
                </tr>
                <tr>
                    <td>강의제목</td><td><input type="text" name="lecture_title" size="15"></td>
                </tr>
                <tr>
                    <td>강의 한줄 설명</td><td><input type="text" name="lecture_discription" size="15"></td>
                </tr>
                <tr>
                    <td>강의상태</td><td><input type="text" name="lecture_status" size="15"></td>
                </tr>
                <tr>
                    <td>개방여부</td><td><input type="radio" name="lecture_open" size="15" value="1">열림/<input type="radio" name="lecture_open" size="15" value="1">닫힘</td>
                </tr>
            </table>
            <input type="submit" class="btn">강의추가</a>
            </form>
        </div>
    </div>  
    <!-- } main page end -->
</body>
</html>

<?php $conn->close(); ?>