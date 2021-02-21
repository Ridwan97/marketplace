  <?php 
//koneksi ke database
session_start();
include '../koneksi.php';
if (!isset($_SESSION['admin'])) 
{
	echo "<script>alert('Anda Harus Login');</script>";
	echo "<script>location='login.php';</script>";
	header('location:login.php');
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
  <?php   include "header.php" ?>
  <title>Admin | Computer Onshop</title>
 
</head>
<body>
  <div id="wrapper">
    <nav class="navbar navbar-cls-top " style="margin-bottom: 0">
      <div class="nav-wrapper navbar-header">
        <a href="#" data-target="slide-out" class="sidenav-trigger show-on-large"><i class="material-icons">menu</i></a>
       <a class="navbar-brand"  href="index.php">ADMIN</a> 
       <ul class="right">
        <li >
          Last access : <?php echo date("d M Y H:i:s", time()+60*60*5) ;?> 
        </li>
        <li>
          <a href="index.php?halaman=logout" class="waves-effect waves-light btn-small red darken-3 ">Logout</a> 
        </li>
      </ul>
    </div>
  </nav>   
  
  <!-- /. NAV TOP  -->
       <ul class="sidenav sidenav-fixed" id="slide-out" >
        <li class="text-center">
            <img src="../assets/img/admin/<?=  $_SESSION['admin']['foto_admin'];    ?>" class="user-image img-responsive"/>
            <h5 class="brown-text"><?php echo $_SESSION['admin']['nama_lengkap']; ?></h5>
         
        </li>

        <li><a href="index.php"><i class="tiny material-icons">home</i>Home</a></li>
<!--         <li><a href="index.php?halaman=kategori"><i class="tiny material-icons">label</i>Kategori</a></li> -->
        <li><a href="index.php?halaman=produk"><i class="tiny material-icons">local_offer</i>Produk</a></li>
        <li><a href="index.php?halaman=pembelian"><i class="tiny material-icons">shopping_cart</i>Pembelian</a></li>
        <li><a href="index.php?halaman=laporan_pembelian"><i class="tiny material-icons">insert_drive_file</i>Laporan</a></li>
        <li><a href="index.php?halaman=pelanggan"><i class="tiny material-icons">account_circle</i>Pelanggan</a></li>
        <li><a href="index.php?halaman=penjual"><i class="tiny material-icons">store</i>Penjual</a></li>
        <li><a href="index.php?halaman=logout"><i class="tiny material-icons">exit_to_app</i>Logout</a></li>     
      </div>

    <!-- /. NAV SIDE  -->
    <div id="page-wrapper" >
      <div id="page-inner"> 
        <?php 
        if (isset($_GET['halaman'])) 
        {
          if ($_GET['halaman']=='produk') {
            include 'produk.php';
          }
          elseif ($_GET['halaman']=='pembelian') {
            include 'pembelian.php';
          }
          elseif ($_GET['halaman']=='pelanggan'){
            include 'pelanggan.php';
          }
          elseif ($_GET['halaman']=='detail') {
            include 'detail.php';
          }
          elseif ($_GET['halaman']=='tambahproduk') {
            include 'tambahproduk.php';
          }
          elseif ($_GET['halaman']=='hapusproduk') {
            include 'hapusproduk.php';
          }
          elseif ($_GET['halaman']=='ubahproduk') {
            include 'ubahproduk.php';
          }
          elseif ($_GET['halaman']=='logout') {
           include 'logout.php';
         }
         elseif ($_GET['halaman']=='pembayaran') {
           include'pembayaran.php';
         }
         elseif ($_GET['halaman']=='laporan_pembelian') {
           include'laporan_pembelian.php';
         }
         elseif ($_GET['halaman']=='kategori') {
           include'kategori.php';
         }
         elseif ($_GET['halaman']=='detailproduk') {
           include'detailproduk.php';
         }
         elseif ($_GET['halaman']=='hapusfotoproduk') {
           include'hapusfotoproduk.php';
         }
          elseif ($_GET['halaman']=='penjual') {
           include'penjual.php';
         }
          elseif ($_GET['halaman']=='hapuspelanggan') {
           include'hapuspelanggan.php';
         }
         elseif ($_GET['halaman']=='detailpelanggan') {
           include'detailpelanggan.php';
         }
         elseif ($_GET['halaman']=='hapuspenjual') {
           include'hapuspenjual.php';
         }
         elseif ($_GET['halaman']=='detailpenjual') {
           include'detailpenjual.php';
         }
       }
       else
       {
        include 'home.php';
      }  
      ?>

    </div>
    <!-- /. PAGE INNER  -->
  </div>
  <!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
<script>
  //sidenav
    const sidenav = document.querySelectorAll('.sidenav');
    M.Sidenav.init(sidenav);

    //formSelect 
  $(document).ready(function(){
    $('select').formSelect();
  });

  //datepicker
// $(document).ready(function(){
//   $('.datepicker').datepicker();

// });
</script>
</body>
</html> 