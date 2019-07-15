<!--
    THE GONGDORI Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.04.14
-->

<?php
    include_once '../data/database/conn.php';
    include_once 'function/is_auth.php';
?>

<!DOCTYPE HTML>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="../style/default.css">
    <link rel="stylesheet" href="../style/admin.css">   

</head>
<body>
    <!-- main page start { -->
    <div class="main-frame" style="text-align: center;">
        <?php include_once "Menu.php"; ?>

        <?php
        $get_customer_center_content='select no, email, question, que_time from tbl_customer_center where no='.$_GET['no'].';';
        $result=$conn->query($get_customer_center_content);
        if($result) {
            $row=$result->fetch_assoc();
            $no=$row['no'];
            $email=$row['email'];
            $question=$row['question'];
            $quetime=$row['que_time'];
        }
        ?>

        <div class="admin-customer-form-table">
            <div style="margin-bottom: 15px;"><span class="admin-title">문의관리</span></div>

            <form action="CustomerCenterWriteProcess.php" method="post">
                <input type="hidden" name="chk_customer_center_no" value="<?php echo $no; ?>">
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="admin-user-list" style="border-top-left-radius: 8px;">목록</td><td class="admin-user-list" style="border-top-right-radius: 8px;">입력란</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-weight: 400;">작성메일</td><td><input type="text" class="admin-input-text" style="width: 250px; background: rgba(0,0,0,0.3);" maxlength="15" value="<?php echo $email; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-weight: 400;">작성일자</td><td><input type="text" class="admin-input-text" style="width: 250px; background: rgba(0,0,0,0.3);" maxlength="15" value="<?php echo date("Y년 m월 d일 H시 i분 s초", $quetime); ?>" readonly></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-weight: 400;">문의내용</td><td><textarea class="admin-input-text" style="width: 250px; height: 100px; background: rgba(0,0,0,0.3);" readonly><?php echo $question; ?></textarea></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-weight: 400;">답변내용</td><td><textarea name="customer-center-reply" class="admin-input-text" style="width: 250px; height: 100px;" placeholder="답변할 내용을 입력해주세요." required></textarea></td>
                    </tr>
                </table>
                <input type="submit" class="btn" value="답변작성">

            </form>
        </div>
    </div>
    <!-- } main page end -->
</body>
</html>

<?php $conn->close(); ?>