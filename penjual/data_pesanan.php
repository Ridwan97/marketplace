<h2><center>Data Pembelian</center></h2>
<br>
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
		<?php $nomor=1 ; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian 
		JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan
		JOIN toko ON pembelian.id_toko=toko.id_toko
		WHERE pembelian.id_toko='$_SESSION[penjual]' "); ?>
		<?php while($pecah = $ambil->fetch_assoc()) { ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_pelanggan'] ; ?></td>
			<td><?php echo date("d F Y",strtotime($pecah['tanggal_pembelian'])) ; ?></td>
			<td><?php echo $pecah["nama_toko"]; ?></td>
			<td><?php echo $pecah['status_pembelian']; ?></td>
			<td>Rp.<?php echo number_format($pecah['total_pembelian']); ?></td>
			<td>
				<a href="index.php?halaman=detail&id=<?php echo $pecah['id_pembelian']; ?>" 
					class="btn cyan">detail</a>
					<?php if($pecah['status_pembelian']!=='Belum Dibayar'): ?>
					<a href="index.php?halaman=pembayaran&id=<?php echo $pecah['id_pembelian'] ?>"> <button class="btn amber">pembayaran</button></a>
				<?php endif ?>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>