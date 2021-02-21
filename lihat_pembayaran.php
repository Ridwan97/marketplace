 <?php 
//koneksi ke database
 session_start();
 include'koneksi.php';

 $id_pembelian =$_GET["id"];

 $ambil=$koneksi->query("SELECT * FROM pembayaran 
 	JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian
 	WHERE pembelian.id_pembelian='$id_pembelian' ");
 $detbay = $ambil->fetch_assoc();

// echo"<pre>";
// print_r($detbay);
// echo"</pre>";
 
 if (empty($detbay)) {
 	echo "<script>alert('anda belum ada data pembayaran')</script>";
 	echo "<script>location='riwayat.php';</script>";
 	exit();
 }

//jika data pelanggan yang bayar tidak sesuai dengan yang lain
// echo "<pre>";
// print_r($_SESSION);
// echo"</pre>";
 if ($_SESSION["pelanggan"]["id_pelanggan"]!==$detbay["id_pelanggan"]) 
 {
 	echo "<script>alert('anda tidak berhak melihat pembayaran orang lain')</script>";
 	echo "<script>location='riwayat.php';</script>";
 	exit();
 }

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 		<?php include "header.php" ?>
 	<title>Lihat Pembayaran | Computer OnShop</title>
 </head>

 <body>
 	<!-- navbar -->
 	<?php 	include"navbar.php" ?>
 	<div class="container">
 		<center><h3>Lihat Pembayaran</h3></center> <br>	<br>	
 		<table class="table centered highlight hoverable responsive-table">
 			<tr>
 				<th>Nama</th>
 				<td><?php echo 	$detbay["nama"]; ?> </td>
 				<td rowspan="4">
 					<img src="assets/img/bukti_pembayaran/<?php echo $detbay["bukti"] ?>" alt="" class="img-responsive" height="200" width="200">
 				</td>
 			</tr>
 			<tr>
 				<th>Bank</th>
 				<td><?php echo 	$detbay["bank"] ;?></td>
 			</tr>
 			<tr>
 				<th>Tanggal</th>
 				<td><?php echo date("d F Y", strtotime(	$detbay["tanggal"] ) ) ;?></td>
 			</tr>
 			<tr>
 				<th>Jumlah</th>
 				<td>Rp. <?php echo 	number_format($detbay["jumlah"]); ?></td>
 			</tr>
 		</div>
 	 	</table>
 	 	<br> <br>
 	 	 		<a href="riwayat.php" class="btn-small">kembali</a>

 	<br><br>
 </div>
</body>
<!-- footer -->
<?php include"footer.php" ;?>
</html>