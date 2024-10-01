<?php 
//koneksi ke database
session_start();
include"koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- My Css -->
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Home | OPTIK EMPAT MATA</title>
</head>
<body>
	<!-- NAVBAR -->
	<?php include"navbar.php";?>

	<!-- SLIDER -->
	<?php include"slider.php" ?>

	<!-- ABOUT ME -->
	<?php include"about.php" ?>

	<!-- highlights -->
	<?php include"produk.php" ?>

	<!-- footer -->
	<?php include 'footer.php'; ?>



















	<!--JavaScript at end of body for optimized loading-->
	<script>
			// alert('Welcome to my page');
			// var lagi = true;

			// while (lagi){
			// 	var nama = prompt('Masukkan nama :');
			// 	alert('Hello, ' + nama);

			// 	lagi = confirm ('coba lagi?');

			// } 
			// alert('terima kasih...');

			const sidenav = document.querySelectorAll('.sidenav');
			M.Sidenav.init(sidenav);

			const slider = document.querySelectorAll('.slider');
			M.Slider.init(slider,{
				indicators: false,
				height: 500,
				transition: 600,
				interval: 3000,
			});

			const parallax = document.querySelectorAll('.parallax');
			M.Parallax.init(parallax);

			const materialbox = document.querySelectorAll('.materialboxed');
			M.Materialbox.init(materialbox);

			const scroll = document.querySelectorAll('.scrollspy');
			M.ScrollSpy.init(scroll);

		</script>
	</body>
	</html>