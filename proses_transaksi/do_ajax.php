<?php
include '../koneksi.php';
$nim = $_GET['nim'];

$result=mysqli_query($conn, "SELECT * FROM anggota WHERE nim='$nim'");
$anggota=mysqli_fetch_array($result);
$data = array(
    'nama'  =>  $anggota['nama'],
    'kelas' =>  $anggota['kelas'],
);
echo json_encode($data);
?>