<?php
include '../koneksi.php';

if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nim=$_POST['nim'];
    $nama=$_POST['nama'];
    $id=$_POST['id'];
    $judul=$_POST['judul'];
    $penulis=$_POST['penulis'];
    $id2=$_POST['id2'];
    $judul2=$_POST['judul2'];
    $penulis2=$_POST['penulis2'];
    $tglp=$_POST['tglp']; //tanggal pinjam
    $ba=$_POST['ba']; //Batas Akhir
    $tglk=$_POST['tglk']; //tanggal kembali
    $denda=$_POST['denda'];
    $status=$_POST['status'];
    $catatan=$_POST['catatan'];

    $result=mysqli_query($conn, "UPDATE transaksi SET tanggal_kembali='$tglk',denda='$denda',keterangan='$status',catatan='$catatan' WHERE id='$id'") or die (mysqli_error($conn));
    //echo '<script>window.location.href ="../anggota.php";</script>';
    //var_dump($result);
    if( $result ) {
        // kalau berhasil alihkan ke halaman list-siswa.php
        header('Location: ../pinjam.php');
    } else {
        // kalau gagal tampilkan pesan
        die("Gagal menyimpan perubahan...");
    }
    
}
?>