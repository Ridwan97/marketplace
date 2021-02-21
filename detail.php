<?php session_start(); ?>
<?php include 'koneksi.php'; ?>
<?php
// mendapatkan id produk dari url
$id_produk = $_GET["id"];

	// query ambil data

$ambil = $koneksi->query("SELECT * FROM produk 
	LEFT JOIN toko ON produk.id_toko=toko.id_toko 
	WHERE id_produk='$id_produk'"); 
$detail =$ambil->fetch_assoc();
if (isset($_SESSION['pelanggan'])) {
	if ($_SESSION['pelanggan']['id_pelanggan'] == $detail['id_toko']) {
		echo "<script>alert('Tidak dapat membeli produk sendiri');</script>";
		echo "<script>location='index.php';</script>";
	} 
}

?>
<!DOCTYPE html>
<html>
<head>
	<?php include "header.php" ?>
	<title>Detail | Computer Onshop</title>
</head>
<body>
	<!--Navbar-->
	<?php include"navbar.php" ?>
	<div class="container">
		<h1 class="center-align">Detail Produk</h1>
		<div class="row">
			<div class="grid-example col m4 s12">
				<center><img class="responsive-img activator" src="assets/img/produk/<?php echo $detail['foto_produk']; ?>" style="height: 250px; width: 250px;" id="gambarr"></center>
			</div>
			<div class="grid-example col m6 s12">
				<h5><?php echo $detail['nama_produk']; ?></h5>
				<h6>Rp.<?php echo number_format($detail['harga_produk']); ?></h6>
				<h7>Stok : <?php echo $detail['stok_produk']; ?></h7>
				<div class="row">
					<form class="col s12" method="post">
						<div class="row">
							<div class="input-field col s6">
								<input placeholder="Jumlah" min="1" max="<?php echo $detail["stok_produk"]; ?>" type="number" class="form-control" name="jumlah" required>
							</div>
							<div class="input-field col s6">
								<button class="btn" name="beli">beli</button>
							</div>
						</div>
						<h5><b><?php echo $detail['nama_toko'] ?></b></h5>
						<br> 
						<h6><b>Detail Produk :</b></h6>
						<h6><?php echo $detail['deskripsi_produk']?></h6>
					</form>
					<?php 
					if (isset($_POST["beli"])) {
								// mendapatkan id produk yang kita beli
						$jumlah = $_POST["jumlah"];
								// masukkan di keranjang belanja
						$_SESSION["keranjang"][$id_produk] = $jumlah;

						echo "<script>alert('produk telah masuk ke keranjang')</script>";
						echo "<script>location='keranjang.php';</script>";
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<br>

</body>
<!-- footer -->
<?php include"footer.php" ;?>
</html>





