<!--
    Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.02.28
-->
<?php
    include_once '../data/database/conn.php';
    include_once './function/is_auth.php';
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
        
        <div class="admin-price-table">
            <span class="admin-title">상품관리</span>
            <form action="PriceModifyProcess.php" method="post">
                <?php
                $query="select * from tbl_price;";
                $result=$conn->query($query);
                if(!$result) {
                    echo "<script>alert('시스템에 장애가 발생하였습니다.');</script>";
                    exit();
                }else { 
                    if($result->num_rows > 0) {
                        $count=0;
                        while($row=$result->fetch_assoc()) {
                            $option=$row['goods_option'];
                            $title=$row['title'];
                            $content=$row['content'];
                            $price=$row['price'];
                            $chk_open=$row['chk_open'];
                            
                            echo '<input type="hidden" name="goods_option'.$count.'" value="'.$option.'">';
                            echo '<div class="admin-price-box">';
                            echo '<p><span class="admin-content">상품제목</span> <input type="text" class="admin-input-text" name="title'.$count.'" value="'.$title.'"></p>';
                            echo '<p><span class="admin-content" style="position: relative; bottom: 100px;">상품설명</span> <textarea name="content'.$count.'" class="admin-input-text" rows="5">'.$content.'</textarea></p>';
                            echo '<p><span class="admin-content">상품요금</span> <input type="text" class="admin-input-text" name="price'.$count.'" value="'.$price.'" style="letter-spacing: 0.1em;"></p>';
                            if($chk_open==1) { 
                                echo '<p><input type="radio" name="using'.$count.'" value="1" checked>사용 <input type="radio" name="using'.$count.'" value="0">미사용</p>';
                            }else {
                                echo '<p><input type="radio" name="using'.$count.'" value="1">사용 <input type="radio" name="using'.$count.'" value="0" checked>미사용</p>';
                            }
                            echo '</div>';

                            $count++;
                        }
                    }
                }
                ?>
                <p><input type="submit" class="btn" value="요금수정" style="margin-top: 50px;"></p>
            </form>
        </div>
    </div>  
    <!-- } main page end -->
</body>
</html>

<?php $conn->close(); ?>