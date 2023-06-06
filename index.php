
<? include $_SERVER["DOCUMENT_ROOT"]."/inc/head.php" ?>
<? if (isset($_SESSION['area_id'])) { echo "<script>location.href='/adm/giveItem';</script>"; } ?>
  <title>Korea FiveM AREA - 로그인</title>
</head>

<? include $_SERVER["DOCUMENT_ROOT"]."/inc/header.php" ?>
<!-- Main content -->
<div class="container my-5" style="min-height:675px">
	<!-- Header -->
	<div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
		<div class="container">
			<div class="header-body text-center mb-3">
			<div class="row justify-content-center py-3 text-white">
				<div class="col-xl-5 col-lg-6 col-md-8 px-5">
				<h1>FiveM AREA Server</h1>
				<p class="text-lead">Welcome AREA</p>
				</div>
			</div>
			</div>
		</div>
	</div>
    <!-- Page content -->
    <div class="container pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card shadow bg-secondary border-0 mb-3">
            <div class="card-body px-lg-5 py-lg-5">
              <form role="form" action="/lib/_login.php" method="post">
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                    </div>
                    <input class="form-control" name="area_id" placeholder="아이디" type="text" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" name="area_pw" placeholder="비밀번호" type="password" required>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">로그인</button>
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