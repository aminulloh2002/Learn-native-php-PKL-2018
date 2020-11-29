<?php 

session_start();

if ( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

// cek apakah tombol submit sudah ditekan atau balum
if ( isset($_POST["submit"]) ){


//cek apakah data berhasil ditambahkan atau tidak
if( tambah ($_POST) > 0 ){
	echo "<script>
	alert('data berhasil ditambahkan!');
	document.location.href = 'index.php';
	</script>
	";
}else {
	echo "<script>
			alert('data gagal ditambahkan!');
			document.location.href = 'index.php';
		</script>
			";
}


}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data Transportasi</title>
</head>
<body>
<h1>Tambah data transportasi</h1>

<form action="" method="post" enctype="multipart/form-data">
	<ul>
		<li>
			<label for="kd">kendaraan : </label>
			<input type="text" name="kendaraan" id="kd" required>
		</li>
		<li>
			<label for="jn">jenis : </label>
			<input type="text" name="jenis" id="jn" required>
		</li>
		<li>
			<label for="mr">merek : </label>
			<input type="text" name="merek" id="mr" required>
		</li>
		<li>
			<label for="tp">tipe : </label>
			<input type="text" name="tipe" id="tp" required>
		</li>
		<li>
			<label for="gb">gambar : </label>
			<input type="file" name="gambar" id="gb" >
		</li>
		<li>
			<button type="submit" name="submit">tambah data!</button>
		</li>
	</ul>


</form>

</body>
</html>