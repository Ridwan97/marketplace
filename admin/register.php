<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="shortcut icon" href="favico.ico">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<!-- JUDUL -->
	<h1 align="center">DAFTAR ADMIN</h1>
	<br>
	<!-- FORM -->
	<form action="post" enctype="multipart/form-data" autocomplete="off">
		<div class="container">
			<div class="form-group row">
			    <label for="nama" class="col-sm-2 col-form-label">NAMA</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="nama" placeholder="NAMA" required>
			    </div>
			</div>
			<div class="form-group row">
			    <label for="user" class="col-sm-2 col-form-label">USER ID</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="user" placeholder="USER ID" required>
				</div>
			</div>
			<div class="form-group row">
			    <label for="password" class="col-sm-2 <col-form-label></col-form-label>">PASSWORD</label>
			    <div class="col-sm-10">
			      <input type="password" class="form-control" id="password" placeholder="PASSWORD" required>
			    </div>
			</div>
			<fieldset class="form-group">
			    <div class="row">
			      	<label class="col-form-label col-sm-2 pt-0">JENIS KELAMIN</label>
			      	<div class="col-sm-10">
			        	<div class="form-check">
			          		<input class="form-check-input" type="radio" name="laki-laki" id="laki-laki" value="laki-laki" checked>
			          		<label class="form-check-label" for="laki-laki">LAKI - LAKI </label>
			        	</div>
			        	<div class="form-check">
			          		<input class="form-check-input" type="radio" name="perempuan" id="perempuan" value="permepuan">
			          		<label class="form-check-label" for="perempuan">PEREMPUAN </label>
			        	</div>
			      	</div>
			    </div>
			</fieldset>
			<div class="form-group row">
			    <label for="no_telephone" class="col-sm-2 col-form-label">NO TELEPHONE</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="no_telephone" placeholder="NO TELEPHONE" required>
			    </div>
			</div>
			<div class="form-group row">
			    <label for="tempat" class="col-sm-2 col-form-label">TEMPAT LAHIR</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="tempat" placeholder="TEMPAT LAHIR" required>
			    </div>
			</div>
			<div class="form-group row">
				<label for="tanggal_lahir" class="col-sm-2 col-form-label">TANGGAL LAHIR</label>
				<div class="form-group col-sm-3">
			    	<select class="form-control" id="tanggal_lahir" name="tanggal_lahir">				
						<option selected>TANGGAL LAHIR</option>
						<option value="1"> 1 </option>
						<option value="2"> 2 </option>
						<option value="3"> 3 </option>
						<option value="4"> 4 </option>
						<option value="5"> 5 </option>
						<option value="6"> 6 </option>
						<option value="7"> 7 </option>
						<option value="8"> 8 </option>
						<option value="9"> 9 </option>
						<option value="10"> 10 </option>
						<option value="11"> 11 </option>
						<option value="12"> 12 </option>
						<option value="13"> 13 </option>
						<option value="14"> 14 </option>
						<option value="15"> 15 </option>
						<option value="16"> 16 </option>
						<option value="17"> 17 </option>
						<option value="18"> 18 </option>
						<option value="19"> 19 </option>
						<option value="20"> 20 </option>
						<option value="21"> 21 </option>
						<option value="22"> 22 </option>
						<option value="13"> 23 </option>
						<option value="24"> 24 </option>
						<option value="25"> 25 </option>
						<option value="26"> 26 </option>
						<option value="27"> 27 </option>
						<option value="28"> 28 </option>
						<option value="29"> 29 </option>
						<option value="30"> 30 </option>
						<option value="31"> 31 </option>
					</select>
				</div>
				<div class="form-group col-sm-4">
			    	<select class="form-control" id="bulan_lahir" name="bulan_lahir">
			    		<option selected>BULAN LAHIR</option>	
						<option value="januari"> Januari </option>
						<option value="februari"> Februari </option>
						<option value="maret"> Maret </option>
						<option value="april"> April </option>
						<option value="mei"> Mei </option>
						<option value="juni"> Juni </option>
						<option value="juli"> juli </option>
						<option value="agustus"> Agustus </option>
						<option value="september"> September </option>
						<option value="oktober"> Oktober </option>
						<option value="november"> November </option>
						<option value="desember"> Desember</option>
					</select>
				</div>
				<div class="form-group col-sm-3">
						<input type="text" class="form-control"  name="tahun_lahir" placeholder="TAHUN LAHIR" required>
				</div>
			</div>
			<div class="form-group row">
			    <label for="alamat" class="col-sm-2 col-form-label">ALAMAT</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="alamat" placeholder="ALAMAT" required>
			    </div>
			</div>
			<div class="form-group row">
			    <label for="bagian" class="col-sm-2 col-form-label">BAGIAN</label>
			    <div class="col-sm-10">	
					<select class="form-control col-sm-10" name="bagian" id="bagian" required>
			    	<option selected></option>
			    	<option value="1">Owner</option>
			    	<option value="2">Secretary</option>
			    	<option value="3">Treasure</option>
			    	<option value="4">Crew</option>
			    </select>
			    </div>
			</div>
			  <div class="form-group row" style="align-items: right;">
			    <div class="col-sm-10">
			    	<button type="submit" class="btn btn-default" name="batal">BATAL</button>
			      	<button type="submit" class="btn btn-primary" name="buat">BUAT</button>
			    </div>
			  </div>
		</div>
	</form>
	
</body>
</html>

