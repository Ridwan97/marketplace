<?php 
$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah=$ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
?>

<?php 
$datakategori= array();

$ambil=$koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc())
{
	$datakategori[] = $tiap;
}
// echo "<pre>";
// print_r($datakategori);
// echo "</pre>"; 

?>


<h2 class="text-center">Ubah Produk</h2>

<form method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="input-field col s6">
			<i class="material-icons prefix">account_circle</i>
			<label>Nama Produk</label>
			<input type="text" name="nama"  value="<?= $pecah['nama_produk']; ?>" class="validate" required>
		</div>
		<div class="input-field col s6">
			<i class="material-icons prefix">label_outline</i>
			<select name="id_kategori" class="validate"  required>
				<option></option>
				<?php foreach ($datakategori as $key => $value): ?>
					<option value="<?php echo $value['id_kategori']; ?>" 
						<?php if($pecah["id_kategori"]==$value["id_kategori"]){echo "selected";} ?> ><?php echo $value['nama_kategori'] ;?>
					</option>
				<?php endforeach ?>
			</select>
			<label>kategori Produk</label>
		</div>
	</div>	
	<div class="row">
		<div class="input-field col s6">
			<i class="material-icons prefix">attach_money</i>
			<label>Harga Rp</label>
			<input type="number" name="harga" value="<?= $pecah['harga_produk'];?>" class="validate" required min="1">
		</div>
		<div class="input-field col s6">
			<i class="material-icons prefix">gavel</i>
			<label>Berat (Gr)</label>
			<input type="number" name="berat" value="<?= $pecah['berat_produk'];?>" class="validate" required min="1">
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12">
			<i class="material-icons prefix">description</i>
			<label>Deskripsi</label>
			<textarea class="materialize-textarea validate" name="deskripsi" rows="10"  required><?php echo $pecah['deskripsi_produk']; ?></textarea>
		</div>
	</div>
	<div class="row">
		<div class="input-field col s6">
			<img src="../assets/img/produk/<?= $pecah['foto_produk']  ?>" width="200" required>
		</div>
	</div>
	<div class="row">	
		<div class="file-field input-field col s6">
			<div class="btn indigo">
				<span>File</span>
				<input type="file" name="foto" value="<?= $pecah['foto_produk']; ?>">
			</div>
			<div class="file-path-wrapper">
				<input class="file-path validate" type="text">
			</div>
		</div>
		<br>
		<button class="btn green col s1" name="ubah">Simpan</button>&nbsp;
		<a href="index.php?halaman=produk" class="btn red waves-effect waves-dark">kembali</a>
	</div>

	<?php 
	if (isset($_POST['ubah'])) 
	{
		$namafoto=$_FILES['foto'] ['name'];
		$lokasifoto =$_FILES['foto'] ['tmp_name'];
		$fotop=date("YmdHis").$namafoto;

		$ekstensiGambarValid = ['jpg','jpeg','png'];
		$ekstensiGambar = explode('.', $fotop);
		$ekstensiGambar = strtolower(end($ekstensiGambar));
		// jk foto diubah
		if (!empty($lokasifoto))
		{
			if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
			echo "<script>
			alert('yang anda upload bukan gambar!');
			</script>
			";
			} else {
			move_uploaded_file($lokasifoto, "../assets/img/produk/$namafoto");

			$koneksi->query("UPDATE produk SET 
				nama_produk='$_POST[nama]', 
				harga_produk='$_POST[harga]',
				berat_produk='$_POST[berat]',
				foto_produk='$namafoto', 
				deskripsi_produk='$_POST[deskripsi]',
				id_kategori='$_POST[id_kategori]'
				WHERE id_produk='$_GET[id]'") ;
		}
		}else {
			$koneksi->query("UPDATE produk SET 
				nama_produk='$_POST[nama]', 
				harga_produk='$_POST[harga]',
				berat_produk='$_POST[berat]', 
				deskripsi_produk='$_POST[deskripsi]',
				id_kategori='$_POST[id_kategori]'
				WHERE id_produk='$_GET[id]'") ;
		}
		echo "<script>alert('data produk telah diubah');</script>";
		echo "<script>location='index.php?halaman=produk';</script> ";

	}
		


	?>

</form>


</div>

