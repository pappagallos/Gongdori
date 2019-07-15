<!--
    Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.02.26
-->
<?php
    include_once './data/database/conn.php';
?>

<!DOCTYPE HTML>
<html lang="kor">
<head>
    <?php
    include_once 'Header.php';
    include_once './security/security_function.php';
    check_block_user();
    ?>

    <!--
        check for sign in javascript code
        2018.04.10
    -->
    <script language="javascript">
        function chkInputCheckBox() {
            form=document.signin; 
            var getEmail=form.email.value;
            var getPassword=form.password.value;
            var error = false;
            
            if(getEmail=='') {
                alert("사용할 이메일을 입력해주세요.");
                error = true;
                exit();
            }else error = false;
            
            if(getPassword=='') {
                alert("사용할 비밀번호를 입력해주세요.");
                error = true;
                signin.password.focus();
                exit();
            }else error = false;

            if(document.getElementsByName('chkterm')[0].checked == false) {
                alert("이용약관에 동의해주셔야 회원가입이 가능합니다.");
                error = true;
                exit();
            }else error = false;

            if(document.getElementsByName('chkinfo')[0].checked == false) {
                alert("개인정보처리방침에 동의해주셔야 회원가입이 가능합니다.");
                error = true;
                exit();
            }else error = false;

            if(error == false) {
                signin.action="JoinProcess.php";
            }
        }
    </script>
    
</head>
<body>
    <!-- main page start { -->
    <div class="main-frame" style="text-align: center;">
        <?php include_once "Menu.php"; ?>

        <!-- gongdori logo -->
        <div class="gongdori-logo">
            <img src="./data/image/gongdori-logo-200.png">
        </div>

        <div class="member-table">
            <p><span class='subscription-title'>신규회원가입</span></p>
            <form name="signin" method="post">
                <p><input type="email" name="email" class="input-text" placeholder="이메일" required></p>
                <p><input type="password" name="password" class="input-text" placeholder="비밀번호" required></p>
                <p><input type="checkbox" name="chkterm" value="1">공도리 <a href="./Term.php" class="link"><strong>이용약관</strong></a> 동의</p>
                <p><input type="checkbox" name="chkinfo" value="1">공도리 <a href="./Information.php" class="link"><strong>개인정보처리방침</strong></a> 동의</p>
                <p><input type="submit" value="회원가입" class="btn" onClick="chkInputCheckBox()"> <a href="./HomeMain.php" class="btn">돌아가기</a></p>
            </form>
        </div>
    </div>
    <!-- } main page end -->

</body>
</html>

<?php $conn->close(); ?>