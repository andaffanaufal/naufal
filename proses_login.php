<?php
//memulai session untuk login user
session_start();
//memanggil file koneksi ke database
include "koneksi.php";
//menangkap data yang dikirim dari form login.php
$email=$_POST['email'];
$password=$_POST['password'];
//format acak password harus sama dengan proses_register.php
$pengacak="p3ng4c4k";
$password_acak=md5($pengacak.md5($password).$pengacak);
$kirim=$_POST['kirim'];
//menyeleksi data user dengan username dan password acak yang sesuai
$query="SELECT*FROM tbl_user WHERE email='$email' and password='$password_acak'";
//menjalankan query ditampung dlm variabel $hasil
$hasil=mysqli_query($conn,$query);
//menangkap data dari hasil perintah query sql
$data=mysqli_fetch_array($hasil);
//menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($hasil);
//cek apakah username dan password di temukan pada database
if($cek > 0){
//cek jika user login sebagai admin
if($data['level']=="admin"){
// buat session login dan username
$_SESSION['email'] = $email;
$_SESSION['level'] = "admin";
//alihkan ke halaman dashboard admin
header("location:Dashbord Admin.php");
//cek jika user login sebagai user
}else if($data['level']=="user"){
//buat session login dan username
$_SESSION['email'] = $email;
$_SESSION['level'] = "user";
//alihkan ke halaman dashboard user
header("location:landingpage.php");
}else{
echo "Anda Bukan Admin dan Bukan User";
//alihkan ke halaman login kembali
//header("location:login.php");
}
}else{
//jika username dan password tdk ditemukan pada database
echo "GAGAL LOGIN!!!, Email dan Password tidak ditemukan";
}
?>