  <?php
 $id_toko =$_SESSION['penjual'];
 $ambil=$koneksi->query("SELECT * FROM toko 
 	LEFT JOIN pelanggan ON toko.id_toko=pelanggan.id_pelanggan
 	WHERE id_toko='$id_toko' ");
    $pecah = $ambil->fetch_assoc() ;?>
    <h2 class="text-center">Selamat Datang <br> <?php echo $pecah['nama_toko']; ?></h2>
<br> <br> <br>  
    <?php
    $ambil= $koneksi->query("SELECT * FROM produk 
        LEFT JOIN toko ON produk.id_toko=toko.id_toko
        WHERE produk.id_toko='$id_toko'");
    while ($pecah = $ambil->fetch_assoc()) {
       $data[]= $pecah;
   }
   $produk = 0;
   $stok_produk = 0;
   $stok_awal = 0;
   $produk_terjual = 0;
   $total_pembelian = 0 ;
    
   
   if (isset($data)) {
   foreach ($data as $key => $value) :{
    $value['id_toko']=1 ;
    $toko = $value['id_toko'];
    $produk += $toko;
    $stok_awal += $value['stok_awal'];
    $stok_produk += $value['stok_produk'];
    $produk_terjual = $stok_awal - $stok_produk;
    $total_pembelian +=   $value['harga_produk'] * ( $value['stok_awal'] - $value['stok_produk']) ;
  
}endforeach;        
   } 
    
?>
<style>
    .img-card {
        position: absolute; 
        z-index: auto; 
        opacity: 0.5; 
        margin: 10px;
    }
    .logo-card {
        position: relative; 
        margin: 15px ;
        color: white;
    }
    .tittle-card {
        margin-left: 20px;
        width: 120pt;
    }
    .content-card {
        margin-top:30px;
    }
</style>
<div class="row">
   <div class="col s12 m6 l3 ">
   <div class="card horizontal teal hoverable">
      <div class="col s12">
         <img src="../assets/img/homepage/background.jpg" height="70" width="70"  class="img-card circle">   
         <a href="index.php?halaman=produk"><i class="logo-card medium material-icons">local_offer</i></a>
         <p class="tittle-card"><b>Jenis Produk</b></p>
     </div>
     <div class="card-stacked">
         <div class="col s8 offset-s4"><h3 class="content-card right"><b><?php if ($produk < 1): ?>
           <?php echo  "-" ?>
           <?php else: ?>
            <?php echo  $produk; ?>
         <?php endif; ?></b></h3> </div>
     </div>
 </div>
</div>
<div class="col s12 m6 l3 ">
   <div class="card horizontal teal hoverable">
      <div class="col s12">
         <img src="../assets/img/homepage/background.jpg" height="70" width="70"  class="img-card circle">   
         <a href="index.php?halaman=produk"><i class="logo-card medium material-icons">local_mall</i></a>
         <p class="tittle-card"><b>Stok Produk</b></p>
     </div>
     <div class="card-stacked">
         <div class="col s8 offset-s4"><h3 class="content-card right"><b><?php if ($stok_produk < 1): ?>
           <?php echo   "-" ?>
           <?php else: ?> 
            <?php echo  $stok_produk; ?>
         <?php endif ;?></b></h3> </div>
     </div>
 </div>
</div>
<div class="col s12 m6 l3 ">
   <div class="card horizontal teal hoverable">
      <div class="col s12">
         <img src="../assets/img/homepage/background.jpg" height="70" width="70"  class="img-card circle">   
         <a href="index.php?halaman=produk"><i class="logo-card medium material-icons">local_shipping</i></a>
         <p class="tittle-card"><b>Produk Terjual</b></p>
     </div>
     <div class="card-stacked">
         <div class="col s8 offset-s4"><h3 class="content-card right"><b><?php if ($produk_terjual < 1): ?>
           <?php echo  "-" ?>
           <?php else: ?>
            <?php echo  $produk_terjual; ?>
         <?php endif ;?></b></h3> </div>
     </div>
 </div>
</div>
<div class="col s12 m6 l3 ">
   <div class="card horizontal teal hoverable">
      <div class="col s12">
         <img src="../assets/img/homepage/background.jpg" height="70" width="70"  class="img-card circle">   
         <a href="index.php?halaman=produk"><i class="logo-card medium material-icons">monetization_on</i></a>
         <p class="tittle-card"><b>Pendapatan</b></p>
     </div>
     <div class="card-stacked">
         <div class="col s6 offset-s2"><?php if ($total_pembelian < 1): ?>
           <h3 class="content-card right"><b><?php echo   "-" ?></b></h3>
           <?php else: ?> 
            <h5 class="content-card right"><b>Rp.<?php echo  number_format($total_pembelian) ?>
         <?php endif; ?></b></h5> </div>
     </div>
 </div>
</div>



</div>


<!-- 
<?php 
$ambil=$koneksi->query("SELECT * FROM toko LEFT JOIN pelanggan ON toko.id_toko=pelanggan.id_pelanggan WHERE id_toko") ;
$pecah=$ambil->fetch_assoc();?>

<h2 class="text-center">Selamat Datang Penjual <?php echo $pecah['nama_toko']; ?></h2>

<pre>
	<?php print_r($pecah); ?>
</pre> -->