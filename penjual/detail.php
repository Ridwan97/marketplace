<?php
// mendapatkan id produk dari url
$id_produk = $_GET["id"];

	// query ambil data

$ambil = $koneksi->query("SELECT * FROM produk 
	LEFT JOIN toko ON produk.id_toko=toko.id_toko 
	WHERE id_produk='$id_produk'"); 
$detail =$ambil->fetch_assoc();

?>
<h1 class="center-align">Detail Produk</h1>
<div class="row">
	<div class="grid-example col m4 s12">
		<center><img class="responsive-img activator" src="../assets/img/produk/<?php echo $detail['foto_produk']; ?>" style="height: 250px; width: 250px;" id="gambarr">		<br>	<a href="index.php?halaman=profiltoko" class="btn red">Kembali</a></center>

	</div>
	<div class="grid-example col m6 s12">
		<h5><?php echo $detail['nama_produk']; ?></h5>
		<h6>Rp.<?php echo number_format($detail['harga_produk']); ?></h6>
		<h7>Stok : <?php echo $detail['stok_produk']; ?></h7>
		<div class="row">
		</div>
		<h5><?php echo $detail['nama_toko'] ?></h5>
		<h7 ><?php echo $detail['deskripsi_produk']?></h7>
	</div>
	
</div>

</div>

<br>

</body>





