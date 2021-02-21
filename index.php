<?php 
//koneksi ke database
session_start();
include"koneksi.php";
include"header.php";
?>
<!DOCTYPE html>
<html>
<header>
		<title>Home | Computer OnShop</title>
</header>
<body> 
	<!-- NAVBAR -->
	<?php include"navbar.php";?>
	<!-- SLIDER -->
	<?php include"slider.php" ?>

	<!-- ABOUT ME -->
	<?php include"about.php" ?>
	
	<!-- SEARCHING -->
	<?php include"search.php" ?>

	<!-- highlights -->
	<?php include"produk.php" ?>

	<!-- Partners -->
	<?php include"partners.php" ?>

	<!-- Services -->
	<?php include"services.php" ?>

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