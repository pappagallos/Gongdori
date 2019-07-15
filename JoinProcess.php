<meta charset="UTF-8">

<?php
    //connect database
    include_once './data/database/conn.php';
    include_once './security/security_function.php';
    check_block_user();

    //is check term and information
    if($_POST['chkterm'] == NULL && $_POST['chkterm'] != 1) {
        echo "<script>alert('이용약관을 동의해주셔야 회원가입이 가능합니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=Join.php'>";
        exit();

    }else if($_POST['chkinfo'] == NULL && $_POST['chkinfo'] != 1) {
        echo "<script>alert('개인정보처리방침을 동의해주셔야 회원가입이 가능합니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=Join.php'>";
        exit();
    }

    //get post method source
    $get_email=$_POST['email'];
    $get_password=$_POST['password'];

    global $denied_keyword;
    $max=sizeof($denied_keyword);
    for($repeat=0; $repeat<$max; $repeat++) {
        if(stripos($get_email, $denied_keyword[$repeat]) !== false) {
            echo '<script>alert("입력한 아이디 글자중에 사용금지된 키워드가 포함되어 있습니다.");</script>';
            echo "<meta http-equiv='refresh' content='0;url=Join.php'>";
            exit();
        }
        if(stripos($get_password, $denied_keyword[$repeat]) !== false) {
            echo '<script>alert("입력한 비밀번호 글자중에 사용금지된 키워드가 포함되어 있습니다.");</script>';
            echo "<meta http-equiv='refresh' content='0;url=Join.php'>";
            exit();
        }
    }

    //protect sql injection
    $get_email=mysqli_real_escape_string($conn, $_POST['email']);
    $get_password=mysqli_real_escape_string($conn, $_POST['password']);
    
    //hash encrypt password
    $hash_password=password_hash($get_password, PASSWORD_BCRYPT);

    //중복된 이메일이 있는지 검사
    $chk_exist_email='select count(email) from tbl_user where email="'.$get_email.'";';
    $chk_exist_result=$conn->query($chk_exist_email);

    if($chk_exist_result == true) {
        $row=$chk_exist_result->fetch_assoc();
        $is_exist=$row['count(email)'];

        if($is_exist >= 1) {
            echo '<script>alert("입력하신 이메일은 이미 사용중인 이메일 입니다.");</script>';
            echo "<meta http-equiv='refresh' content='0;url=Join.php'>";
            exit();
        }
    }

    //check input
    if($get_email == '') {
        echo "<script>alert('이메일을 입력해주세요.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=Join.php'>";
        exit();

    }else if($get_password == '') {
        echo "<script>alert('비밀번호를 입력해주세요.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=Join.php'>";
        exit();
    }

    //insert into table query
    $insert="insert into tbl_user (
            email,
            password,
            level,
            str_pre_date,
            end_pre_date,
            chk_pre,
            point,
            request_option) values ('".$get_email."', '".$hash_password."', 9, 0, 0, 0, 0, 0);";

    if($conn->query($insert) == true) {
        echo "<script>alert('회원가입이 완료되었습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";
        
    }else {
        echo "<script>alert('시스템 문제로 회원가입에 실패하였습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";
        exit();
    }

    $conn->close();
?>