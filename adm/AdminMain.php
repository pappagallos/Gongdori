<!--
    Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.02.28
-->
<?php
    include_once '../data/database/conn.php';
    include_once 'function/is_auth.php';
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
        
    </div>
    <!-- } main page end -->
</body>
</html>

<?php $conn->close(); ?>