<!--
    Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.03.01
-->

<meta charset="UTF-8">

<?php
    include_once '../data/database/conn.php';
    include_once 'function/is_auth.php';

    $chk_err=0; //check error variable

    for($i=0;$i<3;$i++) {
        $query="update tbl_price set title='".$_POST['title'.$i]."', content='".$_POST['content'.$i]."', price='".$_POST['price'.$i]."', chk_open='".$_POST['using'.$i]."' where goods_option='".$_POST['goods_option'.$i]."';";
        $result=$conn->query($query);

        if(!$result) {
            echo "<script>alert('시스템에 장애가 발생하였습니다.');</script>";
            echo "<meta http-equiv='refresh' content='0;url=AdminPrice.php'>";
            exit();

        }else $chk_err++; //check error variable
    }

    //check modify
    if($chk_err=2) {
        echo "<script>alert('상품수정이 정상적으로 완료되었습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=AdminPrice.php'>";

    }else if($chk_err=1) {
        echo "<script>alert('상품수정이 부분적으로 완료되었습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=AdminPrice.php'>";

    }else {
        echo "<script>alert('상품수정이 실패하였습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=AdminPrice.php'>";
    }

    $conn->close();
?>