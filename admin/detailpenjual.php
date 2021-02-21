 <?php 
 $id_toko=$_GET['id'];
 $pecah=$koneksi->query("SELECT * FROM toko 
 	JOIN pelanggan ON toko.id_toko=pelanggan.id_pelanggan  
 	WHERE toko.id_toko='$id_toko'");
 $detail=$pecah->fetch_assoc();
 ?>

 <h2 class="text-center">Profile Toko</h2>
 <div class="row">
 	<div class="col s2">
 		<img src="../assets/img/toko/<?php echo $detail['foto_toko'] ?>" class="circle" height="150" width="150">
 	</div>
 	<div class="col s2">
 		<p>
 			<b>Nama Pemilik </b>  <br>
 			<b>Nama Toko</b> <br>
 			<b>Telepon Toko </b> <br>
 			<b>email toko  </b> <br>
 			<b>bergabung</b>
 		</p>
 	</div>
 	<div class="col s3">
 		<p>
 			: <?php echo $detail['nama_pelanggan'] ; ?> <br>
 			: <?php echo $detail['nama_toko']; ?> <br>
 			: <?php echo $detail['telepon_toko'] ;?> <br>
 			: <?php echo $detail['email_toko'] ;?><br>
 			: <?php echo date("d F Y", strtotime($detail['bergabung'])); ?>
 		</p>
 	</div>
 	<div class="col s1">
 		<p>		
 			<b>Provinsi</b> <br>
 			<b>Kabupaten</b> <br>
 			<b>Alamat</b>	 <br>	
 			<b>Bank  </b> <br>	
 			<b>Rekening</b>	 <br>

 		</p>
 	</div>
 	<div class="col s2">
 		<p>
 			: <?php echo $detail['provinsi_toko'] ?> <br>
 			: <?php echo $detail['distrik_toko']; ?> <br>
 			: <?php echo $detail['alamat_toko'] ;?><br>	
 			: <?php echo $detail['nama_bank'] ;?><br>	
 			: <?php echo $detail['rek_bank'] ;?><br>	

 		</p>
 	</div>
 </div>
 <div class="row">

 	<h5 style="text-align: justify;"> 
 		<b>Deskripsi Toko : </b> <br>	
 		<?php echo 	$detail['deskripsi_toko'] ;?>
 	</h5>
 	<br>
 	<h5>
 		<b>Produk : </b> <br>	
 	</h5>

 	<?php $ambil=$koneksi->query("SELECT * FROM produk 
 		JOIN kategori ON produk.id_kategori=kategori.id_kategori
 		JOIN toko ON produk.id_toko=toko.id_toko
 		WHERE produk.id_toko='$id_toko'
 		LIMIT 8 "); ?>
 		<?php while($perproduk = $ambil->fetch_assoc()){ ?>
 			<div class="grid-example col m3 s12">
 				<div class=" responisve-card card hoverable">
 					<div class="card-image waves-effect waves-block waves-light">
 						<center>												
 							<p><strong><?php echo $perproduk['nama_produk']; ?></strong></p>
 							<img class="responsive-img activator" src="../assets/img/produk/<?php echo $perproduk['foto_produk']; ?>" style="height: 250px; width: 250px;" id="gambarr">
 						</div>
 					</center>
 					<div class="card-content">
 						<h6><b><a href="toko.php?id=<?php echo $perproduk['id_toko']?>"><?php echo $perproduk['nama_toko']; ?></a></b></h6>	
 						<h6>kategori : <?php echo $perproduk['nama_kategori'] ?> </h6>
 						<p>stok : <?php if ($perproduk['stok_produk'] < 1 ): ?>
 						<?php echo 	'habis'; ?>
 						<?php else: ?>	
 							<?php echo $perproduk['stok_produk'] ?>
 						<?php endif; ?> 

 					</p>
 					<span class="harga">
 						<h5>Rp.<?php echo number_format($perproduk['harga_produk']); ?></h5>
 					</span> 
 					<hr>
 					<div class="card-action">
 						<a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" 
 							class="btn waves-effect waves-light left red btn-small">Detail</a>
 						</div>
 					</div>
 				</div>
 			</div>
 		<?php 	} ?>
 	</div>	