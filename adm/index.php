
<? include_once $_SERVER["DOCUMENT_ROOT"]."/lib/_admin.php" ?>


<? include $_SERVER["DOCUMENT_ROOT"]."/inc/head.php" ?>

	<title>FiveM AREA - 관리자페이지</title>
    <link rel="stylesheet" href="/asset/css/adm.css?1">
</head>

<? include $_SERVER["DOCUMENT_ROOT"]."/inc/header.php" ?>

    
<div class="container2">

<div id="background"></div>

<div class="text-box">
    <div class="text-glow">
    [ 세상 어디에도 없던, 특별한 아레아 ]<br><br>
    가슴 따듯한 이들이 모인 이곳은<br> 아레아 서버 관리자 홈페이지 입니다.
    </div>
</div>

</div>

<? include $_SERVER["DOCUMENT_ROOT"]."/inc/footer.php" ?>

<script>
    (function() {
        // Add event listener
        document.addEventListener("mousemove", parallax);
        const elem = document.querySelector("#background");
        // Magic happens here
        function parallax(e) {
            let _w = window.innerWidth/10;
            let _h = window.innerHeight/10;
            let _mouseX = e.clientX;
            let _mouseY = e.clientY;
            let _depth1 = `${10 - (_mouseX - _w) * 0.01}% ${10 - (_mouseY - _h) * 0.01}%`;
            let x = `${_depth1}`;
            elem.style.backgroundPosition = x;
        }
    })();
</script>
</body>

</html>