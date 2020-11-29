<?php 
// koneksi ke database
$conn = mysqli_connect("127.0.0.1","root","","phpdasar");

function query($query){
	global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while( $row = mysqli_fetch_assoc($result)){
  	$rows[] = $row;
  }
  return $rows;
 }


function tambah($data){
	global $conn;

//ambil data dari tiap elemen dari dalam form

	$kd = htmlspecialchars($data["kendaraan"]);
    $jn = htmlspecialchars($data["jenis"]);
    $mr = htmlspecialchars($data["merek"]);
    $tp = htmlspecialchars($data["tipe"]);


    // upload gambar

    $gb = upload();
    if(!$gb ) {
      return false;

    }


    // query insert data
    $query = "INSERT INTO transportasi VALUES ('','$kd','$jn','$mr','$tp','$gb')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}


  function upload(){

    $namafile = $_FILES['gambar']['name'];
    $ukuranfile = $_FILES ['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpnama = $_FILES ['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang di apload
    if ( $error === 4) {
      echo "<script>
      alert('pilih gambar terlebih dahulu!');
      </script>";
      return false;
    }

    // cek apakah yang diupload adalah gambar (cek ekstensi gambar)
    $ekstensigambarvalid = ['jpg','jpeg','png'];
    $ekstensigambar = explode(".", $namafile);
    $ekstensigambar = strtolower(end($ekstensigambar) );
    if ( !in_array($ekstensigambar, $ekstensigambarvalid) ){
      echo "<script>
            alert('yang anda upload bukanlah gambar!');
      </script>";
      return false;
    }

    // cek jika ukurannya terlalu besar
    if ( $ukuranfile > 1000000){
      echo "<script>
      alert('ukuran gambar terlalu besar!');
      </script>";
      return false;
    }

    // lolos pengecekan, gambar siap di upload
    // generate nama baru (agar nama tidak tabrakan)
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;

    move_uploaded_file($tmpnama, 'img/' . $namafilebaru);

    return $namafilebaru;

  }


function ubah($data){

	global $conn;

//ambil data dari tiap elemen dari dalam form

	$id = $data["id"];
	$kd = htmlspecialchars($data["kendaraan"]);
    $jn = htmlspecialchars($data["jenis"]);
    $mr = htmlspecialchars($data["merek"]);
    $tp = htmlspecialchars($data["tipe"]);
    $gblama =htmlspecialchars($data["gambarlama"]);

    // cek apakah user pilih gamabr baru atau tidak
    if($_FILES['gambar']['error'] === 4 ){
      $gb = $gblama;
    }else {
        $gb = upload();
    }



    // query insert data
    $query = "UPDATE transportasi SET 
    kendaraan = '$kd',
    jenis = '$jn',
    merek = '$mr',
    tipe = '$tp', 
    gambar = '$gb'

    WHERE id = $id
    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//delete
function hapus($id) {
  global $conn;
  mysqli_query($conn, "DELETE FROM transportasi 
    WHERE id = $id");

  return mysqli_affected_rows($conn);

}

// searching
function cari ($keyword) {

  // pagination
// konfiguration
$jumlahdataperhalaman = 2;
$jumlahdata = count(query("SELECT * FROM transportasi"));
$jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
 
$pageaktif = 1;

//menghitung jumlah page yang menampilkan data secara otomatis
$awaldata = ($jumlahdataperhalaman * $pageaktif) - $jumlahdataperhalaman;

	$query = "SELECT * FROM transportasi WHERE
	kendaraan LIKE '%$keyword%' OR
	jenis LIKE '%$keyword%' OR
	merek LIKE '%$keyword%' OR
	tipe LIKE '%$keyword%' 

	";

	return query($query);
}


function registrasi($data){
  global $conn;

  $username = strtolower(stripslashes($data["username"]));
  $password = mysqli_real_escape_string($conn,$data["password"]);
  $password2 = mysqli_real_escape_string($conn,$data["password2"]);

  // cek username sudah ada atau belum
  $result = mysqli_query($conn, "SELECT username FROM user 
            WHERE username = '$username'");
  if( mysqli_fetch_assoc($result) ){
    echo "<script>
          alert(' username sudah terdaftar!');
          </script>";
          return false;
  }

  // cek konfirmasi password
    if ( $password !== $password2 ) {
    echo "<script> 
            alert ('konfirmasi password tidak sama!');
            </script>";

      return false;
  }


  // enkripsi password
   $password = password_hash($password, PASSWORD_DEFAULT);

  // tambahkan userbaru ke database
   mysqli_query($conn, "INSERT INTO user VALUES('', '$username','$password')");

   return mysqli_affected_rows ($conn);
}

 ?>
