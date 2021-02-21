<h2><center>Data Toko</center></h2>
<div class="row">
    <form action="" method="post" autocomplete="off">
      <div class="col s10"> 
        <div class="input-field">
          <i class="material-icons prefix">search</i>
          <input  name="keyword"  placeholder="Cari Data Payroll" autofocus  >         
        </div>
      </div>
      <div class="col s2"><br>  
        <button type="submit" name="cari" class="btn teal">Cari</button>
      </div>        
    </form> 
  </div>
<table class='table centered striped'>
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Pemilik</th>
			<th>Nama Toko</th>
			<th>Foto</th>
			<th>email Toko</th>
			<th>telepon</th>
			<th>aksi</th>
		</tr>
	</thead>
	<tbody >
		 <?php if ((isset($_POST['keyword']))): ?>
      <?php  $page = (isset($_GET['page']))? (int) $_GET['page'] : 1;
      $limit = 10;
      $limitStart = ($page - 1) * $limit;
      $keyword= $_POST["keyword"];
      $SqlQuery=$koneksi->query("SELECT * FROM toko 
      	JOIN pelanggan ON toko.id_toko = pelanggan.id_pelanggan
        WHERE email_toko LIKE '%$keyword%' 
        OR nama_toko LIKE '%$keyword%'
        LIMIT ".$limitStart.",".$limit);
      $nomor = $limitStart + 1;
      while($row = mysqli_fetch_array($SqlQuery)){   
       ?>
		<tr>
			<td><?php echo $nomor ; ?></td>
			<td><?php echo $row['nama_pelanggan']; ?></td>
			<td><?php echo $row['nama_toko'] ; ?></td>
			<td><img class="circle" src="../assets/img/toko/<?php echo $row['foto_toko']; ?>" width="50" height="50"></td>
			<td><?php echo 	$row['email_toko']; ?></td>
			<td><?php echo 	$row['telepon_pelanggan']; ?></td>
			<td>
				<a href="index.php?halaman=detailpenjual&id=<?php echo $row['id_toko']; ?>" class="btn cyan waves-effect waves-light">detail</a>
				<a href="index.php?halaman=hapuspenjual&id=<?php echo $row['id_toko']; ?>" class="btn red waves-effect waves-light">hapus</a>
			</td>
		</tr>
		<?php $nomor++ ?>
		<?php } ?> 
		<?php else: ?> 
	
		<?php 
		 $page = (isset($_GET['page']))? (int) $_GET['page'] : 1;

      // Jumlah data per halaman
     $limit = 10;

     $limitStart = ($page - 1) * $limit;

     $SqlQuery = mysqli_query($koneksi, "SELECT * FROM toko 
      	JOIN pelanggan ON toko.id_toko = pelanggan.id_pelanggan
      LIMIT ".$limitStart.",".$limit);

     $nomor = $limitStart + 1;

     while($row = mysqli_fetch_array($SqlQuery)){ 
		 ?>
		 		<tr>
			<td><?php echo $nomor ; ?></td>
			<td><?php echo $row['nama_pelanggan'] ;?></td>
			<td><?php echo $row['nama_toko'] ; ?></td>
			<td><img class="circle" src="../assets/img/toko/<?php echo $row['foto_toko']; ?>" width="50" height="50"></td>
			<td><?php echo 	$row['email_toko']; ?></td>
			<td><?php echo 	$row['telepon_pelanggan']; ?></td>
			<td>
				<a href="index.php?halaman=detailpenjual&id=<?php echo $row['id_toko']; ?>" class="btn cyan waves-effect waves-light">detail</a>
				<a href="index.php?halaman=hapuspenjual&id=<?php echo $row['id_toko']; ?>" class="btn red waves-effect waves-light">hapus</a>
			</td>
		</tr>
				<?php $nomor++; ?>
		<?php } ?>
		<?php endif; ?>

	
	</tbody>
</table>
<div align="right">
  <ul class="pagination">
    <?php
    // Jika page = 1, maka LinkPrev disable
    if($page == 1){ 
      ?>        

      <!-- link Previous Page disable --> 
      <li class="disabled"><a href="#">Previous</a></li>
      <?php
    } else{ 
      $LinkPrev = ($page > 1)? $page - 1 : 1; 
      ?>

      <!-- link Previous Page --> 
      <li class="active"><a href="index.php?halaman=penjual&page=<?php echo $LinkPrev ; ?>"><i class="material-icons">chevron_left</i></a></li>
    <?php }  ?>

    <?php
    $SqlQuery = mysqli_query($koneksi, "SELECT * FROM  toko 
      	JOIN pelanggan ON toko.id_toko = pelanggan.id_pelanggan");        

      //Hitung semua jumlah data yang berada pada tabel Sisawa
    $JumlahData = mysqli_num_rows($SqlQuery);

      // Hitung jumlah halaman yang tersedia
    $jumlahPage = ceil($JumlahData / $limit); 

      // Jumlah link number 
    $jumlahNumber = 1; 

      // Untuk awal link number
    $startNumber = ($page > $jumlahNumber)? $page - $jumlahNumber : 1; 

      // Untuk akhir link number
    $endNumber = ($page < ($jumlahPage - $jumlahNumber))? $page + $jumlahNumber : $jumlahPage; 

    for($i = $startNumber; $i <= $endNumber; $i++){
      $linkActive = ($page == $i)? '<li class="active">' : '';
      ?>
      <li  class="waves-effect"><?php echo $linkActive; ?><a href="index.php?halaman=penjual&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
      <?php
    }
    ?>

    <!-- link Next Page -->
    <?php       
    if($page == $jumlahPage){ 
      ?>
      <li class="active"><a href="#"><i class="material-icons">chevron_right</i></a></li>
      <?php
    }
    else{
      $linkNext = ($page < $jumlahPage)? $page + 1 : $jumlahPage;
      ?>
      <li><a href="index.php?halaman=pelanggan&page=<?php echo $linkNext; ?>"><i class="material-icons">chevron_right</i></a></li>
      <?php
    }
    ?>
  </ul>

</div>

</div>