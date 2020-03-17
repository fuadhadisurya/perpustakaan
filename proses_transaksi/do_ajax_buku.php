<?php
include '../koneksi.php';
$id = $_GET['id'];

$result=mysqli_query($conn, "SELECT * FROM buku WHERE id='$id'");
$buku=mysqli_fetch_array($result);
$data = array(
    'judul'  =>  $buku['judul'],
    'penulis'=>  $buku['penulis'],
);
echo json_encode($data);
?>