<?php 
session_start();

if ( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}
//menghubungkan ke file function
require 'functions.php';

// pagination
// configuration
$jumlahdataperhalaman = 4;
$jumlahdata = count(query("SELECT * FROM transportasi"));
$jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
// if ( isset($_GET["page"])){
// 	$pageaktif = $_GET["page"];
// } else {
// $pageaktif = 1;
// }

// pengganti if else (fungsinya sama ) ? = true, : = false
$pageaktif = ( isset($_GET["page"])) ? $_GET["page"] : 1;

//menghitung jumlah page yang menampilkan data secara otomatis
$awaldata = ($jumlahdataperhalaman * $pageaktif) - $jumlahdataperhalaman;

//mengquery atau mengambil data dari database
$transportasi = query("SELECT * FROM transportasi LIMIT $awaldata,$jumlahdataperhalaman");



// jika tombol cari di klik
if (isset ($_POST["cari"])) {

	$transportasi = cari($_POST["keyword"]);
	$pageaktif = 1;
}	
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Halaman Admin</title>
	<style>
	    a{
	    	color: blue;
	    }
		#page{
			font-size:18px;
		}
	</style>
</head>
<body>
<h1>Daftar Transportasi</h1>

<a href="tambah.php">Tambah data trasportasi</a>
<br><br>

<form action="" method="post">
	
	<input type="text" name="keyword" size="30" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off" >
	<button type="submit" name="cari"> Cari! </button>

</form>

<br>
<div id="page">
<!-- navigasi -->
<?php if( $pageaktif > 1 ) : ?>
<a href="?page=<?= $pageaktif -1; ?>">&laquo;</a>
<?php endif; ?>

<?php for($i = 1; $i <= $jumlahhalaman; $i++ ) : ?>
	<?php if($i == $pageaktif ) : ?>
	<a href="?page=<?= $i; ?>" style="font-weight: bold; color: purple;"><?= $i; ?></a>
	<?php else : ?>
	<a href="?page=<?= $i; ?>";"><?= $i; ?></a>
	<?php endif; ?>
<?php endfor; ?>
<?php if($pageaktif < $jumlahhalaman ) : ?>
<a href="?page=<?= $pageaktif +1; ?>">&raquo;</a>
<?php endif; ?>
</div>

<br>
<table border="1" cellpadding="10" cellspacing="0">
	
	<tr>
		<th>No.</th>
		<th>Aksi</th>
		<th>Gambar</th>
		<th>Kendaraan</th>
		<th>Jenis</th>
		<th>Merek</th>
		<th>Tipe</th>
	</tr>

<?php $i = ($pageaktif*$jumlahdataperhalaman)-3;?>
<?php foreach( $transportasi as $trp) : ?>
	<tr>
		<td><?= $i; ?></td>
		<td>
			<a href="ubah.php?id=<?= $trp["id"]; ?>">ubah</a> | 
			<a href="hapus.php?id=<?= $trp["id"]; ?>" onclick="return confirm('apakah anda yakin akan menghapus data tersebut?');">hapus</a>
		</td>
		<td><img src="img/<?= $trp["gambar"]; ?>" height="50"></td>
		<td><?= $trp["kendaraan"]; ?></td>
		<td><?= $trp["jenis"]; ?></td>
		<td><?= $trp["merek"]; ?></td>
		<td><?= $trp["tipe"]; ?></td>
	</tr>
	<?php $i++; ?>
<?php endforeach; ?>

</table>
<br>
<a href="logout.php"> Logout </a>

</body>
</html>