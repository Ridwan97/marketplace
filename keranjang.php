 <?php 
//koneksi ke database
session_start();
include 'koneksi.php';

if(empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang']))
{
	echo "<script>alert('keranjang kosong, silahkan anda belanja terlebih dahulu');</script>";
	echo "<script>location='index.php';</script>";
} elseif (empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang']))
{
	echo "<script>alert('keranjang kosong, silahkan anda belanja terlebih dahulu');</script>";
	echo "<script>location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
		<?php include "header.php" ?>
	<title>Keranjang Belanja | Computer Onshop</title>
</head>
<body>
	<!--Navbar-->
	<?php include"navbar.php" ?>
		<!-- BODY -->
	<section class="konten">
		<div class="container">
			<h1 align="center">Keranjang belanja</h1>
			<table class="table centered highlight hoverable">		
				<thead>
					<tr>
						<th>no</th>
						<th>produk</th>
						<th>foto</th>
						<th>toko</th>
						<th>harga</th>
						<th>jumlah</th>
						<th>subharga</th>
						<th>aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomor=1; ?>	
					<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
						<!-- menampilkan produk berdasarkan id_produk -->
						<?php
						$ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN toko ON produk.id_toko=toko.id_toko WHERE id_produk='$id_produk';");
						$pecah = $ambil->fetch_assoc();
						$subharga =$pecah['harga_produk']*$jumlah;
						?>
						<tr>
							<td><?php echo 	$nomor; ?></td>
							<td><?php echo $pecah['nama_produk']; ?></td>
							<td><img src="assets/img/produk/<?php echo $pecah['foto_produk'] ?> " style="height: 100px ; width: 100px;"></td>	
							<td><?php echo $pecah['nama_toko'] ?></td>
							<td>Rp.<?php echo 	number_format($pecah["harga_produk"]); ?></td>
							<td><?php echo 	$jumlah; ?></td>
							<td>Rp.<?php echo 	number_format($subharga) ;?></td>
							<td><a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger xs red">hapus</a></td>
						</tr>
						<?php $nomor++; ?>
					<?php 	endforeach ?>
				</tbody>
			</table>
			<br>
			<a href="index.php" class="waves-effect waves-light btn " style="margin-right: 10px;">Lanjutkan Belanja</a>
			<a href="checkout.php" class="waves-effect waves-light btn blue">Checkout</a>
		</div>
		<br><br><br><br><br>
		
	</section>
	<!-- footer -->
	<?php include"footer.php" ;?>
</body>
</html>