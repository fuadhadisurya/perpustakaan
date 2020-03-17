<?php
include 'koneksi.php';
if(isset($_POST['register'])){
    $nama=$_POST['nama'];
    $nim=$_POST['nim'];
    $kelas=$_POST['kelas'];
    $kontak=$_POST['kontak'];
    $email=$_POST['email'];
    $domisili=$_POST['domisili'];
    $alamat=$_POST['alamat'];
    $tl=$_POST['tl']; //tempat lahir
    $tgl=$_POST['tgl']; //tanggal lahir
    $jk=$_POST['jk']; //jenis Kelamin
    $foto_tipe =strtolower($_FILES['foto']['type']);
    $foto_name =$_FILES['foto']['name'];
    $foto_size =$_FILES['foto']['size'];
    $foto_temp =$_FILES['foto']['tmp_name'];
    $foto_error =$_FILES['foto']['error'];
   // var_dump($_FILES);
  
   // die;

//upload foto
//jika tidak ada foto yang diupload
if($foto_error ===4){
      echo '<script>
      alert("GAGAL! Tidak ada Gambar yang diupload");
      window.location.href ="../anggota.php";
    </script>';
    die();
  }
// check type file yang akan diupload
//JAngan Lupa Check Juga di php.ini mengenai max upload

if(
    $foto_tipe != "image/jpg" AND
    $foto_tipe != "image/jpeg" AND
    $foto_tipe != "image/pjpeg" AND
    $foto_tipe != "image/png" 
  ){
     echo '<script>
      alert("GAGAL! Tipe file yang diperbolehkan jpg, jpeg, pjpeg, png");
      window.location.href ="../anggota.php";
    </script>';
    die();
  }

  //check jika ukuran file terlalu besar
    if($foto_size > 1000000){
       echo '<script>
      alert("GAGAL! Ukuran terlalu besar");
      window.location.href ="../anggota.php";
    </script>';  
    die();
    }

//Cek gambar
$result=mysqli_query($conn,"SELECT nama_file FROM anggota WHERE nama_file='$foto_name'");
  if(mysqli_fetch_assoc($result)){
    echo '<script>
      alert("Nama File Sudah ada");
      window.location.href ="../anggota.php";
    </script>';
    die();
  }

move_uploaded_file($foto_temp,'image/'.$foto_name);

//check apakah ada NIM yang sama???
  $result=mysqli_query($conn,"SELECT nim FROM anggota WHERE nim='$nim'");
  if(mysqli_fetch_assoc($result)){
    echo '<script>
      alert("Nomor Induk Mahasiswa Sudah Terdaftar");
      window.location.href ="../anggota.php";
    </script>';
    die();
  }

  //Query Insert data
  $query="INSERT INTO anggota (id,nama,nim,kelas,kontak,email,domisili,alamat,tempat_lahir,tanggal_lahir,jenis_kelamin,nama_file,ukuran,direktori)VALUES 
  ('','$nama','$nim','$kelas','$kontak','$email','$domisili','$alamat','$tl','$tgl','$jk','$foto_name','$foto_size','$foto_temp')";
  mysqli_query($conn,$query);
  if(mysqli_affected_rows($conn) > 0)
  {
    echo '<script>
       alert("Berhasil ditambahkan")
       window.location.href ="../anggota.php";
    </script>';
    }else{
    echo 'Gagal';
  }

}//milik submit
?>