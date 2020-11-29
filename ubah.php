<?php 

session_start();

if ( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

//ambil data di url
$id = abs($_GET["id"]);

//query data transportasi berdasarkan id
$trp = query("SELECT * FROM transportasi WHERE id = $id")[0];

// cek apakah tombol submit sudah ditekan atau balum
if ( isset($_POST["submit"]) ){


//cek apakah data berhasil diubah atau tidak
if( ubah ($_POST) > 0 ){
	echo "<script>
	alert('data berhasil diubah!');
	document.location.href = 'index.php';
	</script>
	";
}else {
	echo "<script>
			alert('data gagal diubah!');
			document.location.href = 'index.php';
		</script>
			";
}


}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Ubah Data Transportasi</title>
</head>
<body>
<h1>Ubah data transportasi</h1>

<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?= $trp["id"]; ?>">
	<input type="hidden" name="gambarlama" value="<?= $trp["gambar"]; ?>">
	<ul>
		<li>
			<label for="kd">kendaraan : </label>
			<input type="text" name="kendaraan" id="kd" required value="<?= $trp["kendaraan"]; ?>">
		</li>
		<li>
			<label for="jn">jenis : </label>
			<input type="text" name="jenis" id="jn" required value="<?= $trp["jenis"]; ?>">
		</li>
		<li>
			<label for="mr">merek : </label>
			<input type="text" name="merek" id="mr" required value="<?= $trp["merek"]; ?>">
		</li>
		<li>
			<label for="tp">tipe : </label>
			<input type="text" name="tipe" id="tp" required value="<?= $trp["tipe"]; ?>">
		</li>
		<li>
			<label for="gb">gambar : </label><br>
			<img src="img/<?= $trp['gambar']; ?>" width="40"> <br>
			<input type="file" name="gambar" id="gb" >
		</li>
		<li>
			<button type="submit" name="submit">ubah data!</button>
		</li>
	</ul>


</form>

</body>
</html>