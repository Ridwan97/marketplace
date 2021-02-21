 <h2><center>Data Pembelian</center></h2>
<br>
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
<table class="table striped centered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Pelanggan</th>
			<th>Tanggal</th>
			<th>Nama Toko</th>
			<th>Status Pengiriman</th>
			<th>Total</th>
			<th>Aksi</th>	
		</tr>
	</thead>
	<tbody>
   <?php if ((isset($_POST['keyword']))): ?>
    <?php  $page = (isset($_GET['page']))? (int) $_GET['page'] : 1;
    $limit = 10;
    $limitStart = ($page - 1) * $limit;
    $keyword= $_POST["keyword"];
    $SqlQuery=$koneksi->query("SELECT * FROM pembelian 
      JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan
      JOIN toko ON pembelian.id_toko = toko.id_toko
      JOIN pengiriman ON pembelian.id_pengiriman = pengiriman.id_pengiriman
      WHERE nama_pelanggan LIKE '%$keyword%' 
      OR nama_toko LIKE '%$keyword%'
      OR status_pengiriman  LIKE '%$keyword%'
      ORDER BY id_pembelian
      LIMIT ".$limitStart.",".$limit);
    $nomor = $limitStart + 1;
    while($row = mysqli_fetch_array($SqlQuery)){   
     ?>
       <tr>
       	<td><?php echo $nomor; ?></td>
			<td><?php echo $row['nama_pelanggan'] ; ?></td>
			<td><?php echo date("d F Y",strtotime($row['tanggal_pembelian'])) ; ?></td>
			<td><?php echo $row["nama_toko"]; ?></td>
			 <td><?php echo $row['status_pengiriman']; ?><br> 
      <?php if (isset($row['resi_pengiriman'])): ?>
           <?php echo $row['resi_pengiriman'] ;?>
         <?php endif ?> 
      </td>
			<td>Rp.<?php echo number_format($row['total_pembelian']); ?></td>
			 <td>
        <a href="index.php?halaman=detail&id=<?php echo $row['id_pembelian']; ?>" 
          class="btn cyan">detail</a>
          <?php if($row['id_pengiriman'] > 0): ?>
          <a href="index.php?halaman=pembayaran&id=<?php echo $row['id_pembelian'] ?>"> <button class="btn amber">pembayaran</button></a>
        <?php endif ?>
      </td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
		 <?php else: ?> 
	
		<?php 
		 $page = (isset($_GET['page']))? (int) $_GET['page'] : 1;

      // Jumlah data per halaman
     $limit = 10;

     $limitStart = ($page - 1) * $limit;

     $SqlQuery = mysqli_query($koneksi, "SELECT * FROM pembelian 
		JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan
		JOIN toko ON pembelian.id_toko=toko.id_toko
    JOIN pengiriman ON pembelian.id_pengiriman = pengiriman.id_pengiriman
    ORDER BY id_pembelian
      LIMIT ".$limitStart.",".$limit);

     $nomor = $limitStart + 1;

     while($row = mysqli_fetch_array($SqlQuery)){ 
		 ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $row['nama_pelanggan'] ; ?></td>
			<td><?php echo date("d F Y",strtotime($row['tanggal_pembelian'])) ; ?></td>
			<td><?php echo $row["nama_toko"]; ?></td>
			<td><?php echo $row['status_pengiriman']; ?><br>
      <?php if (isset($row['resi_pengiriman'])): ?>
           <?php echo $row['resi_pengiriman'] ;?>
         <?php endif ?>   
      </td>
			<td>Rp.<?php echo number_format($row['total_pembelian']); ?></td>
			<td>
				<a href="index.php?halaman=detail&id=<?php echo $row['id_pembelian']; ?>" 
					class="btn cyan">detail</a>
					<?php if($row['id_pengiriman'] > 0): ?>
					<a href="index.php?halaman=pembayaran&id=<?php echo $row['id_pembelian'] ?>"> <button class="btn amber">pembayaran</button></a>
				<?php endif ?>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	<?php endif ?>
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
      <li class="active"><a href="index.php?halaman=pembelian&page=<?php echo $LinkPrev ; ?>"><i class="material-icons">chevron_left</i></a></li>
    <?php }  ?>

    <?php
    $SqlQuery = mysqli_query($koneksi, "SELECT * FROM pembelian 
		JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan
		JOIN toko ON pembelian.id_toko=toko.id_toko");        

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
      <li  class="waves-effect"><?php echo $linkActive; ?><a href="index.php?halaman=pembelian&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
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
      <li><a href="index.php?halaman=pembelian&page=<?php echo $linkNext; ?>"><i class="material-icons">chevron_right</i></a></li>
      <?php
    }
    ?>
  </ul>

</div>

</div>