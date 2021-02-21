<?php 
//koneksi ke database
session_start();
include"koneksi.php";
if (!isset($_SESSION['pelanggan'])) {
	echo "<script>alert('Anda Belum Terdaftar');</script>";
	echo "<script>location='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php include "header.php" ?>
	<title>Daftar Penjual | Computer Onshop </title>
</head>
<body>
	<!--Navbar-->
	<?php include"navbar.php" ?>

	<?php
	$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
	$ambil=$koneksi->query("SELECT * FROM pelanggan
		WHERE id_pelanggan='$id_pelanggan' ");
	while($pelanggan = $ambil->fetch_assoc())
	{

		?>
		<div class="container">
			<h3 text-center>Daftar sebagai Penjual</h1>
				<h5 text-center>Lihat Status Toko & update profil toko Anda</h3>
					<form action="" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="input-field col s4">
								<i class="material-icons prefix">account_circle</i>
								<label for="nama_toko" >Nama Toko</label>
								<input id="nama_toko"  type="text" name="nama_toko" required>
							</div>
							<div class="input-field col s4">
								<i class="material-icons prefix">phone</i>
								<label for="telepon_toko" >Telepon Toko</label>
								<input id="telepon_toko"   name="telepon_toko" class="materialize-textarea validate" rows="5" required type="number">
							</div>
							<div class="input-field col s4">
								<i class="material-icons prefix">mail</i>
								<label for="email_toko" >Email Toko</label>
								<input  id="email_toko"  type="text" name="email_toko" required>
							</div>
							<div class="input-field col s6">
								<i class="material-icons prefix">account_balance</i>
								<select name="nama_bank" class="validate" required>
									<option value="	"></option>
									<option value="bca">bca</option>
									<option value="bni">bni</option>
									<option value="bri">bri</option>
									<option value="mandiri">mandiri</option>
								</select>
								<label>Pilih bank</label>
							</div>
							<div class="input-field col s6">
								<i class="material-icons prefix">attach_money</i>
								<label for="rek_bank" >Nomer Rekening</label>
								<input  id="rek_bank"  name="rek_bank" class="materialize-textarea validate" rows="5" required type="number">
							</div>
							<div class="col s6 m3">
								<label for="nama_provinsi">Pilih Provinsi</label>
								<select  id="nama_provinsi" class="browser-default"  name="nama_provinsi" required >
								</select>
							</div>
							<div class="col s6 m3">
								<label for="nama_distrik">Pilih Distrik</label>
								<select  id="nama_distrik" class="browser-default"  name="nama_distrik" required >
								</select>
							</div>
							<div class="col s12 m3">
								<label>Nama Provinsi</label>
								<input readonly type="text" placeholder="nama provinsi" name="provinsi">
							</div>
							<div class="col s12 m3">
								<label>Nama Distrik</label>
								<input readonly  type="text" placeholder="nama distrik" name="distrik">
							</div>
							<div class="input-field col s5">
								<i class="material-icons prefix">account_circle</i>
								<label for="alamat_toko" >Alamat Toko</label>
								<input  id="alamat_toko"  type="text" name="alamat_toko" required>
							</div>
							<div class="input-field col s7">
								<i class="material-icons prefix">description</i>
								<label for="deskripsi_toko" >Deskripsi Toko</label>
								<textarea  id="deskripsi_toko"  name="deskripsi_toko" class="materialize-textarea validate" rows="5" required></textarea>
							</div>
						</div>

						<div class="file-field input-field">
							<div class="btn">
								<span>Foto</span>
								<input type="file" name="foto_toko">
							</div>
							<div class="file-path-wrapper">
								<input class="file-path validate" type="text">
							</div>
						</div>
						<button class="btn waves-effect waves-light right" name="simpan">simpan
							<i class="material-icons right">send</i>
						</button>
					</div>
				</form>

				<?php 	
 //jika ada tombol kirim
				if(isset($_POST["simpan"])) {
        // upload dulu foto toko
					$id_toko = $id_pelanggan;
					$namafoto=$_FILES["foto_toko"]["name"];
					$lokasifoto=$_FILES["foto_toko"]["tmp_name"];
					$namafiks=date("YmdHis").$namafoto;

					$ekstensiGambarValid = ['jpg','jpeg','png'];
					$ekstensiGambar = explode('.', $namafiks);
					$ekstensiGambar = strtolower(end($ekstensiGambar));
					if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
						echo "<script>
						alert('yang anda upload bukan gambar!');
						</script>
						";
					} else {
						move_uploaded_file($lokasifoto, "assets/img/toko/$namafiks");

						$nama_toko =$_POST["nama_toko"];
						$telepon_toko =$_POST["telepon_toko"];
						$email_toko =$_POST["email_toko"];
						$provinsi_toko=$_POST["provinsi"];            
						$distrik_toko=$_POST["distrik"];  
						$alamat_toko =$_POST["alamat_toko"];
						$nama_bank =$_POST["nama_bank"];
						$rek_bank =$_POST["rek_bank"];
						$deskripsi_toko =$_POST["deskripsi_toko"];
						$bergabung = date('Y-m-d', time()+60*60*6) ;

			// cek apakah email sudah digunakan
						$ambil = $koneksi->query("SELECT * FROM toko WHERE email_toko='$email_toko'");
						$yangcocok =$ambil->num_rows;
						if ($yangcocok== true)
						{
							echo "<script>alert('pendaftaran gagal, email sudah digunakan');</script>";
							echo "<script>location='daftar_pelanggan.php';</script>";
						}
						else 
						{

        // simpan pendaftaran
							$toko = $koneksi->query("INSERT INTO toko (id_toko,nama_toko,deskripsi_toko,foto_toko,email_toko,provinsi_toko,distrik_toko,alamat_toko,telepon_toko,nama_bank,rek_bank,bergabung)
								VALUES ('$id_toko','$nama_toko','$deskripsi_toko','$namafiks','$email_toko','$provinsi_toko','$distrik_toko','$alamat_toko','$telepon_toko','$nama_bank','$rek_bank','$bergabung')");
							$koneksi->query("UPDATE pelanggan SET status='penjual' WHERE id_pelanggan='$id_pelanggan' ");


							echo "<script>alert('pendaftaran sukses, silahkan login');</script>";
							echo "<script>location='logout.php';</script>";
							exit();

						}
					}

				}

				?>
			</div>
		</section>
		<br><br><br>
		<?php include"footer.php"; ?>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
		<script>
			  //  API RAJA ONGKIR
			  $(document).ready(function(){
			  	$.ajax({
			  		type:'post',
			  		url:'dataprovinsi.php',
			  		success:function(hasil_provinsi)
			  		{
			  			$("select[name=nama_provinsi]").html(hasil_provinsi);
			  		}
			  	});

			  	$("select[name=nama_provinsi]").on("change",function(){
        	// ambil id_provinsi yang dipilih (dari attribut pribadi/bid'ah)
        	var id_provinsi_terpilih = $("option:selected",this).attr("id_provinsi");
        	$.ajax({
        		type:'post',
        		url:'datadistrik.php',
        		data: 'id_provinsi='+id_provinsi_terpilih,
        		success:function(hasil_distrik)
        		{
        			$("select[name=nama_distrik]").html(hasil_distrik);
        		}
        	});
        });
			  	$.ajax({
			  		type:'post',
			  		url:'dataekspedisi.php',
			  		success:function(hasil_ekspedisi)
			  		{
			  			$("select[name=nama_ekspedisi]").html(hasil_ekspedisi);
			  		}
			  	});

			  	$("select[name=nama_ekspedisi]").on("change",function(){
				//mendapatkan data ongkos kirim

				// mendapatkan ekspedisi yang dipilih
				var ekspedisi_terpilih = $("select[name=nama_ekspedisi]").val();
				//mendapatkan id_distrik yang dipilih pengguna
				var distrik_terpilih = $("option:selected","select[name=nama_distrik]").attr("id_distrik");
				//mendapatkan total_berat dari inputan
				var total_berat = $("input[name=total_berat]").val();
				$.ajax({
					type:'post',
					url:'datapaket.php',
					data:'ekspedisi='+ekspedisi_terpilih+'&distrik='+distrik_terpilih+'&berat='+total_berat,
					success:function(hasil_paket)
					{
						// console.log(hasil_paket);
						$("select[name=nama_paket]").html(hasil_paket);

						// letakkan nama ekspedisi terpilih diinput ekspedisi
						$("input[name=ekspedisi]").val(ekspedisi_terpilih);

					}

				}) 
			});
			  	$("select[name=nama_distrik]").on("change",function(){
			  		var prov = $("option:selected",this).attr("nama_provinsi");
			  		var dist = $("option:selected",this).attr("nama_distrik");
			  		var tipe = $("option:selected",this).attr("tipe_distrik");
			  		var kodepos = $("option:selected",this).attr("kodepos");

			  		$("input[name=provinsi]").val(prov);
			  		$("input[name=distrik]").val(dist);
			  		$("input[name=tipe]").val(tipe);
			  		$("input[name=kodepos]").val(kodepos);

			  	});
			  	$("select[name=nama_paket]").on("change",function(){
			  		var paket = $("option:selected",this).attr("paket");
			  		var ongkir = $("option:selected",this).attr("ongkir");
			  		var etd = $("option:selected",this).attr("etd");
			  		$("input[name=paket]").val(paket);
			  		$("input[name=ongkir]").val(ongkir);
			  		$("input[name=estimasi]").val(etd);

			  	})

			  });
			  document.addEventListener('DOMContentLoaded', function() {
			  	var elems = document.querySelectorAll('select');
			  	var instances = M.FormSelect.init(elems, options);
			  });
  // Or with jQuery

  $(document).ready(function(){
  	$('select').formSelect();
  });
</script>
<?php } ?>
</body>
</html>

