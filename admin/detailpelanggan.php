<?php
$id_pelanggan= $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'"); 
$detail_pelanggan =$ambil->fetch_assoc();



// echo "<pre>";
// print_r($detail_pelanggan);
// echo "</pre>";
?>

<h2 class="text-center">Profile Pelanggan</h2>

<div class="row">
	<div class="col s2">
		<img src="../assets/img/pelanggan/<?php echo $detail_pelanggan['foto_pelanggan'] ?>" style="height: 150px; width: 150px;" class="circle">	
	</div>
	<div class="col s2">
		<h5>
			<strong>
				Nama <br>
				Jenis Kelamin <br>
				Tanggal Lahir 
			</strong> 	
		</h5>
	</div>
	<div class="col s4">
		<h5>
			: <?php echo $detail_pelanggan['nama_pelanggan'] ?><br>
			: <?php echo $detail_pelanggan['jk_pelanggan'] ?><br>
			: <?php echo date("d F Y",strtotime(	$detail_pelanggan['tgl_lahir'])) ?>	
		</h5>
	</div>
	<div class="col s1">
		<h5>
			<strong>
				Email  <br>
				Alamat <br>
				Telepon   <br>
			</strong> 	
		</h5>
	</div>
	<div class="col s3">
		<h5>
			: <?php echo $detail_pelanggan['email_pelanggan'] ?><br>
			: <?php echo $detail_pelanggan['alamat_pelanggan'] ?><br>	
			: <?php echo $detail_pelanggan['telepon_pelanggan'] ?>	
		</h5>
	</div>
	<br>
</div>
<br>
<br>
<a href="index.php?halaman=pelanggan" class="btn red">Kembali</a>
<br>
<br>
<div class="row">
	<h4>Riwayat Belanja</h4>
	<table class="table striped centered hoverable">
		<thead>
			<tr>
				<th>No</th>
				<th>Foto Produk</th>
				<th>Nama Toko</th>
				<th>Nama Produk</th>
				<th>harga Produk</th>
				<th>Status Pembelian</th>
				<th>Jumlah</th>
				<th>Sub Harga</th>
			</tr>
		</thead>
		<tbody>
			<?php 	
			$nomor = 1;
			$jumlah = 0; 
			$subharga = 0 ;
			$ambil = $koneksi->query("SELECT * FROM pembelian 
				JOIN pelanggan ON  pembelian.id_pelanggan = pelanggan.id_pelanggan 
				JOIN pembelian_produk ON pembelian.id_pembelian = pembelian_produk.id_pembelian
				JOIN toko ON pembelian.id_toko = toko.id_toko
				JOIN produk ON pembelian_produk.id_produk = produk.id_produk
				JOIN pengiriman ON pembelian.id_pengiriman = pengiriman.id_pengiriman
				WHERE pembelian.id_pelanggan='$id_pelanggan'
				ORDER BY pembelian.id_pembelian ");
			while ( $pecah  = $ambil->fetch_assoc()) {
				?>
				<tr>
					<td><?php echo 	$nomor ?></td>
					<td>
						<img src="../assets/img/produk/<?= $pecah['foto_produk']; ?>" width="100" height="100"></td>	
						<td><?php echo 	$pecah["nama_toko"]; ?></td>
						<td><?php echo 	$pecah["nama_produk"] ;?></td>
						<td>Rp. <?php echo 	number_format($pecah["harga_produk"] );?></td>	
						<td><?php echo 	$pecah["status_pengiriman"] ?></td>	
						<td><?php echo 	$pecah["jumlah"] ?></td>	
						<td>Rp. <?php echo 	number_format($pecah["subharga"]) ;?></td>			
					</tr>
					<?php 	$nomor++ ?>
					<?php 	$jumlah += $pecah["jumlah"]; ?>
					<?php 	$subharga += $pecah["subharga"]; ?>
				<?php 	} ?>
				<tr>
					<th colspan="6" class="center">Total</th>	
					<th><?php echo 	$jumlah; ?></th>
					<th>Rp. <?php echo 	number_format($subharga); ?></th>		
				</tr>
			</tbody>




		</table>
	</div>	



