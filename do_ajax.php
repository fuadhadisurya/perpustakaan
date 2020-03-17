<?php
include '../koneksi.php';
$nim = $_GET['nim'];
$query = mysqli_query($conn, "SELECT * FROM anggota WHERE nim='$nim'");
$anggota = mysqli_fetch_array($query);
$data = array('nama'=>$anggota['nama']);
echo json_encode($data);
?>