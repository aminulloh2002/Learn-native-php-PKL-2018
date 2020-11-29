<?php 
require 'functions.php';

if (isset($_POST ["daftar"])) {
	if( registrasi($_POST) > 0 ){
		echo "<script>
				alert('user baru berhasil ditambahkan!');
				</script>";
				
	} else {
		echo mysqli_error($conn);
	} 

}



 ?>

<!DOCTYPE html>
<html>
<head>

	<title>Halaman Registrasi</title>

<style>
	label {
		display: block;	
  }	
</style>
</head>
<body>


<h1>halaman registrasi</h1>

<form action="" method="post">
	<ul>

		<li>
			<label for="username" >username :</label>
			<input type="text" name="username" id="username" required>
		</li>
		<li>
			<label for="password">password :</label>
			<input type="password" name="password" id="password" required>
		</li>
		<li>
			<label for="password2">konfirmasi password :</label>
			<input type="password" name="password2" id="password2" required>
		</li><br>
		<li> 
			<button type="submit" name="daftar">Daftar!</button>
		</li>
	</ul>


</form>

<ul> <br><br>
 <li>sudah punya akun?
<a href="login.php">Login!</a> </li>
</ul>


</body>
</html>