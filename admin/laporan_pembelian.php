<?php 	
$ambil = $koneksi->query("SELECT * FROM pengiriman");
while($tiap = $ambil->fetch_assoc())
{
	$datapengiriman[] = $tiap;
}
$semuadata=array();
$tgl_mulai="";
$tgl_selesai="";
$status="";


if (isset($_POST["kirim"])) 
{
	$tgl_mulai = $_POST["tglm"];
	$tgl_selesai= $_POST["tgls"];
	$status = $_POST["status"];
	$ambil = $koneksi->query("SELECT * FROM pembelian 
		JOIN pelanggan  ON pembelian.id_pelanggan=pelanggan.id_pelanggan
		JOIN toko ON pembelian.id_toko = toko.id_toko 
		JOIN pengiriman ON pembelian.id_pengiriman=pengiriman.id_pengiriman 
		WHERE pembelian.id_pengiriman='$status' AND tanggal_pembelian BETWEEN 
		'$tgl_mulai' AND '$tgl_selesai' ");
	while($pecah = $ambil->fetch_assoc())
	{
		$semuadata[]=$pecah;
	}
	 // echo "<pre>";
	 // print_r($semuadata);
	 // echo "</pre>";
}
?>

<h2 class="text-center">Laporan Pembelian <?php echo $tgl_mulai ?> Sampai <?php echo $tgl_selesai ?></h2>	
	<form method="post">	
		<div class="row">
			<div class="col s12">
				<div class="row">
					<div class="input-field col s3">
						<i class="material-icons prefix">date_range</i>
						<input type="date" name="tglm" value="<?php echo $tgl_mulai ?>">	
					<label>Tanggal Mulai</label>
					</div>
					<div class="input-field col s3">
						<i class="material-icons prefix">date_range</i>
						<input type="date" name="tgls" max="<?php  echo	date('Y-m-d', time()+60*60*6) ?>" value="<?php echo 	$tgl_selesai ?>">
					<label>Tanggal Mulai</label>
					</div>
				<div class="input-field col s4">
				<i class="material-icons prefix">local_shipping</i>
					<select name="status">
						<option value="" disabled selected></option>
							<?php foreach ($datapengiriman as $key => $value): ?>
						<option value="<?php echo $value['id_pengiriman'] ?>"><?php echo $value['status_pengiriman'] ?></option>
							<?php endforeach; ?>
					</select>
				<label>Status Pengiriman</label>
			</div>  
					<br>
						<button class="btn waves-effect waves-light col s2" name="kirim">LIHAT LAPORAN</button>		
				</div>	
			</div>	
		</div>
	</form>	

<table class="table centered striped">
	<thead>
		<tr>
			<th>NO</th>
			<th>Pelanggan</th>
			<th>Nama Toko</th>
			<th>Tanggal</th>
			<th>Status</th>	
			<th>Jumlah</th>	
		</tr>	
	</thead>	
	<tbody> 
		<?php 	$total=0; ?>
		<?php foreach ($semuadata as $key => $value): ?>
			<?php 	$total+=$value["total_pembelian"]; ?>
			<tr>
				<td><?php echo 	$key+1; ?></td>
				<td><?php echo 	$value["nama_pelanggan"] ;?></td>
				<td><?php echo $value["nama_toko"] ;?></td>
				<td><?php echo 	date("d F Y",strtotime($value["tanggal_pembelian"])); ?></td>
				<td><?php echo 	$value["status_pengiriman"] ;?><br>	
					<?php echo 	$value["resi_pengiriman"]; ?>
				</td>
				<td><?php 
				if ($value["total_pembelian"] == 0) {
					echo "-";
				}
					elseif ($value["total_pembelian"] > 1) {
					echo "Rp.".number_format($value["total_pembelian"]); 
					
				} ?>
				</td>
			</tr>
		<?php endforeach ?>
		<tbody>
			<tr>
				<td colspan="5"	> <strong>TOTAL</strong></td>	
				<td><strong><?php 
				if ($total == 0) {
					echo "-";
				}
					elseif ($total > 1) {
					echo "Rp.".number_format($total); 
					
				} ?></strong></td>	
			</tr>
		</tbody>
	</tbody>		
</table>		
	
<?php if (isset($_POST['kirim'])): ?>														
<a href="download_laporan.php?tglm=<?php echo $tgl_mulai ?>&tgls=<?php echo $tgl_selesai ?>&status=<?php echo $status ?>" target="_blank">Download PDF</a>
<?php endif; ?>																				




<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
<script>
// Using with jQuery
$(document).ready(function(){
	$('.datepicker').datepicker();
});

</script>