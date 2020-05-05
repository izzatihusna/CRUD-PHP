<?php
 	require('config.php'); 
	//jika sudah mendapatkan parameter GET id dari URL
	if(isset($_GET['id'])){
		//membuat variabel $id untuk menyimpan id dari GET id di URL
		$id = $_GET['id'];
		
		//query ke database SELECT tabel mahasiswa berdasarkan id = $id
		$select = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id='$id'") or die(mysqli_error($koneksi));
		
		//jika hasil query = 0 maka muncul pesan error
		if(mysqli_num_rows($select) == 0){
			echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
			exit();
		//jika hasil query > 0
		}else{
			//membuat variabel $data dan menyimpan data row dari query
			$data = mysqli_fetch_assoc($select);
		}
	}
	
	//jika sudah mendapatkan parameter GET id dari URL
	if(isset($_GET['id'])){
		//membuat variabel $id untuk menyimpan id dari GET id di URL
		$id = $_GET['id'];
		
		//query ke database SELECT tabel mahasiswa berdasarkan id = $id
		$select = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id='$id'") or die(mysqli_error($koneksi));
		
		//jika hasil query = 0 maka muncul pesan error
		if(mysqli_num_rows($select) == 0){
			echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
			exit();
		//jika hasil query > 0
		}else{
			//membuat variabel $data dan menyimpan data row dari query
			$data = mysqli_fetch_assoc($select);
		}
	}
	//jika tombol simpan di tekan/klik
	if(isset($_POST['submit'])){
		$Nama			= $_POST['Nama'];
		$JenisKelamin	= $_POST['JenisKelamin'];
		$id_doswal		= $_POST['id_doswal'];
		
		$sql = mysqli_query($koneksi, "UPDATE mahasiswa SET Nama='$Nama', JenisKelamin='$JenisKelamin', id_doswal='$id_doswal' WHERE id='$id'") or die(mysqli_error($koneksi));
		
		if($sql){
			echo '<script>alert("Berhasil menyimpan data."); document.location.href="index.php";</script>';
		}else{
			echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
		}
	}
?>
		
<!DOCTYPE html>
<html>
<head>
	<title>CRUD MAHASISWA</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-primary bg-dark">
		<div class="container">
			<a class="navbar-brand" href="#">CRUD MAHASISWA</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="tambah.php">Tambah</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	
	<div class="container" style="margin-top:20px">
		<h2>Edit Mahasiswa</h2>
		
		<hr>
		<form action="edit.php?id=<?= $id; ?>" method="post">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NIM</label>
				<div class="col-sm-10">
					<input type="text" name="nim" class="form-control" size="4" value="<?= $data['NIM']; ?>" readonly required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NAMA MAHASISWA</label>
				<div class="col-sm-10">
					<input type="text" name="Nama" class="form-control" value="<?= $data['Nama']; ?>" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">JENIS KELAMIN</label>
				<div class="col-sm-10">
					<div class="form-check">
						<input type="radio" class="form-check-input" name="JenisKelamin" value="L" <?php if($data['JenisKelamin'] == 'L'){ echo 'checked'; } ?> required>
						<label class="form-check-label">LAKI-LAKI</label>
					</div>
					<div class="form-check">
						<input type="radio" class="form-check-input" name="JenisKelamin" value="P" <?php if($data['JenisKelamin'] == 'P'){ echo 'checked'; } ?> required>
						<label class="form-check-label">PEREMPUAN</label>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">DOSEN WALI</label>
				<div class="col-sm-10">
					<select name="id_doswal" class="form-control" required>
                        <option>PILIH DOSEN WALI</option>
		
                        <option value=1402 <?php if($data['id_doswal'] == '1402'){ echo 'selected'; } ?>>Arie Budiansyah ST., M.Eng.</option>
        				<option value=1302 <?php if($data['id_doswal'] == '1302'){ echo 'selected'; } ?>>Dalila Husna Yunardi B.Sc., M.Sc.</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">&nbsp;</label>
				<div class="col-sm-10">
					<input type="submit" name="submit" class="btn btn-primary" value="SIMPAN">
					<a href="index.php" class="btn btn-warning">KEMBALI</a>
				</div>
			</div>
		</form>
		
	</div>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	
</body>
</html>