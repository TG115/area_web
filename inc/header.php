<body>
<!-- Navigation -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="/"><img src="/img/area.png?ver=1.0" width="40px"> Korea FiveM AREA</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
		  <? if (isset($_SESSION['area_id'])) { ?>
        <li class="nav-item dropdown px-2">
          <a class="nav-link dropdown-toggle text-success" href="#" id="adm_ingame" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mb-0 text-sm">인게임 설정</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adm_ingame">
            <a class="dropdown-item" href="/adm/playerKick">플레이어 킥</a>
            <a class="dropdown-item" href="/adm/playerBan">플레이어 밴</a>
            <a class="dropdown-item" href="/adm/playerUnban">플레이어 밴 해제</a>
          </div>  
        </li>
        <li class="nav-item dropdown px-2">
          <a class="nav-link dropdown-toggle text-warning" href="#" id="adm_item" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mb-0 text-sm">유저 지급 관리</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adm_item">
            <a class="dropdown-item" href="/adm/giveItem">아이템 지급</a>
            <hr>
            <a class="dropdown-item" href="/adm/giveCar">차량 지급</a>
            <a class="dropdown-item" href="/adm/removeCar">차량 삭제</a>
            <hr>
            <a class="dropdown-item" href="/adm/giveGroup">권한 지급</a>
            <a class="dropdown-item" href="/adm/removeGroup">권한 삭제</a>
          </div>
        </li>
        <li class="nav-item dropdown px-2">
          <a class="nav-link dropdown-toggle text-danger" href="#" id="adm_log" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mb-0 text-sm">로그 관리</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adm_log">
            <a class="dropdown-item" href="/adm/giveLog">아이템 지급 로그</a>
            <a class="dropdown-item" href="/adm/quickLog">퀵배송 로그</a>
            <hr>
            <a class="dropdown-item" href="/adm/kickBanLog">킥/밴 로그</a>
            <hr>
            <a class="dropdown-item" href="/adm/carLog">차량 로그</a>
            <hr>
            <a class="dropdown-item" href="/adm/groupLog">권한 로그</a>
          </div>  
        </li>
		    <li class="nav-item dropdown px-2">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCommunity" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mb-0 text-sm  font-weight-bold"><?= $_SESSION['area_nickname'] ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownCommunity">
            <a class="dropdown-item" href="/logout">로그아웃</a>
          </div>
        </li>
		  <? } else { ?>
		  <li class="nav-item px-2">
            <a class="nav-link" href="/">로그인</a>
          </li>
		  <? }?>
        </ul>
      </div>
    </div>
  </nav>
