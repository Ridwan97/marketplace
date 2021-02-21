<?php 
// mendapatkan id_pemebelian dari url
$id_pembelian = $_GET['id'];

// mengambil data pembayaran berdasarkan id_pembelian
$ambil = $koneksi->query("SELECT * FROM pembayaran 
	JOIN toko ON pembayaran.id_toko = toko.id_toko 
	JOIN pembelian ON pembayaran.id_pembelian = pembelian.id_pembelian
	WHERE pembayaran.id_pembelian='$id_pembelian'");

$detail= $ambil->fetch_assoc();

$datapengiriman = array();

$ambil = $koneksi->query("SELECT * FROM pengiriman");
while($tiap = $ambil->fetch_assoc())
{
	$datapengiriman[] = $tiap;
}
?>

<h2 class="text-center"> Data Pembayaran</h2>


<div class="row">
	<div class="col s6">
		<table class="table hoverable striped">
			<tr>
				<th>Nama Pelanggan</th>
				<td>: <?php echo $detail['nama'] ;?> </td>
			</tr>
			<tr>
				<th>Bank</th>
				<td>: <?php echo $detail['bank']; ?> </td>
			</tr>
			<tr>
				<th>Jumlah</th>
				<td>: Rp.<?php echo number_format($detail['jumlah']); ?> </td>
			</tr>
			<tr>
				<th>Tanggal</th>
				<td>: <?php echo date("d F Y",strtotime($detail['tanggal'])) ; ?> </td>
			</tr>
			<?php if (!empty($detail['resi_pengiriman'])): ?>
				<tr>
					<th>Resi pengiriman</th>
					<td>: <?php echo $detail['resi_pengiriman']; ?></td>
				</tr>
			<?php endif ?>
		</table>
	</div>
	<div class="col s6">
		<img src="../assets/img/bukti_pembayaran/<?php echo $detail['bukti']  ?>" class="img-responsive hoverable" style="width: 200px; height: 200px;">
	</div>
</div>

<div class="row">
	<form method="post">
		<?php if (!empty($detail['resi_pengiriman'])): ?>
			<div class="input-field col s2">
				<a href="index.php?halaman=data_penjualan" class="btn blue">Kembali</a>
			</div>	
		<?php else: ?>		
			<div class="input-field col s2">
				<a href="index.php?halaman=data_penjualan" class="btn blue">Kembali</a>
			</div>
			<div class="input-field col s6">
				<i class="material-icons prefix">local_shipping</i>
					<select name="id_pengiriman">
						<option value="" disabled selected></option>
							<?php foreach ($datapengiriman as $key => $value): ?>
						<option value="<?php echo $value['id_pengiriman'] ?>"><?php echo $value['status_pengiriman'] ?></option>
							<?php endforeach; ?>
					</select>
				<label>Status Pembayaran</label>
			</div>  
			<br>
			<button class="btn green waves-effect waves-dark col s1" name="proses">Proses</button> &nbsp;
		<?php endif ;?>
			<!-- 	<a href="index.php?halaman=pembelian" class="btn red waves-effect waves-dark col s1">kembali</a> -->
		</form>
	</div>

	<?php 
	if (isset($_POST["proses"])) 
	{
		if ($_POST['id_pengiriman'] < 2) {
			echo "<script>alert('tidak ada nomer resi');</script>";
		} else {
			$resi  = 'RESI'.date("Y").$letter = chr(rand(65,90)).rand(1,10).date("m").$letter = chr(rand(97,122)).rand(10,100).date("d");
			$id_pengiriman =$_POST['id_pengiriman'];
			$koneksi->query("UPDATE pembelian SET resi_pengiriman='$resi', id_pengiriman='$id_pengiriman' WHERE id_pembelian='$id_pembelian' ");

			echo "<script>alert('data pembelian terupdate');</script>";
			echo "<script>location='index.php?halaman=data_penjualan';</script>";
		}

	}

	?>


