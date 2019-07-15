<!--
    Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.05.03
-->
<meta charset="UTF-8">

<?php
    include_once '../data/database/conn.php';
    include_once './function/is_auth.php';
    include_once '../security/security_function.php';

    $subject=$_POST['subject'];
    $content=nl2br($_POST['content']); //nl2br 개행문자(엔터)를 <br>로 바꾸어 저장해주는 함수
    gongdori_scanning_keyword($content); //보안 함수
    gongdori_scanning_keyword($subject);

    $query='insert into tbl_notice (subject, content, date)
                                    values ("'.$subject.'", "'.$content.'", '.time().');';
    $result=$conn->query($query);
    if(!$result) {
        echo "<script>alert('시스템에 장애가 발생하였습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=AdminNotice.php'>";
        exit();

    }else {
        echo "<script>alert('공지사항이 성공적으로 작성되었습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=AdminNotice.php'>";
    }

    $conn->close();
?>