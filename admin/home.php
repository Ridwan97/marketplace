  <h2 class="text-center">Selamat Datang Administrator
    <br>   <?php echo $_SESSION['admin']['nama_lengkap'] ;?>
  </h2>

  <?php 
  $ambil = $koneksi->query("SELECT * FROM pelanggan ");
  while ($pecah = $ambil->fetch_assoc()) {
   $data[] = $pecah;
 }
 $jumlahpelanggan = 0;
 if (isset($data)) {
  foreach ($data as $key => $value) :{
   
   $value['id_pelanggan'] =1;
   $pelanggan = $value['id_pelanggan'];
   $jumlahpelanggan+=$pelanggan;
 }
endforeach;
}

?>
  <?php 
  $ambil = $koneksi->query("SELECT * FROM toko ");
  while ($pecah = $ambil->fetch_assoc()) {
   $hanyadata[] = $pecah;
 }
 $jumlahtoko = 0;
 if (isset($hanyadata)) {
  foreach ($hanyadata as $key => $value) :{

   $value['id_toko'] = 1;
   $toko = $value['id_toko'];
   $jumlahtoko+=$toko;
 }
endforeach;
}

?>
<div class="row">
  <div class="col s12 m8 l6 ">
   <div class="card horizontal red hoverable">
    <div class="col s12">
     <img src="../assets/img/homepage/background.jpg" height="70" width="70"  class="img-card circle">   
     <a href="index.php?halaman=pelanggan"><i class="logo-card medium material-icons">account_circle</i></a>
     <p class="tittle-card"><b>Jumlah pelanggan</b></p>
   </div>
   <div class="card-stacked">
     <div class="col s8 offset-s4"><h3 class="content-card right"><b><?php if ($jumlahpelanggan < 1): ?>
     <?php echo   "-"; ?>
     <?php else: ?>
       <?php echo  $jumlahpelanggan; ?> 
       <?php endif ?></b></h3> </div>
     </div>
   </div>
 </div>
 <div class="col s12 m8 l6 ">
   <div class="card horizontal blue hoverable">
    <div class="col s12">
     <img src="../assets/img/homepage/background.jpg" height="70" width="70"  class="img-card circle">   
     <a href="index.php?halaman=penjual"><i class="logo-card medium material-icons">store</i></a>
     <p class="tittle-card"><b>Jumlah Toko</b></p>
   </div>
   <div class="card-stacked">
     <div class="col s8 offset-s4"><h3 class="content-card right"><b><?php if ($jumlahtoko < 1): ?>
     <?php echo  "-" ?>
     <?php else: ?>
       <?php echo  $jumlahtoko; ?> 
       <?php endif ?></b></h3> </div>
     </div>
   </div>
 </div>
</div>
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
<?php
$ambil= $koneksi->query("SELECT * FROM produk 
  JOIN toko ON produk.id_toko=toko.id_toko
  ");
while ($pecah = $ambil->fetch_assoc()) {
 $semuadata[]= $pecah;
}
$produk = 0;
$stok_produk = 0;
$stok_awal = 0;
$total = 0;
$total_pembelian = 0;
$produk_terjual = 0;

if (isset($semuadata)) {
  foreach ($semuadata as $key => $value) :{
    $value['id_toko']=1 ;
    $toko = $value['id_toko'];
    $produk += $toko;
    
    $stok_produk += $value['stok_produk'];
    
    $stok_awal+= $value['stok_awal'];
    $harga_produk =  $value['harga_produk'];
    $produk_terjual = $stok_awal - $stok_produk;
    $total_pembelian +=   $value['harga_produk'] * ( $value['stok_awal'] - $value['stok_produk']) ;

  }
endforeach;
}
?>

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
      <?php endif ?></b></h3> </div>
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
   <div class="col s6 offset-s1"><h3 class="content-card right"><b><?php if ($stok_produk < 1): ?>
   <?php echo "-" ?>
   <?php else: ?>
    <?php echo  $stok_produk; ?>
    <?php endif ?></b></h3> </div>
  </div>
</div>
</div>
<div class="col s12 m6 l3 ">
 <div class="card horizontal teal hoverable">
  <div class="col s12">
   <img src="../assets/img/homepage/background.jpg" height="70" width="70"  class="img-card circle">   
   <a href="index.php?halaman=produk"><i class="logo-card medium material-icons">local_shipping   </i></a>
   <p class="tittle-card"><b>Produk Tejual</b></p>
 </div>
 <div class="card-stacked">
   <div class="col s6 offset-s1"><h3 class="content-card right"><b><?php if ($produk_terjual < 1): ?>
   <?php echo  "-" ?>
   <?php else: ?>
    <?php echo  $produk_terjual; ?>
    <?php endif ?></b></h3> </div>
  </div>
</div>
</div>
<div class="col s12 m6 l3 ">
 <div class="card horizontal teal hoverable">
  <div class="col s12">
   <img src="../assets/img/homepage/background.jpg" height="70" width="70"  class="img-card circle">   
   <a href="index.php?halaman=produk"><i class="logo-card medium material-icons">monetization_on</i></a>
   <p class="tittle-card"><b>Total Pendapatan</b></p>
 </div>
 <div class="card-stacked">
   <div class="col s3 offset-s2"><?php if ($total_pembelian == 0): ?>
   <h3 class="content-card right"><b><?php echo  "-" ?></b></h3>
   <?php else: ?> 
    <h6 class="content-card right"><b>Rp.<?php echo  number_format($total_pembelian); ?>
    <?php endif ?></b></h6> </div>
  </div>
</div>
</div>


</div>
