<? include_once $_SERVER["DOCUMENT_ROOT"]."/lib/_admin.php" ?>

<? include $_SERVER["DOCUMENT_ROOT"]."/inc/head.php" ?>
	<title>FiveM AREA - 관리자페이지</title>
</head>

<? include $_SERVER["DOCUMENT_ROOT"]."/inc/header.php" ?>

    <!-- Main content -->
<div class="container my-5">
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
        <div class="container">
            <div class="header-body mb-3">
            <div class="row py-3">
                <div class="col-xl-12 col-lg-12 col-md-12 px-5 text-white">
                    <h1>권한 삭제</h1>
                    <p class="text-lead">그룹 코드를 이용하여 권한을 삭제할 수 있습니다.</p>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow bg-secondary border-0 mb-0">
                    <div class="card-header bg-dark">
                        <h5 class="form-text fw-bold text-white">권한 삭제하기</h5>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" action="/lib/_admin.php" method="post">
                            <div class="form-group">
                                <span class="form-text h6 fw-bold text-light">삭제할 고유번호</span>
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" name="take_id" placeholder="고유번호를 입력하세요." type="tel">
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-primary my-4" onclick="removeGroup('req=checkId&' + $(this.form).serialize());">닉네임 확인</button>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-success my-4" onclick="removeGroup('req=getGroups&' + $(this.form).serialize());">소유 권한 불러오기</button>
                            </div>
                            <div class="form-group">
                                <label for="group_code" class="form-text h6 fw-bold text-light">삭제할 그룹 코드</label>
								<select class="form-control" name="group_code" class="form-control" id="group_code">
                                    <option value="">--선택--</option>
								</select>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-danger my-4" onclick="removeGroup('req=removeGroup&' + $(this.form).serialize());">삭제하기</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

	<? include $_SERVER["DOCUMENT_ROOT"]."/inc/footer.php" ?>

    <script>
    function removeGroup(data) {

        if (document.xhr) {
            alert('처리중입니다. 잠시만 기다려주세요.');
            return;
        } 

        document.xhr = $.ajax({
            url: '/lib/_admin.php',
            data: data,
            type:'post',
            dataType: "json",
            success:function(r){
                if (r.state == "success") {
                    alert(r.arr.nickname + "[" + r.arr.user_id + ']님의 [' + r.arr.groupcode + '] 그룹 삭제 완료');
                    location.reload();
                } else if (r.state == "nickname") {
                    alert("[" + r.arr.user_id + ']님의 닉네임 : ' + r.arr.nickname);
                } else if (r.state == "block") {
                    alert("삭제가 제한 된 권한입니다.");
                } else if (r.state == "groupcode") {
                    alert(r.arr.nickname + "[" + r.arr.user_id + ']님의 권한을 불러왔습니다.');
                    $('#group_code').html(`<option value="">--선택--</option>`);
                    r.arr.codes.forEach(v => $('#group_code').append(`<option value="${v}">${v}</option>`));
                } else {
                    alert(r.state);
                }
            }, error:function(request, status, error){
                console.log(request, status, error);
            }, complete:function(){
                document.xhr = false;
            }
        });
    }
    </script>
</body>

</html>