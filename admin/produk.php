 <h2 class="text-center">Data Produk</h2>
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
<table class='table striped centered' align="center">
	 <thead>
		<tr>
			<th>No</th>
			<th>Kategori</th>
			<th>Nama Toko</th>
			<th>Nama Produk</th>
			<th>Harga</th>
			<th>Berat</th>
			<th>Foto</th>
			<th>Awal Produk</th>
			<th>Stok produk</th>
			<th>Aksi</th> 
		</tr>
	</thead>
	<tbody align="center">	
  <?php if ((isset($_POST['keyword']))): ?>
    <?php  $page = (isset($_GET['page']))? (int) $_GET['page'] : 1;
    $limit = 5;
    $limitStart = ($page - 1) * $limit;
    $keyword= $_POST["keyword"];
    $SqlQuery=$koneksi->query("SELECT * FROM produk 
		JOIN toko ON produk.id_toko=toko.id_toko 
		LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori 
		WHERE nama_toko LIKE '%$keyword%' 
		OR nama_produk LIKE '%$keyword%'
		OR nama_kategori LIKE '%$keyword%'  
		ORDER BY id_produk
      LIMIT ".$limitStart.",".$limit);
    $nomor = $limitStart + 1;
    while($row = mysqli_fetch_array($SqlQuery)){   
     ?>
     <?php echo   $keyword ?>
		<tr>
			<td><?php echo $nomor ; ?></td>	
			<td><?php echo $row['nama_kategori'] ;?></td>
			<td><?php echo $row['nama_toko'] ?></td>
			<td><?php echo $row['nama_produk'] ;?></td>
			<td>Rp.<?php echo number_format($row['harga_produk']) ; ?></td>
			<td><?php echo $row['berat_produk'] ; ?>(Gr)</td>
			<td><img src="../assets/img/produk/<?php echo $row['foto_produk'] ;?>" width="100"></td>
			<td><?php echo $row['stok_awal'] ?></td>
			<td><?php echo $row['stok_produk']; ?></td>
			<td>
				<a href="index.php?halaman=detailproduk&id=<?php echo $row['id_produk']; ?>" class="btn cyan waves-effect waves-light">detail</a>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
<?php else : ?>
		<?php $nomor=1; ?>
		 <?php  $page = (isset($_GET['page']))? (int) $_GET['page'] : 1;
    $limit = 5;
    $limitStart = ($page - 1) * $limit;
  
    $SqlQuery=$koneksi->query("SELECT * FROM produk 
		JOIN toko ON produk.id_toko=toko.id_toko 
		LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori 
		ORDER BY id_produk
      LIMIT ".$limitStart.",".$limit);
    $nomor = $limitStart + 1;
    while($row = mysqli_fetch_array($SqlQuery)){   
     ?>
		<tr>
			<td><?php echo $nomor ; ?></td>	
			<td><?php echo $row['nama_kategori'] ;?></td>
			<td><?php echo $row['nama_toko'] ?></td>
			<td><?php echo $row['nama_produk'] ;?></td>
			<td>Rp.<?php echo number_format($row['harga_produk']) ; ?></td>
			<td><?php echo $row['berat_produk'] ; ?>(Gr)</td>
			<td><img src="../assets/img/produk/<?php echo $row['foto_produk'] ;?>" width="100"></td>
			<td><?php echo $row['stok_awal'] ?></td>
			<td><?php echo $row['stok_produk']; ?></td>
			<td>
				<a href="index.php?halaman=detailproduk&id=<?php echo $row['id_produk']; ?>" class="btn cyan waves-effect waves-light">detail</a>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
		<?php endif; ?>
	</tbody>
</table>
<br>
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
      <li class="active"><a href="index.php?halaman=produk&page=<?php echo $LinkPrev ; ?>"><i class="material-icons">chevron_left</i></a></li>
    <?php }  ?>

    <?php
    $SqlQuery = mysqli_query($koneksi, "SELECT * FROM produk 
		JOIN toko ON produk.id_toko=toko.id_toko 
		LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori 
		ORDER BY id_produk");        

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
      <li  class="waves-effect"><?php echo $linkActive; ?><a href="index.php?halaman=produk&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
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
      <li><a href="index.php?halaman=produk&page=<?php echo $linkNext; ?>"><i class="material-icons">chevron_right</i></a></li>
      <?php
    }
    ?>
  </ul>

</div>

</div>
