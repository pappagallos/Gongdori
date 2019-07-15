<meta charset="UTF-8">

<?php
    //connect database
    include_once './data/database/conn.php';
    include_once './security/security_function.php';
    check_block_user();

    //get post method source
    $get_email=$_POST['email'];
    $get_password=$_POST['password'];

    //입력한 키워드 검사
    gongdori_scanning_keyword($get_email);
    gongdori_scanning_keyword($get_password);

    //protect sql injection
    $get_email=mysqli_real_escape_string($conn, $_POST['email']);
    $get_password=mysqli_real_escape_string($conn, $_POST['password']);

    //select table query
    $query=sprintf("select email, level, password from tbl_user where email='%s';", addslashes($get_email));

    //get member info
    $result=$conn->query($query);
    if(!$result) {
        echo "<script>alert('이메일 혹은 비밀번호가 올바르지 않습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";
        exit();
    }
    
    $row=$result->fetch_assoc();
    $user_email=$row['email'];
    $user_level=$row['level'];
    $hash_password=$row['password'];

    //close database
    $conn->close();
    
    if(!strcmp($user_email, $get_email) && password_verify($get_password, $hash_password) && $user_level>1) {
        session_start();
        $_SESSION['user_email']=$get_email;
        echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";
        exit();

    }else if(!strcmp($user_email, $get_email) && password_verify($get_password, $hash_password) && $user_level<=1) {
        session_start();
        $_SESSION['user_email']=$get_email;
        echo "<meta http-equiv='refresh' content='0;url=adm/AdminMain.php'>";
        exit();

    }else {
        echo "<script>alert('이메일 혹은 비밀번호가 올바르지 않습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=HomeMain.php'>";
        exit();
    }
?>