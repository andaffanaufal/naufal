<?php
//memanggil file koneksi.php
include "koneksi.php";
$username=$_POST['username'];
$email=$_POST['email'];
$password=$_POST['password'];
$level="user";//email otomatis diisi user pd saat registrasi
//format acak password harus sama dengan proses_login.php
$pengacak="p3ng4c4k";
$password_acak=md5($pengacak.md5($password).$pengacak);
$kirim=$_POST['kirim'];
//proses kirim data ke database MYSQL
if($kirim){
$query="INSERT INTO tbl_user VALUES
('','$username','$password_acak','$email')";
$hasil=mysqli_query($conn,$query);
echo "Registrasi User Berhasil<br>";
echo "<a href=loginpage.html</a>";
}else{
echo "Registrasi User Gagal!";
}
?>