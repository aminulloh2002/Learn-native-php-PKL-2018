<?php 
// koneksi ke database
$conn = mysqli_connect("127.0.0.1","root","","phpdasar");

// ambil data dari tabel transportasi / query data transportasi
$result = mysqli_query($conn, "SELECT * FROM transportasi");
if( !$result ){
	echo mysqli_error($conn);
}

// ambil data (fetch) transportasi dari object result
// while ($trp = mysqli_fetch_assoc($result)) {
// var_dump($trp);
// }
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Admin</title>
</head>
<body>
<h1>Daftar Transportasi</h1>

<table border="1" cellpadding="10" cellspacing="0">
	
	<tr>
		<th>No.</th>
		<th>aksi</th>
		<th>Gambar</th>
		<th>Kendaraan</th>
		<th>Jenis</th>
		<th>Merek</th>
		<th>Type</th>
	</tr>

<?php $i = 1; ?>
<?php while( $row = mysqli_fetch_assoc($result)): ?>
	<tr>
		<td><?= $i; ?></td>
		<td>
			<a href="">ubah</a> | 
			<a href="">hapus</a>
		</td>
		<td><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
		<td><?= $row["kendaraan"]; ?></td>
		<td><?= $row["jenis"]; ?></td>
		<td><?= $row["merek"]; ?></td>
		<td><?= $row["tipe"]; ?></td>
	</tr>
	<?php $i++; ?>
<?php endwhile; ?>

</table>

</body>
</html>