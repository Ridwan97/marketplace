 <?php 
include '../koneksi.php';
$ambil = $koneksi->query("SELECT * FROM pembelian 
	JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan
	JOIN toko ON pembelian.id_toko=toko.id_toko
	WHERE pembelian.id_pembelian='$_GET[id]'");
$detail=$ambil->fetch_assoc(); 
?>
	<style>
		.watermark{
			position: relative; 
		}
		.img-watermark {
			position: absolute;
			z-index: auto;
			margin-left: 500px;
			height: 200px;
			width: 400px;
			opacity: 0.2;
			margin-bottom: 50px;
		}
	</style>

<h2 class="text-center">Detail Penjualan <br> <?php echo $detail['nama_toko'] ;?></h2>
		<h3 >Nota Penjualan</h3>
	<img src="../assets/img/homepage/barcode.png" width="350" height="100"> <br><br><br>
<div class="row">
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
					<img src="../assets/img/homepage/logo.png" class="img-watermark">
					<table class="table centered striped watermark">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama produk</th>
								<th>Foto Produk</th>
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
										<td><img src="../assets/img/produk/<?php echo $pecah ['foto_produk'] ?>" height=100 width=100></td>
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

		<a href="index.php?halaman=data_penjualan" class="btn">kembali</a>
				</div>	
			</div>		