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
 