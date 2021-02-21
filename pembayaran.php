  <?php 
//koneksi ke database
  session_start();
  include"koneksi.php";
  if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan']))
  {
    echo "<script>alert('silahkan login');</script>";
    echo "<script>location='login.php';</script>";
    exit();
  } 
  ?>
  <!-- mendapatkan id_pembelian dari url  -->

  <?php 
  $idpem = $_GET["id"];
  $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
  $detpem = $ambil->fetch_assoc();


// mendapatkan id_pelanggan yang beli
  $id_pelanggan_beli = $detpem["id_pelanggan"];
// mendapatkan id pelanggan yang login
  $id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

  if ($id_pelanggan_login !==$id_pelanggan_beli)
  {
    echo "<script>alert('jangan nakal');</script>";
    echo "<script>location='riwayat.php</script>';";
    exit();
  } ?>
<!-- <pre><?php print_r($detpem) ?></pre>
-->
<!DOCTYPE html>
<html>
<head>
  <?php include "header.php" ?>
  <title>Pembayaran | Computer OnShop</title>
</head>
<body>
  <!-- NAVBAR -->
  <?php include"navbar.php"; ?>
  <div class="container">
    <h2>Konfrimasi Pembayaran</h2>
    <?php 
    $ambil = $koneksi->query("SELECT * FROM pembelian 
      JOIN TOKO ON pembelian.id_toko=toko.id_toko  
      JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan
      WHERE id_pembelian   ='$idpem'");
    while($pecah = $ambil->fetch_assoc()) {
     ?>
     <div class="row">
      <div class="col s3">
        <h5>
          <strong>
            Nama Toko  <br> 
            Nama Bank  <br>  
            Rekening Bank 
          </strong>
        </h5> 
      </div>
      <div class="col s5">
        <h5>
          : <?php echo $pecah['nama_toko'] ;?> <br> 
          : <?php echo $pecah['nama_bank']; ?> <br> 
          : <?php echo  $pecah['rek_bank'] ?>
        </h5>         
      </div>
    </div>
    <p>Kirim bukti pembayaran anda disini. dengan Total tagihan anda <strong>Rp.<?php echo number_format($detpem['total_pembelian']) ?></strong></p>
    <div class="row">
      <form method="post" enctype="multipart/form-data">
        <div class="input-field col s12">
          <i class="material-icons prefix">account_balance</i>
          <select name="bank"  class="validate" required>
            <option value=" "></option>
            <option value="bca">bca</option>
            <option value="bni">bni</option>
            <option value="bri">bri</option>
            <option value="mandiri">mandiri</option>
          </select>
          <label>Pilih bank</label>
        </div>  
        <div class="input-field col s12">
          <i class="material-icons prefix">attach_money</i>
          <input id="jumlah" type="number" required class="validate" name="jumlah" min="1">
          <label for="jumlah">Jumlah</label>
        </div>
        <div class="col s10">
          <div class="file-field input-field">
            <div class="btn">
              <span>File</span>
              <input type="file" name="bukti">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text">
            </div>
          </div>
        </div>
        <div class="col s2">
          <br>
          <button class="btn waves-effect waves-light right" name="kirim">Kirim
            <i class="material-icons right">send</i>
          </button> 
        </div>
      </form>
    </div>  
    <div class="col s2">
      <a href="riwayat.php" class="btn red">Kembali</a>
    </div> <br> <br>  <br>  <br>
    <?php 
      //jika ada tombol kirim
    if(isset($_POST["kirim"])) {
        // upload dulu foto bukti
      $namabukti=$_FILES["bukti"]["name"];
      $lokasibukti=$_FILES["bukti"]["tmp_name"];
      $namafiks=date("YmdHis").$namabukti;

      $ekstensiGambarValid = ['jpg','jpeg','png'];
      $ekstensiGambar = explode('.', $namafiks);
      $ekstensiGambar = strtolower(end($ekstensiGambar));
      if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "<script>
        alert('yang anda upload bukan gambar!');
        </script>
        ";
      } else {
        move_uploaded_file($lokasibukti, "assets/img/bukti_pembayaran/$namafiks");

        $nama =$pecah['nama_pelanggan'];
        $bank =$_POST["bank"];
        $jumlah=$_POST["jumlah"];
        $tanggal=date("Y-m-d");
        $id_toko = $pecah['id_toko']; 
        $total= $detpem['total_pembelian'];

        if($jumlah !== $total) {
          echo "<script>alert('Masukkan Nominal Pemabayaran yang benar');</script>";
        } else {
        // simpan pembayaran
          $koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti,id_toko)
            VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks','$id_toko')");

        // update dong data pembelian
          $koneksi->query("UPDATE pembelian SET id_pengiriman ='1'
            WHERE id_pembelian='$idpem'");

          echo "<script>alert('terima kasih telah, mengirimkan bukti pembayaran');</script>";
          echo "<script>location='riwayat.php';</script>";
          exit();   
        }


      }


    }


    ?>
  <?php } ?>
</div> 
</div>
</body>
<!-- footer -->
<?php include"footer.php" ;?>
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
</html>