 <?php
include '../koneksi.php';

// Require composer autoload
require_once  '../assets/vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();

$mpdf->SetWatermarkImage('../assets/img/homepage/logo.png');
$mpdf->showWatermarkImage = true;

// echo "<pre>";
// print_r($_GET);
// echo "</pre>";

$tgl_mulai = $_GET["tglm"];
$tgl_selesai = $_GET["tgls"];
$status = $_GET["status"];
$id_toko	= $_GET['id'];

$semuadata= array();
$ambil = $koneksi->query("SELECT * FROM pembelian 
		JOIN pelanggan  ON pembelian.id_pelanggan=pelanggan.id_pelanggan 
		JOIN pengiriman ON pembelian.id_pengiriman=pengiriman.id_pengiriman 
		JOIN toko ON pembelian.id_toko=toko.id_toko
		WHERE  pembelian.id_toko = '$id_toko'
		AND pembelian.id_pengiriman='$status' AND tanggal_pembelian BETWEEN 
		'$tgl_mulai' AND '$tgl_selesai' ");
	while($pecah = $ambil->fetch_assoc())
	{
		$semuadata[]=$pecah;
	}

$isi= "<h1><center>Laporan Penjualan</center> </h1>";
$isi.= "<h1><center>".$semuadata['status_pengiriman']. date("d F Y",strtotime($tgl_mulai))." - ".date("d F Y",strtotime($tgl_selesai))."</center></h1>";
$isi.= "<table  border='1' cellpadding='10' cellspacing='0' text-align='center'>";
	$isi.= "<thead>
		<tr>
			<th>NO</th>
			<th>Pelanggan</th>
			<th>Toko</th>
			<th>Tanggal</th>
			<th>Status</th>	
			<th>Jumlah</th>	
		</tr>	
	</thead>	
	<tbody> ";
		$total=0;
		foreach ($semuadata as $key => $value): 
		 	$total+=$value["total_pembelian"]; 
		 	$nomor = $key+1;
			 $isi.= "<tr>";
				$isi.= "<td>".$nomor."</td>";
				$isi.= "<td>".$value["nama_pelanggan"]."</td>";
				$isi.= "<td>".$value["nama_toko"]."</td>";
				$isi.= "<td>".date("d F Y",strtotime($value["tanggal_pembelian"]))."</td>";
				$isi.="<td>".$value["status_pengiriman"]."<br>".$value["resi_pengiriman"]."</td>";
				$isi.="<td>Rp.".number_format($value["total_pembelian"])."</td>";
			$isi.= "</tr>";
		 endforeach;
		$isi.= "<tbody >";
			$isi.= "<tr>";
				$isi.= "<td colspan='5'><center> <strong>TOTAL</strong></center></td>";
				$isi.= "<td><strong>Rp.".number_format($total)."</strong></td>";
			$isi.= "</tr>
		</tbody>
	</tbody>		
</table>	";

// Write some HTML code:
$mpdf->WriteHTML($isi);

// Output a PDF file directly to the browser
$mpdf->Output("laporan.pdf","I");
?>

