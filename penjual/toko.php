  <?php 	
// Mendapatkan id produk di url
$id_toko = $_GET['id'];

// jika sudah ada produk itu dikerajang, maka produk itu jumlahnya di +1
if(isset($_SESSION['penjual'][$id_toko]))
{
	$_SESSION['penjual'][$id_toko]+=1;
}
// Selain itu (belum ada di keranjang ), maka produk itu dianggap dibeli 1
else
{
	$_SESSION['penjual'][$id_toko] = 1;
}

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

//larikan ke halaman keranjang
// echo "<script>alert('produk telah masuk ke keranjang belanja');</script>";
// echo "<script>location='keranjang.php';</script>";
 ?>