<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TX4BB79"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<? include_once $_SERVER["DOCUMENT_ROOT"]."/lib/menu.proc.php"; ?>
<!-- Navigation -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="https://zeusrpg.kr"><img src="/img/zeuslogo.gif?ver=1.0" width="40px" alt="파이브엠 인생모드 프리미엄 RPG 제우스 서버"> 𝑷𝒓𝒆𝒎𝒊𝒖𝒎 𝑹𝑷𝑮 𝒁𝑬𝑼𝑺</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item px-2">
            <a class="nav-link" href="/intro/">서버 소개</a>
          </li>
          <li class="nav-item dropdown px-2">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownGuide" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              	서버 가이드
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownGuide">
              <a class="dropdown-item" href="/guide/howtoplay">게임 접속 방법</a>
              <a class="dropdown-item" href="/guide/grades">등급(단계) 가이드</a>
              <a class="dropdown-item" href="/guide/rebirth">환생 가이드</a>
              <a class="dropdown-item" href="/guide/jobs/">직업 가이드</a>
              <a class="dropdown-item" href="/guide/equips">장비 가이드</a>
              <a class="dropdown-item" href="/guide/accessorys">장신구 가이드</a>
              <a class="dropdown-item" href="/guide/emblem">엠블럼 가이드</a>
              <a class="dropdown-item" href="/guide/donation">마일리지 가이드</a>
            </div>
          </li>
          <li class="nav-item dropdown px-2">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCommunity" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              	커뮤니티
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownCommunity">
              <a class="dropdown-item" href="/community/notice">공지사항</a>
              <a class="dropdown-item" href="/community/freeboard">자유 게시판</a>
              <a class="dropdown-item" href="/community/eventboard">이벤트 게시판</a>
              <a class="dropdown-item" href="/community/tipboard">꿀팁 게시판</a>
              <a class="dropdown-item" href="/community/qnaboard">질문 게시판</a>
              <!-- <a class="dropdown-item" href="#">GM 노트</a> -->
            </div>
          </li>
          <li class="nav-item px-2">
            <a class="nav-link" href="/ranking/">서버랭킹</a>
          </li>
		      <li class="nav-item dropdown px-2">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownShop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              	포인트
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownShop">
              <a class="dropdown-item" href="/point/pointshop">포인트 상점</a>
			        <a class="dropdown-item" href="/point/pointgame">포인트 게임</a>
            </div>
          </li>
		  <? if (isset($_SESSION['zeus_id'])) { ?>
		  <li class="nav-item dropdown px-2">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCommunity" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<span class="mb-0 text-sm  font-weight-bold"><?= $_SESSION['zeus_nickname'] ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownCommunity">
              <a class="dropdown-item" href="/mypage/pointlog">내 포인트 : <?= number_format(SQL_myPoint($_SESSION['user_id']))?></a>
              <a class="dropdown-item" href="/mypage/">마이페이지</a>
              <a class="dropdown-item" href="/mypage/buylog">아이템 구매내역</a>
              <a class="dropdown-item" href="/logout">로그아웃</a>
            </div>
          </li>
		  <? } else { ?>
		  <li class="nav-item px-2">
            <a class="nav-link" href="/login">로그인</a>
          </li>
		  <? }?>
        </ul>
      </div>
    </div>
  </nav>
