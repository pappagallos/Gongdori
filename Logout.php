<?php
    include_once './data/database/conn.php';
    include_once './security/security_function.php';
    check_block_user();
    is_user();

    if(!isset($_SESSION['user_email'])) {
        echo "<script>alert('로그인 된 회원정보가 없습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";
    }
    
    session_unset();
    session_destroy();
    echo "<script>alert('정상적으로 로그아웃 되었습니다.');</script>";
    echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";
?>