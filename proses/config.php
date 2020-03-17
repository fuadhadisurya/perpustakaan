<?php

$conn = mysqli_connect("localhost","root","","db_program_pelatihan"); //untuk akses ke db
$result= mysqli_query($conn,"SELECT * FROM tbl_peserta");//untuk akses ke table
$data=[];
while($peserta=mysqli_fetch_assoc($result))://untuk akses data dalam tabel
$data []=$peserta;
endwhile;
?>