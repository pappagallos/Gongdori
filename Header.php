<?php
    include_once './security/security_function.php';
    check_block_user();
?>
    <title>공도리</title>
    <!-- style -->
    <link rel="stylesheet" href="./style/default.css?v=1">
    <link rel="icon" href="./favicon.png">
    <!-- meta -->
    <meta charset="UTF-8">
    <meta http-equiv="Content-Script-Type" content="text/javascript">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-title" content="공도리" />
    <meta name="Referrer" content="origin">
    <meta name="robots" content="index,nofollow"/>
    <meta name="description" content="배우고 싶었던 컴퓨터 공부하고, 쉽게 배우고"/>
    <meta property="og:title" content="공도리">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://www.gongdori.co.kr/">
    <meta property="og:image" content="http://www.gongdori.co.kr/data/image/kakao-img-gongdori.png">
    <meta property="og:description" content="배우고 싶었던 컴퓨터 공부하고, 쉽게 배우고"/>
    <meta property="og:image:width" content="500"/>
    <meta property="og:image:height" content="250"/>
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="공도리">
    <meta name="twitter:url" content="http://www.gongdori.co.kr/">
    <meta name="twitter:image" content="http://www.gongdori.co.kr/data/image/kakao-img-gongdori.png">
    <meta name="twitter:description" content="배우고 싶었던 컴퓨터 공부하고, 쉽게 배우고"/>
    <meta name="keywords" content="공도리,재능나눔,나눔교육,무료강의,인터넷강의,이우진">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-115641259-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-115641259-1');

    // 실시간 시간 가져오기
    function getRealTimer() {
        let time = new Date();
        let realTimeZone = document.getElementById('time-zone');
        let timeHour = parseInt(time.getHours());
        let timeMinutes = parseInt(time.getMinutes());

        // 0을 표현하지 못하는 자바스크립트 getHours, getMinutes 함수를 위해 시간 검사 후 0 표현
        if(timeHour < 10 && timeMinutes >= 10) realTimeZone.innerHTML = '0' + timeHour + ' : ' + timeMinutes;
        else if(timeHour >= 10 && timeMinutes < 10) realTimeZone.innerHTML = timeHour + ' : 0' + timeMinutes;
        else if(timeHour < 10 && timeMinutes < 10) realTimeZone.innerHTML = '0' + timeHour + ' : 0' + timeMinutes;
        else realTimeZone.innerHTML = timeHour + ' : ' + timeMinutes;

        //1초마다 재귀
        setTimeout('getRealTimer()', '1000');
    }
    </script>