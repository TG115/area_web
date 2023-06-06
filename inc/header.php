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
          <a class="nav-link dropdown-toggle" style="color:mediumpurple" href="#" id="adm_item" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mb-0 text-sm">아이템 관리</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adm_item">
            <a class="dropdown-item" href="/adm/giveItem">아이템 지급</a>
            <a class="dropdown-item" href="/adm/giveLog">아이템 지급 로그</a>
            <hr>
            <a class="dropdown-item" href="/adm/quickLog">퀵배송 로그</a>
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
