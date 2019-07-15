<!--
    Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.03.20
-->
<?php
    include_once '../data/database/conn.php';
    include_once 'function/is_auth.php';

    $get_lecture_sum='select count(lecture_no) from tbl_lecture_list;';
    $result=$conn->query($get_lecture_sum);
    if($result) {
        $row=$result->fetch_assoc();
        $lecture_sum=$row['count(lecture_no)'];
    }
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
            <form action="./LectureBoardWriteProcess.php" method="post">
            <div style="margin-bottom: 20px;"><span class="admin-title">강좌추가</span></div>
            <table cellpadding="5" cellspacing="0">
                <tr>
                    <td class="admin-user-list" style="border-top-left-radius: 8px;">목록</td><td class="admin-user-list" style="border-top-right-radius: 8px;">입력란</td>
                </tr>
                <tr>
                    <td style="text-align: right; font-weight: 400;">강좌분류</td>
                    <td>
                        <select name="lecture_rel_no">
                            <option value="">강좌분류선택</option>
                            <?php
                            $get_lecture_info='select lecture_no, lecture_title from tbl_lecture_list;';
                            $result=$conn->query($get_lecture_info);
                            $index=0;
                            if($result) {
                                while($row=$result->fetch_assoc()) {
                                    $lecture_no[$index]=$row['lecture_no'];
                                    $lecture_title[$index++]=$row['lecture_title'];
                                }
                            }
                            for($cnt=0; $cnt<$lecture_sum; $cnt++) {
                                echo '<option value="'.$lecture_no[$cnt].'">'.$lecture_title[$cnt].'</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right; font-weight: 400;">강좌제목</td><td><input type="text" name="lecture_subject" class="admin-input-text" style="width: 250px;" maxlength="15"></td>
                </tr>
                <tr>
                    <td style="text-align: right; font-weight: 400;">강좌설명</td><td><textarea name="lecture_content" class="admin-input-text" style="width: 250px; height: 100px;"></textarea></td>
                </tr>
                <tr>
                    <td style="text-align: right; font-weight: 400;">동영상URL</td><td><input type="text" name="lecture_movie_url" class="admin-input-text" style="width: 250px;"></td>
                </tr>
                <tr>
                    <td style="text-align: right; font-weight: 400;">첨부파일제목</td><td><input type="text" name="lecture_download_name" class="admin-input-text" style="width: 250px;" maxlength="30"></td>
                </tr>
                <tr>
                    <td style="text-align: right; font-weight: 400;">첨부파일URL</td><td><input type="text" name="lecture_download_url" class="admin-input-text" style="width: 250px;"></td>
                </tr>
            </table>
            <input type="submit" class="btn" value="강좌추가">
            </form>
        </div>
    </div>  
    <!-- } main page end -->
</body>
</html>

<?php $conn->close(); ?>