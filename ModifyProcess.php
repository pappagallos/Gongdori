<meta charset="UTF-8">

<?php
    include_once './security/security_function.php';
    check_block_user();
    is_user();

    //connect database
    include_once './data/database/conn.php';

    //get post method source
    $get_password=$_POST['password'];

    global $denied_keyword;
    $max=sizeof($denied_keyword);
    for($repeat=0; $repeat<$max; $repeat++) {
        if(stripos($get_password, $denied_keyword[$repeat]) !== false) {
            echo '<script>alert("입력한 비밀번호 글자중에 사용금지된 키워드가 포함되어 있습니다.");</script>';
            echo "<meta http-equiv='refresh' content='0;url=Mypage.php'>";
            exit();
        }
    }

    //protect sql injection
    $get_password=mysqli_real_escape_string($conn, $_POST['password']);

    //encrypt password
    $hash_password=password_hash($get_password, PASSWORD_BCRYPT);

    //select table query
    $query="update tbl_user set password='".$hash_password."' where email = '".$_SESSION['user_email']."';";

    $result=$conn->query($query);
    
    if($result) {
        echo "<script>alert('회원정보가 정상적으로 수정되었습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";

    }else {
        echo "<script>alert('회원정보 수정에 실패하였습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";
    }

    $conn->close();
?>