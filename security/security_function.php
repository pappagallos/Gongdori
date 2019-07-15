<!--
    Developer name is LEE WOOJIN.
    DAEJIN UNIV, Dept of computer engineering.
    2018.04.21
-->
<?php
//데이터베이스 연결
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gongdori";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->query("set session character_set_connection=utf8;");
$conn->query("set session character_set_results=utf8;");
$conn->query("set session character_set_client=utf8;");

if($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
}

/*
$servername = "localhost";
$username = "gongdori";
$password = "my0329my";
$dbname = "gongdori";

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->query("set session character_set_connection=utf8;");
$conn->query("set session character_set_results=utf8;");
$conn->query("set session character_set_client=utf8;");

//Check connection
if($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
}
*/

//금지 키워드 리스트 배열
$denied_keyword=array(
    'SELECT',
    'select',
    'FROM',
    'from',
    'WHERE',
    'where',
    'LIMIT',
    'limit',
    'UPDATE',
    'update',
    'UNION',    
    'union',
    'SCRIPT',
    'script',
    'VERSION()',
    'version()',
    'DATABASE()',
    'database()',
    'HOSTNAME()',
    'hostname()',
    'ORDER',
    'order',
    '0x',
    'information_schema',
    '#',
    '/*',
    '*/',
    ';%00', //null.
    '%23' //#.
);

// 금지된 키워드를 입력하였는지 검사하는 함수
function gongdori_scanning_keyword($keyword) {
    global $denied_keyword;
    global $conn;
    $max=sizeof($denied_keyword);

    for($repeat=0; $repeat<$max; $repeat++) {
        if(stripos($keyword, $denied_keyword[$repeat]) !== false) {
            $attacker_ip=$_SERVER['REMOTE_ADDR'];
            //echo '<script>alert("'.$keyword.'와 '.$denied_keyword[$repeat].'의 공격 아이피는 '.$attacker_ip.'");</script>';

            //현재 이용자 아이피를 데이터베이스 안에 있는 아이피와 비교하여 있으면 아이피 가져오기
            $get_ip_query='select ip, count from web_conn_block_system where ip="'.$attacker_ip.'";';
            $get_ip_result=$conn->query($get_ip_query);
            $row=$get_ip_result->fetch_assoc();
            $get_attacker_ip=$row['ip'];
            $get_attacker_count=$row['count'];
            $get_attacker_count++;
            
            //데이터베이스 안에 일치하는 아이피가 있었으면 전에도 공격한 이력이 있는 공격자로 간주하고 경고 횟수 증가
            if($get_attacker_ip == $attacker_ip) {

                //3회 이상 공격기록이 수집되면 아이피 이용차단
                if($get_attacker_count >= 3) {
                    $set_block_query='update web_conn_block_system set chk_block=1 where ip="'.$get_attacker_ip.'";';
                    $conn->query($set_block_query);
                    echo "<meta http-equiv='refresh' content='0;url=http://www.dothome.co.kr/expirationinfo/404.html'>";
                    exit();

                //공격 횟수가 3회 미만일 경우 경고 횟수 증가
                }else {
                    $set_warning_count_query='update web_conn_block_system set count='.$get_attacker_count.' where ip="'.$get_attacker_ip.'";';
                    $conn->query($set_warning_count_query);
                    echo "<meta http-equiv='refresh' content='0;url=AccessDenied.php'>";
                    exit();

                }

            //데이터베이스에 없는 아이피 였을 경우에는 차단 경고 아이피로 등록하고 경고
            }else {
                $set_enroll_ip_query='insert into web_conn_block_system (ip, count, chk_block) values ("'.$attacker_ip.'", 0, 0);';
                $set_enroll_result=$conn->query($set_enroll_ip_query);
                echo "<meta http-equiv='refresh' content='0;url=AccessDenied.php'>";
                exit();
            }

        }
    }
}

//차단된 유저인지 확인
function check_block_user() {
    global $conn;
    $attacker_ip=$_SERVER['REMOTE_ADDR'];
    $get_block_query='select chk_block from web_conn_block_system where ip="'.$attacker_ip.'";';
    $get_block_result=$conn->query($get_block_query);
    $row=$get_block_result->fetch_assoc();
    $get_block=$row['chk_block'];
    if($get_block >= 1 || $get_block < 0) {
        echo "<meta http-equiv='refresh' content='0;url=http://www.dothome.co.kr/expirationinfo/404.html'>";
        exit();
    }
}

//회원인지 확인
function is_user() {
    global $conn;
    session_start();
    //만약 로그인을 하지 않았을 경우 비정상적인 접근으로 간주
    if(!isset($_SESSION['user_email'])) {
        $attacker_ip=$_SERVER['REMOTE_ADDR'];

        //현재 이용자 아이피를 데이터베이스 안에 있는 아이피와 비교하여 있으면 아이피 가져오기
        $get_ip_query='select ip, count from web_conn_block_system where ip="'.$attacker_ip.'";';
        $get_ip_result=$conn->query($get_ip_query);
        $row=$get_ip_result->fetch_assoc();
        $get_attacker_ip=$row['ip'];
        $get_attacker_count=$row['count'];
        $get_attacker_count++;
        
        //데이터베이스 안에 일치하는 아이피가 있었으면 전에도 공격한 이력이 있는 공격자로 간주하고 경고 횟수 증가
        if($get_attacker_ip == $attacker_ip) {

            //3회 이상 공격기록이 수집되면 아이피 이용차단
            if($get_attacker_count >= 3) {
                $set_block_query='update web_conn_block_system set chk_block=1 where ip="'.$get_attacker_ip.'";';
                $conn->query($set_block_query);
                echo "<meta http-equiv='refresh' content='0;url=http://www.dothome.co.kr/expirationinfo/404.html'>";
                exit();

            //공격 횟수가 3회 미만일 경우 경고 횟수 증가
            }else {
                $set_warning_count_query='update web_conn_block_system set count='.$get_attacker_count.' where ip="'.$get_attacker_ip.'";';
                $conn->query($set_warning_count_query);
                echo "<meta http-equiv='refresh' content='0;url=AccessDenied.php'>";
                exit();

            }

        //데이터베이스에 없는 아이피 였을 경우에는 차단 경고 아이피로 등록하고 경고
        }else {
            $set_enroll_ip_query='insert into web_conn_block_system (ip, count, chk_block) values ("'.$attacker_ip.'", 0, 0);';
            $set_enroll_result=$conn->query($set_enroll_ip_query);
            echo "<meta http-equiv='refresh' content='0;url=AccessDenied.php'>";
            exit();
        }

    }
}
?>