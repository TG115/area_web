<?
if (!isset($_SESSION)) session_start();
// if (!isset($_SESSION['zeus_id']) && ((strpos(basename($_SERVER["SCRIPT_NAME"]), 'login')  === false) && (strpos(basename($_SERVER["SCRIPT_NAME"]), 'signup')  === false))) {
// 	$pageInfo = explode('/', $_SERVER['PHP_SELF']);
// 	if (strpos(basename($_SERVER["SCRIPT_NAME"]), 'index')  === false) {
// 		echo '<script>alert("로그인 정보가 없습니다.");</script>';
// 	}
// 	echo '<script>location.href="/login"</script>';
    
// }
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Favicon -->
	<link rel="shortcut icon" href="https://zeusrpg.kr/favicon.ico">
	<!-- Fonts -->
	<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"> -->

    <!-- Bootstrap core CSS -->
  	<link href="/asset/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="/asset/css/modern-business.css" rel="stylesheet">

	<!-- FontAwesome -->
	<!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> -->

	<link rel="stylesheet" href="/asset/css/style.css?ver=1.3">
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

	<!-- SEO -->
	<!-- <link rel="canonical" href="https://zeusrpg.kr" /> -->
	<meta property="og:image" content="https://zeusrpg.kr/img/logo.png" />
	<meta property="og:type" content="website" />

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-TX4BB79');</script>
	<!-- End Google Tag Manager -->

	<meta name="naver-site-verification" content="3b62a2cc1747264173b26dc4143af82558baf89c" />

	<link href="https://unpkg.com/webkul-micron@1.1.6/dist/css/micron.min.css" type="text/css" rel="stylesheet">
    <script src="https://unpkg.com/webkul-micron@1.1.6/dist/script/micron.min.js" type="text/javascript"></script>
	
