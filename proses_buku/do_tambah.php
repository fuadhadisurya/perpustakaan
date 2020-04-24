<?php
include 'koneksi.php';
if(isset($_POST['register'])){
    $judul=$_POST['judul'];
    $penulis=$_POST['penulis'];
    $kategori=$_POST['kategori'];
    $penerbit=$_POST['penerbit'];
    $thn=$_POST['thn']; //tahun terbit
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
      window.location.href ="../entry.php";
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
      window.location.href ="../entry.php";
    </script>';
    die();
  }

  //check jika ukuran file terlalu besar
    if($foto_size > 1000000){
       echo '<script>
      alert("GAGAL! Ukuran terlalu besar");
      window.location.href ="../entry.php";
    </script>';  
    die();
    }

//Cek gambar
$result=mysqli_query($conn,"SELECT nama_file FROM buku WHERE nama_file='$foto_name'");
  if(mysqli_fetch_assoc($result)){
    echo '<script>
      alert("Nama File Sudah ada");
      window.location.href ="../entry.php";
    </script>';
    die();
  }

move_uploaded_file($foto_temp,'image/'.$foto_name);

//check apakah ada judul yang sama???
  $result=mysqli_query($conn,"SELECT judul FROM buku WHERE judul='$judul'");
  if(mysqli_fetch_assoc($result)){
    echo '<script>
      alert("Buku Sudah Terdaftar");
      window.location.href ="../entry.php";
    </script>';
    die();
  }

  //Query Insert data
  $query="INSERT buku (id,judul,penulis,kategori,penerbit,tahun_terbit,nama_file,ukuran,direktori)VALUES 
  (null,'$judul','$penulis','$kategori','$penerbit','$thn','$foto_name','$foto_size','$foto_temp')";
  mysqli_query($conn,$query);
  if(mysqli_affected_rows($conn) > 0)
  {
    echo '<script>
       alert("Berhasil ditambahkan")
       window.location.href ="../buku.php";
    </script>';
    }else{
    echo 'Gagal';
  }

}//milik submit
?>