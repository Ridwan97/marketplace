<?php 
//koneksi ke database
session_start();
include"koneksi.php";

//jika tidak ada session pelanggan (belom login) maka dilarikan ke login.php
if (!isset($_SESSION['pelanggan'])) 
{
	echo "<script>alert('anda belom login');</script>";
	echo "<script>location='login.php';</script>";
}


?>
<!DOCTYPE html>
<html>
<head>
	<?php include "header.php" ?>
	<title>Nota Pembelian | Computer Onshop</title>
	<style>
		.watermark{
			position: relative; 
		}
		.img-watermark {
			position: absolute;
			z-index: auto;
			margin-left: 300px;
			height: 200px;
			width: 400px;
			opacity: 0.2;
			margin-bottom: 50px;
		}
	</style>
</head>
<body>
	<!--Navbar-->
	<?php include"navbar.php" ?>
	<br>	
	<section class="konten">
		<div class="container ">
			<!-- nota disini copas saja dari nota yang ada di admin -->
			<h3 >NOTA PEMBELIAN</h3>
			<img src="assets/img/homepage/barcode.png" width="350" height="100"> <br><br><br>
			<?php 
			$ambil=$koneksi->query("SELECT * FROM pembelian 
				JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan
				JOIN pengiriman ON pembelian.id_pengiriman =pengiriman.id_pengiriman
				JOIN toko ON pembelian.id_toko = pembelian.id_toko
				WHERE pembelian.id_pembelian='$_GET[id]'");
			$detail=$ambil->fetch_assoc(); 
			?>
			<!-- <pre><?php print_r($detail); ?></pre> -->
			
			<!-- jika pelanggan yang beli tidak sama dengan pelnggan yang login, maka dilarikan ke riwayat.php karena dia tidak berhak melihat nota yang lain -->
			<?php 
			// pelanggan yang beli harus pelanggan yang login 

			// mendapatkan id_pelanggan yang dibeli
			$idpelangganyangbeli = $detail["id_pelanggan"];

			//mendapatkan id_pelanggan yang login
			$idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

			if ($idpelangganyangbeli!==$idpelangganyanglogin)
			{
				echo "<script>alert'jangan nakal';</script>";
				echo "<script>location='riwayat.php';</script>";
				exit();
			}

			?>
			<h5><b>No Resi : <?php if ($detail['id_pengiriman'] < 2): ?>
			<?php echo "-" ?>
			<?php else: ?>
				<?php echo $detail['resi_pengiriman'] ?>	
				<?php endif ?></b></h5>
				<div class="row">
					<div class="col s12">
						<!-- 	<div class="card-panel  hoverable"> -->
							<span class="black-text">
								<div class="row">
									<div class="col s3">
										<h5><strong>Data Pembelian</strong></h5>
									</div>
									<div class="col s5">
										<h5><strong>Data Pelanggan</strong></h5>
									</div>
									<div class="col s4">
										<h5><strong>Data Pengiriman</strong></h5>
									</div>
									<div class="col s1">
										<strong>Asal Toko 	<br>
											No. Nota<br>
											Tanggal <br>
										Total </strong>
									</div>									
									<div class="col s2">
										: <?php echo $detail['distrik_toko'] ;?><br>
										: <?php echo $detail['id_pembelian']; ?><br>
										: <?php echo date("d F Y",strtotime($detail['tanggal_pembelian'])); ?><br>
										: <?php echo "Rp.".number_format($detail['total_pembelian']) ;?><br> 	
									</div>
									<div class="col s2">
										<strong>
											Nama Pelanggan	<br>
											No. Telp <br>
											Email 
										</strong>
									</div>									
									<div class="col s3">
										: <?php echo $detail['nama_pelanggan']; ?><br>
										: <?php echo $detail['telepon_pelanggan']; ?><br>
										: <?php echo $detail['email_pelanggan'] ;?><br>		
									</div>
									<div class="col s1">
										<strong>
											Ekspedisi <br>
											Ongkir <br>
											Provinsi <br>	
											Kabupaten <br>
											Alamat <br>
										</strong>
									</div>
									<div class="col s3">
										: <?php echo $detail['ekspedisi'] ;?> <?php echo $detail['paket'] ?> <?php echo 	$detail['estimasi'] ?><br>
										: Rp. <?php echo number_format($detail['ongkir']); ?> <br>
										: <?php echo $detail['provinsi']; ?> <br>
										: <?php echo $detail['tipe'];?> <?php echo 	$detail['distrik'] ;?> <br>	
										: <?php echo $detail['alamat_pengiriman']; ?><br>
									</div>

								</div>
							</span>
						</div>
						<!-- </div> -->
					</div>
					<img src="assets/img/homepage/logo.png" class="img-watermark">
					<table class="table centered striped watermark">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama produk</th>
								<th>Toko</th>
								<th>Harga</th>
								<th>berat</th>
								<th>Jumlah</th>
								<th>Subberat</th>
								<th>Subtotal</th>
							</tr>
						</thead>
						<tbody>
							<?php $nomor=1 ; ?>
							<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk LEFT JOIN toko 
								ON produk.id_toko=toko.id_toko  
								ON pembelian_produk.id_produk=produk.id_produk  WHERE id_pembelian='$_GET[id]'"); ?>
								<?php while ($pecah=$ambil->fetch_assoc()) { ?>
									<tr>	
										<td><?php echo $nomor; ?></td>
										<td><?php echo $pecah['nama']; ?></td>
										<td><?php echo $pecah ['nama_toko'] ?></td>
										<td>Rp.<?php echo number_format($pecah['harga']); ?></td>
										<td><?php echo $pecah['berat'] ?>Gr</td>	
										<td><?php echo $pecah['jumlah']; ?></td>
										<td><?php echo $pecah['subberat']; ?>Gr	</td>
										<td>Rp.<?php echo number_format($pecah['subharga']); ?></td>

									</tr>

									<?php $nomor++ ?>
								<?php } ?>
								<tr>
									<td colspan="7"><strong>Total</strong></td>
									<td><strong>Rp.<?php echo number_format($detail['total_pembelian'] ); ?></strong></td>
								</tr>
							</tbody>
						</table>	
						<br>
						<br>
						<br>
						<!-- 	<div class="card hoverable"> -->	
				<!-- 	<div class="row">
						<div class="col-md-7">
							<div class="alert alert-info">
								<span class="black-text"> 
									<h5>Silahkan melakukan pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?>
									<br><strong>BANK MANDIRI 137-099103-823871 <?php echo $detail['nama_pelanggan'] ; ?></strong>
								</h5>	
							</span>	
						</div>	
					</div>	 -->
					<!-- </div> -->
					<a href="riwayat.php" class="waves-effect waves-light  btn right"><i class="material-icons left">archive</i>Riwayat Belanja</a>

				</div>	
				<br><br><br>
			</div>		
		</section>

		<?php include"footer.php" ?>
	</body>
	</html>