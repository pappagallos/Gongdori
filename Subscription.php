<!--
    Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.02.25
-->
<?php
    include_once './data/database/conn.php';
    include_once './security/security_function.php';
    check_block_user();
    session_start();
?>

<!DOCTYPE HTML>
<html lang="kor">
<head>
    <?php include_once 'Header.php'; ?>
    <script language="javascript">
        function click_alert() {
            alert('죄송합니다. 현재 예정된 세미나가 없습니다.');
        }

        function please_login() {
            alert('구독신청 혹은 세미나 참가를 신청하시려면 로그인이 필요합니다.');
        }
    </script>
</head>
<body>
    <!-- main page start { -->
    <div class="main-frame">

        <!-- gongdori logo -->
        <div class="gongdori-logo">
            <img src="./data/image/gongdori-logo-200.png">
        </div>
        
        <?php 
        include_once './Menu.php';
        $query="select * from tbl_price;";
        $result=$conn->query($query);

        echo '<div class="subscription-table">';

        if($result->num_rows>0) {
            while($row=$result->fetch_assoc()) {
                $option=$row['goods_option'];
                $title=$row['title'];
                $price=$row['price'];
                $content=$row['content'];
                $chk_open=$row['chk_open'];

                if($chk_open==1) { //구독 신청 메뉴는 최대 3개까지, 그리고 사용할 경우 출력
                    if($option==1 && isset($_SESSION['user_email'])) echo '<a href="./Payment.php?goods_option='.$option.'">';
                    else if(!isset($_SESSION['user_email'])) echo '<a href="#" onClick="javascript:please_login();">';
                    else echo '<a href="#" onClick="javascript:click_alert();">';
                    echo '<div class="subscription-box">';
                    echo '<p><span class="subscription-title">'.$title.'</span></p>';
                    echo '<p><span class="subscription-content">';
                    echo $content;
                    echo '</span></p>';
                    echo '<span class="subscription-price">'.$price.'원</p>';
                    echo '</div>';
                    echo '</a>';
                }
            }
        }

        echo '</div>';
        ?>

    </div>
    <!-- } main page end -->

</body>
</html>

<?php $conn->close(); ?>