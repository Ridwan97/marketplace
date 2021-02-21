 <?php 
$id_produk= $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM produk 
	JOIN kategori ON produk.id_kategori=kategori.id_kategori 
	JOIN toko ON produk.id_toko = toko.id_toko
	WHERE id_produk='$id_produk'");
$detailproduk = $ambil->fetch_assoc();

 ?>

<h2 class="text-center">Detail Produk</h2>
 <table class="table striped">
 	<tr>
 		<th>Nama Toko</th>	
 		<td><?php echo 	$detailproduk["nama_toko"] ;?></td>	
 		<td rowspan="7" ><img src="../assets/img/produk/<?php echo $detailproduk['foto_produk'] ?>" class="img-responsive" height="300" width="300"></td>
 	</tr>	
 	<tr>
 		<th>Kategori</th>
 		<td><?php echo $detailproduk["nama_kategori"] ;?></td>
 	</tr>
 	<tr>
 		<th>Produk</th>
 		<td><?php echo $detailproduk["nama_produk"] ;?></td>
 	</tr>
 	<tr>
 		<th>Harga</th>
 		<td>Rp. <?php echo number_format($detailproduk["harga_produk"]); ?></td>
 	</tr>
 	<tr>
 		<th>Berat</th>
 		<td><?php echo $detailproduk["berat_produk"] ;?> (Gr)</td>
 	</tr>
 	 	<tr>
 		<th>Stok</th>
 		<td><?php echo $detailproduk["stok_produk"] ;?></td>
 	</tr>
 	<tr>
 		<th>Deskripsi</th>
 		<td><?php echo $detailproduk["deskripsi_produk"] ;?></td>
 	</tr>

 </table>
<br>
<div class="row">
		<div class="col s4 ">
		<a href="index.php?halaman=produk" class="btn red waves-effect waves-dark">kembali</a>
		</div>
		<div >
			 	
		</div>

</div>
