<?php
include '../koneksi.php';
if(isset($_POST['submit'])){
    $nim=$_POST['nim'];
    $nama=$_POST['nama'];
    $id=$_POST['id'];
    $judul=$_POST['judul']; 
    $penulis=$_POST['penulis'];
    $id2=$_POST['id2'];
    $judul2=$_POST['judul2'];
    $penulis2=$_POST['penulis2'];
    $tglp=$_POST['tglp']; //tgl Pinjam
    $ba=$_POST['ba']; //batas akhir
    $status=$_POST['status'];

   //Query Insert data
  $query="INSERT transaksi (id,nim,nama,id_buku,judul_buku,penulis,id_buku2,judul_buku2,penulis2,tanggal_pinjam,batas_akhir,keterangan)VALUES 
  (null,'$nim','$nama','$id','$judul','$penulis','$id2','$judul2','$penulis2','$tglp','$ba','$status')";
    // var_dump($query);
  $result = mysqli_query($conn,$query);
  if(mysqli_affected_rows($conn) > 0)
  {
    echo '<script>
       alert("Berhasil ditambahkan")
       window.location.href ="../pinjam.php";
    </script>';
    }else{
    echo 'Gagal';
  }

}//milik submit
?>