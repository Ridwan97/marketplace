  <?php 	
session_start();
// Mendapatkan id produk di url
$id_produk = $_GET['id'];

// jika sudah ada produk itu dikerajang, maka produk itu jumlahnya di +1
if(isset($_SESSION['keranjang'][$id_produk]))
{
	$_SESSION['keranjang'][$id_produk]+=1;
}
// Selain itu (belum ada di keranjang ), maka produk itu dianggap dibeli 1
else
{
	$_SESSION['keranjang'][$id_produk] = 1;
}

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

//larikan ke halaman keranjang
echo "<script>alert('produk telah masuk ke keranjang belanja');</script>";
echo "<script>location='keranjang.php';</script>";
 ?>

<?php 
session_start();

// mendapatkan id pelanggan di url
$id_pelanggan = $GET['id'];

// 
	if (isset($_SESSION['toko'][$id_pelanggan])) 
	{
		$_SESSION['toko'][$id_pelanggan] ;	
	}



 ?>