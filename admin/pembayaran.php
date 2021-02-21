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
		<table class="table centered striped">
			<tr>
				<th>Nama</th>
				<td><?php echo $detail['nama'] ;?> </td>
			</tr>
			<tr>
				<th>Bank</th>
				<td> <?php echo $detail['bank']; ?> </td>
			</tr>
			<tr>
				<th>Jumlah</th>
				<td>Rp.<?php echo number_format($detail['jumlah']); ?> </td>
			</tr>
			<tr>
				<th>Tanggal</th>
				<td> <?php echo date("d F Y",strtotime($detail['tanggal'])) ; ?> </td>
			</tr>
			<?php if (!empty($detail['resi_pengiriman'])): ?>
				<tr>
					<th>Resi pengiriman</th>
					<td><?php echo $detail['resi_pengiriman']; ?></td>
				</tr>
			<?php endif ?>
		</table>
	</div>
	<div class="col s6">
		<img src="../assets/img/bukti_pembayaran/<?php echo $detail['bukti']  ?>" class="img-responsive" style="width: 200px; height: 200px;">
	</div>
</div>
<div class="input-field col s2">
				<a href="index.php?halaman=pembelian" class="btn red">Kembali</a>
			</div>	
