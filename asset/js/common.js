function setting_code(user_id) {
    if (user_id == "") {
        alert('고유번호를 입력해주세요!');
        $('input[name="zeus_user_id"]').focus();
    } else {

        $.ajax({
            url: '/lib/signup.proc.php',
            data: {'req' :'setCode', 'user_id': user_id},
            type:'post',
            dataType: "json",
            success:function(r){
                if (r.state == "NOACCOUNT") {
                    alert('제우스 서버에 가입된 고유번호가 아닙니다.\n만약 가입되어 있다면 서버 접속 후 재시도해주세요.');
                } else {
                    if (r.state == "OK") {
                        alert('인증코드를 발송하였습니다.\n서버에 접속하여 코드를 확인해주세요.');
                    } else if (r.state == "HASCODE") {
                        alert('이미 인증코드를 발송하였습니다.\n서버에 접속하여 코드를 확인해주세요.');
                    }
                    $('#frm_code').html(' \
                        <div class="input-group input-group-merge input-group-alternative"> \
                            <div class="input-group-prepend"> \
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span> \
                            </div> \
                                <input class="form-control" name="zeus_code" placeholder="인증번호를 입력하세요." required> \
                            </div> \
                        <div class="form-text text-white-50 mini-info">제우스 서버에 접속하여 휴대폰(K) -> [관리] -> [홈페이지 인증코드] 메뉴를 통해 확인하실 수 있습니다.</div> \
                    ');
                }
            }, error:function(request, status, error){
                console.log(request, status, error);
            }, complete:function(){
                document.xhr = false;
            }
        });
    }
}

function checkSpace(str) { 
    if(str.search(/\s/) != -1) { 
        return true; 
    } else { 
        return false; 
    }
} 

// 특수 문자가 있나 없나 체크 
function checkSpecial(str) { 
    var special_pattern = /[`~!@#$%^&*|\\\'\";:\/?]/gi; 
    if(special_pattern.test(str) == true) { 
        return true; 
    } else { 
        return false; 
    } 
} 

// 비밀번호 패턴 체크 (8자 이상, 문자, 숫자, 특수문자 포함여부 체크) 
function checkPasswordPattern(str) { 
    var pattern1 = /[0-9]/; // 숫자 
    var pattern2 = /[a-zA-Z]/; // 문자 
    var pattern3 = /[~!@#$%^&*()_+|<>?:{}]/; // 특수문자 
    if(!pattern1.test(str) || !pattern2.test(str) || !pattern3.test(str) || str.length < 8) { 
        return true; 
    } else { 
        return false; 
    } 
}

function signup(data) {

    if (document.xhr) {
        alert('처리중입니다. 잠시만 기다려주세요.');
        return;
    } 

    if (checkSpace($('input[name="zeus_id"]').val())) {
        alert('아이디에 공백을 제거해주세요.');
        return;
    }

    if (checkSpecial($('input[name="zeus_id"]').val())) {
        alert('아이디에 특수문자를 사용하실 수 없습니다.');
        return;
    }

    if (checkPasswordPattern($('input[name="zeus_pw"]').val())) {
        alert("비밀번호는 8자리 이상 문자, 숫자, 특수문자로 구성하여야 합니다."); 
        return;
    }

    if (checkSpace($('input[name="zeus_user_id"]').val())) {
        alert('고유번호에 공백을 제거해주세요.');
        return;
    }

    if (typeof $('input[name="zeus_code"]').val() != 'undefined') {
        if (checkSpace($('input[name="zeus_code"]').val())) {
            alert('인증번호에 공백을 제거해주세요.');
            return;
        }
    }

    
    
    document.xhr = $.ajax({
        url: '/lib/signup.proc.php',
        data: data,
        type:'post',
        dataType: "json",
        success:function(r){
            if (r.state == "OK") {
                alert('회원가입이 완료되었습니다.');
                location.href = "/";
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

function changePW(data) {

    if (document.xhr) {
        alert('처리중입니다. 잠시만 기다려주세요.');
        return;
    } 

    if (checkPasswordPattern($('input[name="zeus_pw"]').val())) {
        alert("비밀번호는 8자리 이상 문자, 숫자, 특수문자로 구성하여야 합니다."); 
        return;
    }
    
    document.xhr = $.ajax({
        url: '/mypage/mypage.proc.php',
        data: data,
        type:'post',
        dataType: "json",
        success:function(r){
            if (r.state == "OK") {
                alert('비밀번호가 변경되었습니다.');
                location.href = "/";
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

function changePW2(data) {

    if (document.xhr) {
        alert('처리중입니다. 잠시만 기다려주세요.');
        return;
    } 

    if (checkPasswordPattern($('input[name="zeus_pw"]').val())) {
        alert("비밀번호는 8자리 이상 문자, 숫자, 특수문자로 구성하여야 합니다."); 
        return;
    }
    
    document.xhr = $.ajax({
        url: '/findinfo.proc.php',
        data: data,
        type:'post',
        dataType: "json",
        success:function(r){
            if (r.state == "OK") {
                alert('비밀번호가 변경되었습니다.');
                location.href = "/login";
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

function game_rcp(data) {

    if (document.xhr) {
        alert('처리중입니다. 잠시만 기다려주세요.');
        return;
    } 

    document.xhr = $.ajax({
        url: '/point/pointgame.proc.php',
        data: data,
        type:'post',
        dataType: "json",
        success:function(r){

            if (r.state == "practice") {
                if (r.arr.result == "win") {
                    alert("상대가 " + r.arr.server_rcp + "를 내어 승리했습니다!");
                } else if (r.arr.result == "draw") {
                    alert("상대가 " + r.arr.server_rcp + "를 내어 비겼습니다.");
                } else if (r.arr.result == "lose") {
                    alert("상대가 " + r.arr.server_rcp + "를 내어 패배했습니다.");
                    alert("패배하여 연승 보상이 지급되었습니다.\n연승 기록 : " + r.arr.score + "연승, +" + r.arr.point + "포인트 지급!");
                }
            } else {
                alert(r.state);
            }
            location.reload();
        }, error:function(request, status, error){
            console.log(request, status, error);
        }, complete:function(){
            document.xhr = false;
        }
    });
}

$(window).scroll(function() {
    // top button controll
    if ($(this).scrollTop() > 500) {
        $('#topButton').fadeIn();
    } else {
        $('#topButton').fadeOut();
    }
});

$(document).ready(function() {
    // Top Button click event handler
    $("#topButtonImg").click(function() {
        $('html, body').animate({scrollTop:0}, '300');
    });
});


function likeUp(idx) {

    if (document.xhr) {
        alert('처리중입니다. 잠시만 기다려주세요.');
        return;
    } 

    document.xhr = $.ajax({
        url: '/community/like.proc.php',
        data: {"idx": idx},
        type:'post',
        dataType: "json",
        success:function(r){

            if (r.state == "OK") {
                alert("게시글을 추천하였습니다!");
                $(".bbs_Likes").html(r.arr.like);
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


$(document).ready(function(){ 
    $(".zoom_img").hover(function(){
         $(this).css({'transform' : 'scale(1.1)','transition' :'transform 0.5s ease'}); 
    },function(){
         $(this).css('transform' , 'scale(1)');
     });	
 });
 