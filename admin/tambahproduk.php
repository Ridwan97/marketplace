 <?php 
$datakategori = array();

$ambil = $koneksi->query("SELECT * FROM kategori");
while($tiap = $ambil->fetch_assoc())
{
	$datakategori[] = $tiap;
}
 
// echo"<pre>";
// print_r($datakategori);
// echo "</pre>";
?>


<h2 class="text-center">Tambah Produk</h2>
<br>
<form method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="input-field col s6">
			<i class="material-icons prefix">account_circle</i>
			<label>Nama Produk</label>
			<input type="text" name="nama" required>
		</div>
		<div class="input-field col s6">
			<i class="material-icons prefix">label_outline</i>
			<select name="id_kategori" class="validate" required>
				<option></option>
				<?php foreach ($datakategori as $key => $value): ?>
				<option value="<?php echo $value['id_kategori'] ?>"><?php echo $value['nama_kategori'] ?></option>
				<?php endforeach ?>
			</select>
			<label>kategori Produk</label>
		</div>		
	</div>
	<div class="row">
		<div class="input-field col s4">
			<i class="material-icons prefix">attach_money</i>
			<label>Harga (Rp)</label>
			<input type="number" name="harga" class="validate" required>
		</div>
		<div class="input-field col s4">
			<i class="material-icons prefix">gavel</i>
			<label>Berat (Gr)</label>
			<input type="number" name="berat" class="validate" required>
		</div>
		<div class="input-field col s4">
			<i class="material-icons prefix">description</i>
			<label>Stok Produk</label>
			<input type="number" name="stok_produk" class="validate" required>
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12">
			<i class="material-icons prefix">description</i>
			<label>Deskripsi Produk</label>
			<textarea name="deskripsi" class="materialize-textarea validate" rows="5" required></textarea>
		</div>

	</div>
	<div class="row">
		<div class="file-field input-field col s11">
			<div class="btn indigo">
				<span>File</span>
				<input type="file" name="foto[]" multiple required>
			</div>
			<div class="file-path-wrapper">
				<input class="file-path validate" type="text" required>
			</div>
		</div>
		<br>
			<button class="btn col s1 green waves-effect waves-dark" name="save">Simpan</button>
	</div>
	
</form>


<?php 
if (isset($_POST['save'])) 
{
	$namanamafoto = $_FILES['foto']['name'];
	$lokasilokasifoto = $_FILES['foto']['tmp_name'];
	move_uploaded_file($lokasilokasifoto[0], "../foto_produk/".$namanamafoto[0]);
	$koneksi->query("INSERT INTO produk
		(nama_produk,harga_produk,berat_produk,foto_produk,deskripsi_produk,stok_produk,id_kategori) 
		VALUES('$_POST[nama]','$_POST[harga]','$_POST[berat]','$namanamafoto[0]','$_POST[deskripsi]','$_POST[stok_produk]','$_POST[id_kategori]') ");

		//mendapatkan id_produk barusan
	$id_produk_barusan = $koneksi->insert_id;

	foreach ($namanamafoto as $key => $tiap_nama) 
	{
		$tiap_lokasi = $lokasilokasifoto[$key];

		move_uploaded_file($tiap_lokasi, "../foto_produk/".$tiap_nama);

			// simpan ke mysql (tapi kita perlu tau id_produknya berapa?)
		$koneksi->query("INSERT INTO produk_foto (id_produk,nama_produk_foto)
			VALUES('$id_produk_barusan','$tiap_nama')");
	}


	echo "<div class='alert alert-info'>Data tersimpan</div>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";


}
?>


<script>
	//tambah foto
	// $(document).ready(function(){
	// 	$(".btn-tambah").on("click",function(){
	// 		$(".letak-input").append("<input type='file' class='form-control' name='foto[]'>");
	// 	})
	// });

</script>