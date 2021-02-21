<?php 
//koneksi ke database
session_start();
include '../koneksi.php';
  // if (!isset($_SESSION['pelanggan'])) 
  // {
  // 	echo "<script>alert('Anda belum terdaftar sebagai penjual');</script>";
  // 	echo "<script>location='daftar_penjual.php';</script>";
  // 	header('location:../daftar_penjual.php');
  // 	exit();
  // }
if(empty($_SESSION['penjual']) OR !isset($_SESSION['penjual']))
{
	echo "<script>alert('anda Belum Terdaftar Sebagai Penjual');</script>";
	echo "<script>location='../daftar_penjual.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php 	include"header.php" ?>
	<title>TOKO</title>
</head>
<div id="wrapper">
	<nav class="navbar navbar-cls-top " style="margin-bottom: 0">
		<a href="#" data-target="slide-out" class="sidenav-trigger show-on-large"><i class="material-icons">menu</i></a>
		<div class="container">
			<a href="../index.php" class="brand-logo center"><img src="../assets/img/homepage/logo.png" height="50" width="100" class="logo"></a>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
 				<!-- <li>
 					<a href="checkout.php">Checkout</a>
 				</li> -->
 				<!-- Jika sudah login ada session pelanggan-->
 				<?php if (isset($_SESSION['penjual'])): ?>
 					<li>
 						<a class="nav-link" href="../logout.php" tabindex="-1" aria-disabled="true">Logout</a>
 					</li>
 					<!-- Selain itu (belom login || belom ada session pelanggan) -->
 					<?php else: ?>
 						<li>
 							<a class="nav-link" href="../login.php" tabindex="-1" aria-disabled="true">Login</a>
 						</li>				    	
 					<?php endif ?>
 				</div>
 			</nav>   

 			<!-- /. NAV TOP  -->
 			<ul id="slide-out" class="sidenav"  >
		<li class="text-center">
			<?php $ambil=$koneksi->query("SELECT * FROM toko WHERE id_toko='$_SESSION[penjual]'  "); ?>
			<?php while($pecah=$ambil->fetch_assoc()){ ?>
				<img src="../assets/img/toko/<?= $pecah['foto_toko'] 	 ?> " class="user-image img-responsive"/>
				<h5 class="brown-text"><?php echo $pecah['nama_toko'] ; ?></h5>
			<?php } ?>
		</li> 
		<?php

		$id_toko = $_SESSION["penjual"];
		$ambil=$koneksi->query("SELECT * FROM toko WHERE id_toko='$id_toko'");
		while($pecah=$ambil->fetch_assoc()) { ?>
			<li><a href="index.php"><i class="tiny material-icons">home</i>Home</a></li>
			<li><a href="index.php?halaman=profiltoko"><i class="tinty material-icons">store</i>Profil Toko</a></li>
			<li><a href="index.php?halaman=produk"><i class="tiny material-icons">local_offer</i>Produk</a></li>
			<li><a href="index.php?halaman=data_penjualan"><i class="tiny material-icons">assignment</i>Penjualan</a></li>
			<li><a href="index.php?halaman=laporan_toko"><i class="tiny material-icons">attach_money</i>Laporan Penjualan</a></li>
		<?php 	} ?>
		<li><a class="sidenav-close" href="../logout.php"><i class="tiny material-icons">exit_to_app</i>Logout</a></li>        
	</div>

	<!-- /. NAV SIDE  -->
	<div id="page-wrapper" >
		<div id="page-inner"> 
			<?php 
			if (isset($_GET['halaman'])) 
			{
				if ($_GET['halaman']=='produk') {
					include 'produk.php';
				} elseif ($_GET['halaman']=='pembelian') {
					include 'pembelian.php';
				} elseif ($_GET['halaman']=='pelanggan'){
					include 'pelanggan.php';
				} elseif ($_GET['halaman']=='detail') {
					include 'detail.php';
				} elseif ($_GET['halaman']=='tambahproduk') {
					include 'tambahproduk.php';
				} elseif ($_GET['halaman']=='hapusproduk') {
					include 'hapusproduk.php';
				} elseif ($_GET['halaman']=='ubahproduk') {
					include 'ubahproduk.php';
				} elseif ($_GET['halaman']=='logout') {
					include 'logout.php';
				} elseif ($_GET['halaman']=='pembayaran') {
					include'pembayaran.php';
				} elseif ($_GET['halaman']=='laporan_pembelian') {
					include'laporan_pembelian.php';
				} elseif ($_GET['halaman']=='kategori') {
					include'kategori.php';
				} elseif ($_GET['halaman']=='detailproduk') {
					include'detailproduk.php';
				} elseif ($_GET['halaman']=='hapusfotoproduk') {
					include'hapusfotoproduk.php';
				} elseif ($_GET['halaman']=='penjual') {
					include'penjual.php';
				} elseif ($_GET['halaman']=='hapuspelanggan') {
					include'hapuspelanggan.php';
				} elseif ($_GET['halaman']=='toko') {
					include'toko.php';
				} elseif ($_GET['halaman']=='profiltoko') {
					include'profiltoko.php';
				} elseif ($_GET['halaman']=='laporan_toko') {
					include'laporan_toko.php';
				} elseif ($_GET['halaman']=='data_pesanan') {
					include'data_pesanan.php';
				} elseif ($_GET['halaman']=='detail') {
					include'detail.php';
				} elseif ($_GET['halaman']=='data_penjualan') {
					include'data_penjualan.php';
				} elseif ($_GET['halaman']=='detail_penjualan') {
					include'detail_penjualan.php';
				} 
			}
			else
			{
				include 'home.php';
			}  
			?>

		</div>
		<!-- /. PAGE INNER  -->
	</div>
	<!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
<script>
  //sidenav
  const sidenav = document.querySelectorAll('.sidenav');
  M.Sidenav.init(sidenav);

    //formSelect 
    $(document).ready(function(){
    	$('select').formSelect();
    });

  //datepicker
// $(document).ready(function(){
//   $('.datepicker').datepicker();

// });
</script>
</body>
</html> 