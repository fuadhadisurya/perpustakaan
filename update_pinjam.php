<?php
session_start();
if (!isset($_SESSION['username'])){
	header("location:index.php");
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Form Pengembalian</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="dashboard.php">Perpustakaan POLINDRA</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <span class="badge badge-danger">9+</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
          <span class="badge badge-danger">7</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">Activity Log</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

        <!-- Sidebar -->
        <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-users"></i>
          <span>Anggota</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="anggota.php">Daftar Anggota</a>
          <a class="dropdown-item" href="registrasi_anggota.php">Registrasi</a>
         </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-book"></i>
          <span>Informasi Buku</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="buku.php">Daftar Buku</a>
          <a class="dropdown-item" href="entry.php">Entry Buku</a>
         </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-list"></i>
          <span>Transaksi</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="pinjam.php">Pinjam & Kembali</a>
          <a class="dropdown-item" href="form_pinjam.php">Form Pinjam</a>
         </div>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="dashboard.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="pinjam.php">Peminjaman & Pengembalian</a>
          </li>
          <li class="breadcrumb-item active">Form Pengembalian</li>
        </ol>

        <!-- Page Content -->
        <?php
          include 'koneksi.php';
	        //untuk menampilkan data sebelum di update/diedit
        	$id = $_GET['id'];
        	$result = mysqli_query($conn, "SELECT * FROM transaksi WHERE id = '$id'");
        	$transaksi = mysqli_fetch_array($result);
        ?>
        <form action="proses_transaksi/do_update.php" method="post" id="form-pinjam" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $transaksi['id'] ?>" />
          <div class="container">
            <div class="row">
              <div class="form-group col-md-2">
                <label for="nim">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $transaksi['nim'] ?>" readonly>
              </div>
              <div class="form-group col">
                <label for="nama">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $transaksi['nama'] ?>" readonly>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="form-group col-md-2">
                <label for="id">Kode Buku</label>
                <input type="text" class="form-control" id="id" name="id" value="<?php echo $transaksi['id_buku'] ?>" readonly>
              </div>
              <div class="form-group col">
                <label for="judul">Judul Buku</label>
                <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $transaksi['judul_buku'] ?>" readonly>
              </div>
              <div class="form-group col">
                <label for="penulis">Penulis buku</label>
                <input type="text" class="form-control" id="penulis" name="penulis" value="<?php echo $transaksi['penulis'] ?>" readonly>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-2">
                <label for="id2">Kode Buku 2</label>
                <input type="text" class="form-control" id="id2" name="id2" value="<?php echo $transaksi['id_buku2'] ?>" readonly>
              </div>
              <div class="form-group col">
                <label for="judul2">Judul Buku</label>
                <input type="text" class="form-control" id="judul2" name="judul2" value="<?php echo $transaksi['judul_buku2'] ?>" readonly>
              </div>
              <div class="form-group col">
                <label for="penulis2">Penulis buku</label>
                <input type="text" class="form-control" id="penulis2" name="penulis2" value="<?php echo $transaksi['penulis'] ?>" readonly>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="form-group col-md-2">
                <label for="tglp">Tanggal Peminjaman</label> <!--tglp = tanggal Pinjam-->
                <input type="date" class="form-control" id="tglp" name="tglp" value="<?php echo $transaksi['tanggal_pinjam'] ?>" readonly>
              </div>
              <div class="form-group col-md-2">
                <label for="ba">Batas Akhir</label>
                <input type="date" class="form-control" id="ba" name="ba" value="<?php echo $transaksi['batas_akhir'] ?>" readonly>
              </div>
              <div class="form-group col-md-2">
                <label for="tglk">Tanggal Kembali</label>
                <input type="date" class="form-control" id="tglk" name="tglk" value="<?php echo $transaksi['tanggal_kembali'] ?>">
              </div>
              <div class="form-group col">
                <label for="denda">Denda</label>
                <input type="text" class="form-control" id="denda" name="denda" value="<?php echo $transaksi['denda'] ?>">
              </div>
              <div class="form-group col-md-2">
                <label for="status">Status</label>
                <?php $kelas = $transaksi['keterangan']; ?>
                <select class="form-control" id="status" name="status">
                  <option <?php echo ($transaksi == 'Pinjam') ? "selected": "" ?>>Pinjam</option>
                  <option <?php echo ($transaksi == 'Kembali') ? "selected": "" ?>>Kembali</option>
                </select>
              </div>
            </div>
            <div class="form-group col">
              <label for="catatan">Catatan</label>
              <textarea type="textarea" class="form-control" id="catatan" name="catatan"><?php echo $transaksi['catatan'] ?></textarea>
            </div>
          </div>
          <div class="container d-flex justify-content-end">
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
          </div>
          
        </form>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © D3TI-C XI</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Konfirmasi </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Apakah anda yakin untuk Log Out?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

</body>

</html>
