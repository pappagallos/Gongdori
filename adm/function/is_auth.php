<?php
    session_start();

    //접근하는데 우선 로그인을 했는지 여부 확인
    if(!isset($_SESSION['user_email'])) {
        echo "<meta http-equiv='refresh' content='0;url=http://www.dothome.co.kr/expirationinfo/404.html'>";
        exit();
    }

    //로그인 후 회원의 등급을 가져온다.
    $query="select level from tbl_user where email='".$_SESSION['user_email']."';";
    $result=$conn->query($query);
    if(!$result) {
        echo "<script>alert('시스템에 장애가 발생하였습니다.');</script>";
        exit();

    }else {
        $row=$result->fetch_assoc();
        $level=$row['level'];
    }

    //로그인을 하지 않았거나 회원의 등급이 1등급이 아닌 경우 없는 페이지로 출력
    if(!isset($_SESSION['user_email']) || $level!=1) {
        echo "<meta http-equiv='refresh' content='0;url=http://www.dothome.co.kr/expirationinfo/404.html'>";
        exit();
    }
?>