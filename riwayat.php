 <?php 
//koneksi ke database
 session_start();
 include'koneksi.php';
 if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan']))
 {
 	echo "<script>alert('silahkan login');</script>";
 	echo "<script>location='login.php';</script>";
 	exit();
 }

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 		<?php include "header.php" ?>
 	<title>Riwayat Belanja | Computer OnShop</title>
 </head>

 <!-- navbar -->
 <?php 	include"navbar.php" ?>
 <!-- <pre><?php 	print_r($_SESSION) ?></pre> -->
 <section class="riwayat">
 	<div class="container">	
 		<h3 align="center">Riwayat Belanja <?php echo 	$_SESSION["pelanggan"]["nama_pelanggan"] ?></h3>
 		<table class="table striped centered">
 			<thead>	
 				<tr>
 					<th>NO</th>
 					<th>TANGGAL</th>
 					<th>STATUS</th>
 					<th>TOTAL</th>
 					<th>OPSI</th>	
 				</tr>
 			</thead>
 			<tbody>
 				<?php 	
 				$nomor=1;
					//mendapatkan id_pelanggan yang login dari session
 				$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
 				$ambil=$koneksi->query("SELECT * FROM pembelian 
 					JOIN pengiriman ON pembelian.id_pengiriman = pengiriman.id_pengiriman WHERE id_pelanggan='$id_pelanggan'");
 				while($pecah=$ambil->fetch_assoc()){
 					?>
 					<tr>
 						<td><?php echo 	$nomor; ?></td>
 						<td><?php echo 	date("d F Y",strtotime($pecah['tanggal_pembelian'])) ;?></td>
 						<td><?php echo 	$pecah['status_pengiriman'] ;?>
  						<br>
 						<?php if (!empty($pecah['resi_pengiriman'])): ?>
 							Resi : <?php echo $pecah['resi_pengiriman']; ?>
 						<?php endif ?>
 					</td>
 					<td>Rp.<?php echo 	number_format($pecah['total_pembelian']) ;?></td>
 					<td>
 						<a href="nota.php?id=<?php echo $pecah['id_pembelian'];?>" class="waves-effect waves-light blue btn">NOTA</a>
 						<?php if ($pecah["id_pengiriman"]== 0): ?>
 							<a href="pembayaran.php?id=<?php echo $pecah['id_pembelian']; ?>" class="waves-effect  waves-light red btn">Input Pembayaran</a>
 							<?php else: ?>
 								<a href="lihat_pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-warning">
 									lihat pembayaran
 								</a>
 						<?php endif ?>
 					</td>
 				</tr>
 				<?php 	$nomor++; ?>
 			<?php 	} ?>
 		</tbody>
 	</table>
 	<hr>
 	<br><br><br>
 	<a class="waves-effect waves-light teal btn right"href="index.php">Home</a> <br> <br> <br>
 </div>
</section>
<div style="margin-top: 100px;"></div>
<!-- footer -->
<?php include"footer.php" ;?>

 

