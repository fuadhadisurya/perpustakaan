<?php
include 'koneksi.php';

if(isset($_POST['edit'])) {
    $id = $_POST['id'];
    $judul=$_POST['judul'];
    $penulis=$_POST['penulis'];
    $kategori=$_POST['kategori'];
    $penerbit=$_POST['penerbit'];
    $thn=$_POST['thn'];
    $foto_name =$_FILES['foto']['name'];
    $foto_size =$_FILES['foto']['size'];
    $foto_temp =$_FILES['foto']['tmp_name'];
    $foto_error =$_FILES['foto']['error'];

    $result=mysqli_query($conn, "UPDATE buku SET judul='$judul', penulis='$penulis', kategori='$kategori', penerbit='$penerbit', tahun_terbit='$thn', nama_file ='$foto_name', ukuran='$foto_size', direktori='$foto_temp' WHERE id='$id'") or die (mysqli_error($conn));
    //echo '<script>window.location.href ="../anggota.php";</script>';
    //var_dump($_POST);
    if( $result ) {
        // kalau berhasil alihkan ke halaman list-siswa.php
        header('Location: ../buku.php');
    } else {
        // kalau gagal tampilkan pesan
        die("Gagal menyimpan perubahan...");
    }
    
}
?>