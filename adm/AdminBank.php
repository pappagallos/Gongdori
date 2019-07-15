<!--
    Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.02.28
-->
<?php
    include_once '../data/database/conn.php';
    include_once 'function/is_auth.php';

    $query="select * from tbl_bank";
    $result=$conn->query($query);
    if(!$result) {
        echo "<script>alert('시스템에 장애가 발생하였습니다.');</script>";
        exit();

    }else {
        $row=$result->fetch_assoc();
        $bank_name=$row['bank_name'];
        $account_name=$row['account_name'];
        $account_number=$row['account_number'];
    }
?>

<!DOCTYPE HTML>
<html lang="kor">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="../style/default.css">
    <link rel="stylesheet" href="../style/admin.css">
</head>
<body>
    <!-- main page start { -->
    <div class="main-frame">
        <?php include_once "Menu.php"; ?>
        
        <div class="admin-bank-table">
            <span class="admin-title">무통장입금 계좌관리</span>
            <form action="BankModifyProcess.php" method="post">
                <p><span class="admin-content">은행이름</span> <input type="text" class="input-text" name="bank_name" value="<?php echo $bank_name; ?>"></p>
                <p><span class="admin-content">예금주명</span> <input type="text" class="input-text" name="account_name" value="<?php echo $account_name; ?>"></p>
                <p><span class="admin-content">계좌번호</span> <input type="text" class="input-text" name="account_number" value="<?php echo $account_number; ?>"></p>
                <p><input type="submit" class="btn" value="계좌수정"></p>
            </form>
        </div>
    </div>  
    <!-- } main page end -->
</body>
</html>

<?php $conn->close(); ?>