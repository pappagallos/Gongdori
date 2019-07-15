<meta charset="UTF-8">

<?php
    include_once './security/security_function.php';
    check_block_user();
    is_user();

    //connect database
    include_once './data/database/conn.php';

    $get_msg_no=$_GET['msg_no'];
    $get_email=$_SESSION['user_email'];

    //SQL injection 예방
    $get_msg_no=$conn->real_escape_string($get_msg_no);
    $get_email=$conn->real_escape_string($get_email);

    //msg_no을 이용해 GET으로 보낸 이메일을 가져와서 현재 로그인 된 SESSION 이메일과 비교하기 위해 불러온 이메일을 변수에 저장
    $query='select email from tbl_customer_center where no="'.$get_msg_no.'";';
    $result=$conn->query($query);
    if($result) {
        $row=$result->fetch_assoc();
        $get_db_email=$row['email']; //msg_no 로 통해 보낸 이메일을 get_email에 저장한다. 문의를 작성한 작성자의 email이 저장된다.
    }

    if(!strcmp($get_email, $get_db_email)) {
        //select table query
        $query='delete from tbl_customer_center where no="'.$get_msg_no.'" and email="'.$get_email.'";';
        $result=$conn->query($query);
        
        if($result) {
            echo "<script>alert('정상적으로 삭제되었습니다.');</script>";
            echo "<meta http-equiv='refresh' content='0;url=CustomerCenter.php'>";
            exit();

        }else {
            echo "<script>alert('삭제하는데 문제가 발생하였습니다.');</script>";
            echo "<meta http-equiv='refresh' content='0;url=CustomerCenter.php'>";
            exit();
        }

    }else {
        echo "<script>alert('비정상적인 값이 감지되었으며 이러한 행위가 반복될 경우 접속이 차단됩니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=CustomerCenter.php'>";
        exit();
    }

    $conn->close();
?>