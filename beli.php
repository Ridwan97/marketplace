  <?php 	
  session_start();
  include 'koneksi.php';
// mendapatkan id produk dari url
  $id_produk = $_GET["id"];

	// query ambil data

  $ambil = $koneksi->query("SELECT * FROM toko 
  	JOIN produk ON toko.id_toko = produk.id_toko WHERE produk.id_produk = '$id_produk'"); 
  $detail =$ambil->fetch_assoc();
  if (!isset($_SESSION['pelanggan'])) {
  	echo "<script>alert('anda belum terdaftar sebagai pelanggan');</script>";
  	echo "<script>location='daftar.php';</script>";
  }
  if (!isset($_SESSION['penjual']) OR empty($_SESSION['penjual'])) {
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
  } elseif ($_SESSION['penjual'] == $detail['id_toko']) {
  	echo "<script>alert('Tidak dapat membeli produk sendiri');</script>";
  	echo "<script>location='index.php';</script>";
  } else {
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
  }


  ?>