<?php
require 'koneksi.php';
//$conn=mysqli_connect('localhost','root','','db_program_pelatihan')
$id= $_GET['id'];
mysqli_query($conn, "DELETE FROM buku WHERE id=$id");
echo "
<script>
	alert('data berhasil dihapus');
	document.location.href='../buku.php';
</script>
";
?>