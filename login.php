
<? include $_SERVER["DOCUMENT_ROOT"]."/inc/head.php" ?>
<? if (isset($_SESSION['zeus_id'])) { echo "<script>location.href='/';</script>"; } ?>
  <title>Premium RPG ZEUS - 로그인</title>
  <meta name="description" content="GTA 인생모드(FiveM) 제우스 서버 홈페이지에 로그인하여 다양한 혜택을 받아보세요." />
	<meta property="og:description" content="GTA 인생모드(FiveM) 제우스 서버 홈페이지에 로그인하여 다양한 혜택을 받아보세요." />
	<meta property="og:title" content="Premium RPG ZEUS - 로그인" />
</head>

<body>
<? include $_SERVER["DOCUMENT_ROOT"]."/inc/header.php" ?>
<!-- Main content -->
<div class="container my-5">
	<!-- Header -->
	<div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
		<div class="container">
			<div class="header-body text-center mb-3">
			<div class="row justify-content-center py-3">
				<div class="col-xl-5 col-lg-6 col-md-8 px-5">
				<h1>Premium RPG ZEUS</h1>
				<p class="text-lead">ZEUS 서버 공식 홈페이지에 오신 것을 환영합니다.</p>
				</div>
			</div>
			</div>
		</div>
	</div>
    <!-- Page content -->
    <div class="container pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card shadow bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5">
              <form role="form" action="login.proc.php" method="post">
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                    </div>
                    <input class="form-control" name="zeus_id" placeholder="아이디" type="text" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" name="zeus_pw" placeholder="비밀번호" type="password" required>
                  </div>
                </div>
                <div class="text-center">
                  <button type="button" class="btn btn-dark my-4 mr-4" onclick="location.href='/signup'">회원가입</button>
                  <button type="submit" class="btn btn-primary my-4">로그인</button>
                </div>
                <div class="text-center">
                  <a href="/findID" class="text-white-50">아이디 찾기</a> | <a href="findPW" class="text-white-50">비밀번호 찾기</a> 
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <? include $_SERVER["DOCUMENT_ROOT"]."/inc/footer.php" ?>

</body>
</html>