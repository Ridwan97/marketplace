

<section id="highlights" class="highlights scrollspy">
	<div class="container">
		<h1 class="center-align">Produk Terbaru</h1>
		<div class="row">
			<?php $ambil=$koneksi->query("SELECT * FROM produk 
			JOIN kategori ON produk.id_kategori=kategori.id_kategori
			JOIN toko ON produk.id_toko=toko.id_toko
			ORDER BY id_produk DESC
			LIMIT 8 "); ?>
		<?php while($perproduk = $ambil->fetch_assoc()){ ?>
				<div class="grid-example col m3 s12">
					<div class=" responisve-card card hoverable">
						<div class="card-image waves-effect waves-block waves-light">
							<center>												
									<p><strong><?php echo $perproduk['nama_produk']; ?></strong></p>
								<img class="responsive-img activator" src="assets/img/produk/<?php echo $perproduk['foto_produk']; ?>" style="height: 250px; width: 250px;" id="gambarr">
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
									<?php if ($perproduk['stok_produk'] < 1 ): ?>
									<a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" 
										class="btn waves-effect waves-light left red btn-small  disabled">Detail</a>
									<a href="beli.php?id=<?php 	echo $perproduk['id_produk']; ?>" class="btn waves-effect waves-light right btn-small disabled">beli</a></span>
									<?php else: ?>	
									<a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" 
										class="btn waves-effect waves-light left red btn-small ">Detail</a>
										<a href="beli.php?id=<?php 	echo $perproduk['id_produk']; ?>" class="btn waves-effect waves-light right btn-small">beli</a></span>
									<?php 	endif; ?>		
									</div>
								</div>
							</div>
						</div>
					<?php 	} ?>
				</div>	
			</div>
		</section>
