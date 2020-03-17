<?php
include 'koneksi.php';

if(isset($_POST['edit'])) {
    $id = $_POST['id'];
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
    $foto_name =$_FILES['foto']['name'];
    $foto_size =$_FILES['foto']['size'];
    $foto_temp =$_FILES['foto']['tmp_name'];
    $foto_error =$_FILES['foto']['error'];

    $result=mysqli_query($conn, "UPDATE anggota SET nama='$nama', nim='$nim', kelas='$kelas', kontak='$kontak', email='$email', domisili='$domisili', alamat='$alamat', tempat_lahir='$tl', tanggal_lahir='$tgl', jenis_kelamin='$jk', nama_file ='$foto_name', ukuran='$foto_size', direktori='$foto_temp' WHERE id='$id'") or die (mysqli_error($conn));
    //echo '<script>window.location.href ="../anggota.php";</script>';
    //var_dump($_POST);
    if( $result ) {
        // kalau berhasil alihkan ke halaman list-siswa.php
        header('Location: ../anggota.php');
    } else {
        // kalau gagal tampilkan pesan
        die("Gagal menyimpan perubahan...");
    }
    
}
?>