<? include_once $_SERVER["DOCUMENT_ROOT"]."/lib/_admin.php" ?>


<?
$r = include $_SERVER["DOCUMENT_ROOT"].'/lib/_kickBanLog.php'; 

	$r_max_row 	= $r['arr']['max_row'];
	$r_page 	= $r['arr']['page'];
	$r_prev 	= $r['arr']['prev'];
	$r_next 	= $r['arr']['next'];
	$r_tot_cnt 	= $r['arr']['tot_cnt'];
	$r_list 	= $r['arr']['list'];

	$cur_page = $_GET['page'] ?? 1;
    if ($r_tot_cnt < $cur_page) $cur_page = $r_tot_cnt;
    $startPage = (($cur_page - 1) / 10) * 10 + 1 - 5;
    if($startPage <= 0) $startPage = 1;
    $endPage = $startPage + 10 - 1;
    if ($endPage > $r_tot_cnt) $endPage = $r_tot_cnt;


	if ($r_prev) {
		$r_page > 2 ?
			$prevUrl = "?page=".$r_prev : 
			$prevUrl = "";
}
?>

<? include $_SERVER["DOCUMENT_ROOT"]."/inc/head.php" ?>
	<title>FiveM AREA - 관리자페이지</title>
</head>

<? include $_SERVER["DOCUMENT_ROOT"]."/inc/header.php" ?>

<div class="container my-5" style="max-width:1300px">
	<div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
		<div class="header-body mb-3">
			<div class="row py-3">
				<div class="col-xl-12 col-lg-12 col-md-12 px-5 text-white">
					<h1>킥/밴 로그</h1>
					<p class="text-lead">홈페이지를 통한 킥/밴 로그를 확인할 수 있습니다.</p>
				</div>
			</div>
		</div>
	</div>

	<div class="card shadow text-white bg-secondary mb-3">
		<div class="card-header bg-dark">
			<h5 class="form-text fw-bold text-white">킥/밴 로그</h5>
		</div>
		<div class="card-body table-responsive">
			<div class="row">
				<div class="col-sm-8">
				</div>
				<div class="col-sm-4">
					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="고유번호로 로그를 검색해보세요." aria-label="고유번호로 로그를 검색해보세요." aria-describedby="button-addon" id="txt_userid">
						<button class="btn btn-dark" type="button" id="button-addon" onclick="idSearch($('#txt_userid').val());">검색</button>
					</div>
				</div>
			</div>
			<table class="table table-dark table-striped table-hover text-center align-items-center table-flush mg-table">
				<thead>
					<tr>
						<th>처리한 사람</th>
						<th>처리된 사람</th>
						<th>처리 종류</th>
						<th>처리 사유</th>
						<th>처리 일시</th>
					</tr>
				</thead>
				<tbody>
				<? foreach ($r_list as $el) { ?>
					<tr>
						<td><?=trim(str_replace('?', '', $el['give_nickname']))?> [<?=$el['give_id']?>]</td>
						<td><?=trim(str_replace('?', '', $el['take_nickname']))?> [<?=$el['take_id']?>]</td>
						<td class="<? 
                            if ($el['type'] == '밴') echo 'text-danger'; 
                            elseif ($el['type'] == '킥') echo 'text-warning'; 
                            elseif ($el['type'] == '밴해제') echo 'text-success'; 
                        ?> font-weight-bold"><?=$el['type']?></td>
						<td><?=$el['text']?></td>
						<td><?=$el['wdate']?></td>
					</tr>
				<? } ?>
				</tbody>
			</table>
			<nav aria-label="Page navigation">
				<ul class="pagination justify-content-end">
					<?if ($startPage > 1) {?><li class="page-item"><a class="page-link" href="?page=1">처음</a></li><?}?>
					<?if ($cur_page > 1) {?><li class="page-item"><a class="page-link" href="?page=<?=$cur_page - 1?>">이전</a></li><?}?>
					<? if ($r_tot_cnt) for ($i = $startPage; $i <= $endPage; $i++) { ?>
					<li class="page-item<?=$cur_page == $i ? ' active' : '' ?>">
						<a class="page-link" href="?page=<?=$i?>"><?=$i?></a>
					</li>
					<? } ?>
					<?if ($cur_page < $r_tot_cnt) {?><li class="page-item"><a class="page-link" href="?page=<?=$cur_page + 1?>">다음</a></li><?}?>
					<?if ($endPage < $r_tot_cnt) {?><li class="page-item"><a class="page-link" href="?page=<?=$r_tot_cnt?>">끝</a></li><?}?>
				</ul>

			</nav>
		</div>
	</div>
</div>


<? include $_SERVER["DOCUMENT_ROOT"]."/inc/footer.php" ?>

<script>
    function idSearch(num) {
        location.href='?user_id=' + num;
    }
</script>
</body>

</html>