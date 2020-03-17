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

  <title>Edit Info Anggota</title>

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
          <i class="fas fa-fw fa-book"></i>
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
            <a href="anggota.php">Daftar Anggota</a>
          </li>
          <li class="breadcrumb-item active">Edit Anggota</li>
        </ol>

        <!-- Page Content -->
        <?php
          include 'koneksi.php';
	        //untuk menampilkan data sebelum di update/diedit
        	$id = $_GET['id'];
        	$result = mysqli_query($conn, "SELECT * FROM anggota WHERE id = '$id'");
        	$mahasiswa = mysqli_fetch_array($result);
        ?>
        <form action="proses/do_edit.php" method="post" id="edit-anggota" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $mahasiswa['id'] ?>" />
                  <div class="form-group col">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" name="nama" placeholder="Nama Lengkap" id="nama" class="form-control" value="<?php echo $mahasiswa['nama'] ?>" required autofocus>
                  </div>
                  <div class='container'>
                    <div class='row'>
                      <div class="form-group col-md-2">
                        <label for="nim">NIM</label>
                        <input type="text" name="nim" placeholder="Nomor Induk Mahasiswa" id="nim" class="form-control" min="7" value="<?php echo $mahasiswa['nim'] ?>" required autofocus>
                      </div>
                      <div class="form-group col-md-2">
                        <label for="kelas">Kelas</label>
                        <?php $kelas = $mahasiswa['kelas']; ?>
                        <select class="form-control" id="kelas" name="kelas">
                          <optgroup label="Teknik Informatika">
                            <option <?php echo ($kelas == 'D4RPL1A') ? "selected": "" ?>>D4RPL1A</option>
                            <option <?php echo ($kelas == 'D3TI1A') ? "selected": "" ?>>D3TI1A</option>
                            <option <?php echo ($kelas == 'D3TI1B') ? "selected": "" ?>>D3TI1B</option>
                            <option <?php echo ($kelas == 'D3TI1C') ? "selected": "" ?>>D3TI1C</option>
                            <option <?php echo ($kelas == 'D4RPL2A') ? "selected": "" ?>>D4RPL2A</option>
                            <option <?php echo ($kelas == 'D3TI2A') ? "selected": "" ?>>D3TI2A</option>
                            <option <?php echo ($kelas == 'D3TI2B') ? "selected": "" ?>>D3TI2B</option>
                            <option <?php echo ($kelas == 'D3TI2C') ? "selected": "" ?>>D3TI2C</option>
                            <option <?php echo ($kelas == 'D4RPL3A') ? "selected": "" ?>>D4RPL3A</option>
                            <option <?php echo ($kelas == 'D3TI3A') ? "selected": "" ?>>D3TI3A</option>
                            <option <?php echo ($kelas == 'D3TI3B') ? "selected": "" ?>>D3TI3B</option>
                            <option <?php echo ($kelas == 'D3TI3C') ? "selected": "" ?>>D3TI3C</option>
                            <option <?php echo ($kelas == 'D4RPL4A') ? "selected": "" ?>>D4RPL4A</option>
                          </optgroup>
                          <optgroup label="Teknik Mesin">
                            <option <?php echo ($kelas == 'D4PM1A') ? "selected": "" ?>>D4PM1A</option>
                            <option <?php echo ($kelas == 'D3TM1A') ? "selected": "" ?>>D3TM1A</option>
                            <option <?php echo ($kelas == 'D3TM1B') ? "selected": "" ?>>D3TM1B</option>
                            <option <?php echo ($kelas == 'D3TM1C') ? "selected": "" ?>>D3TM1C</option>
                            <option <?php echo ($kelas == 'D4PM2A') ? "selected": "" ?>>D4PM1A</option>
                            <option <?php echo ($kelas == 'D3TM2A') ? "selected": "" ?>>D3TM2A</option>
                            <option <?php echo ($kelas == 'D3TM2B') ? "selected": "" ?>>D3TM2B</option>
                            <option <?php echo ($kelas == 'D3TM2C') ? "selected": "" ?>>D3TM2C</option>
                            <option <?php echo ($kelas == 'D4PM3A') ? "selected": "" ?>>D4PM3A</option>
                            <option <?php echo ($kelas == 'D3TM3A') ? "selected": "" ?>>D3TM3A</option>
                            <option <?php echo ($kelas == 'D3TM3B') ? "selected": "" ?>>D3TM3B</option>
                            <option <?php echo ($kelas == 'D3TM3C') ? "selected": "" ?>>D3TM3C</option>
                            <option <?php echo ($kelas == 'D4PM4A') ? "selected": "" ?>>D4PM4A</option>
                          </optgroup>
                          <optgroup label="Teknik Pendingin dan Tata Udara">
                            <option <?php echo ($kelas == 'D3TPTU1A') ? "selected": "" ?>>D3TPTU1A</option>
                            <option <?php echo ($kelas == 'D3TPTU1A') ? "selected": "" ?>>D3TPTU1A</option>
                            <option <?php echo ($kelas == 'D3TPTU1B') ? "selected": "" ?>>D3TPTU1B</option>
                            <option <?php echo ($kelas == 'D3TPTU1C') ? "selected": "" ?>>D3TPTU1C</option>
                            <option <?php echo ($kelas == 'D3TPTU2A') ? "selected": "" ?>>D3TPTU1A</option>
                            <option <?php echo ($kelas == 'D3TPTU2A') ? "selected": "" ?>>D3TPTU2A</option>
                            <option <?php echo ($kelas == 'D3TPTU2B') ? "selected": "" ?>>D3TPTU2B</option>
                            <option <?php echo ($kelas == 'D3TPTU2C') ? "selected": "" ?>>D3TPTU2C</option>
                            <option <?php echo ($kelas == 'D3TPTU3A') ? "selected": "" ?>>D3TPTU3A</option>
                            <option <?php echo ($kelas == 'D3TPTU3A') ? "selected": "" ?>>D3TPTU3A</option>
                            <option <?php echo ($kelas == 'D3TPTU3B') ? "selected": "" ?>>D3TPTU3B</option>
                            <option <?php echo ($kelas == 'D3TPTU3C') ? "selected": "" ?>>D3TPTU3C</option>
                            <option <?php echo ($kelas == 'D3TPTU4A') ? "selected": "" ?>>D3TPTU4A</option>
                          </optgroup>
                        </select>
                      </div>
                      <div class="form-group col-md-2">
                        <label for="kontak">Kontak</label>
                        <input type="text" name="kontak" placeholder="Kontak" id="kontak" class="form-control" value="<?php echo $mahasiswa['kontak'] ?>"required autofocus>
                      </div>
                      <div class="form-group col-md-2">
                        <label for="jk">Jenis Kelamin</label>
                        <?php $jk = $mahasiswa['jenis_kelamin']; ?>
                        <select class="form-control" id="jk" name="jk">
                          <option <?php echo ($jk == 'Laki-Laki') ? "selected": "" ?>>Laki-Laki</option>
                          <option <?php echo ($jk == 'Perempuan') ? "selected": "" ?>>Perempuan</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Email" id="email" class="form-control" value="<?php echo $mahasiswa['email'] ?>" required autofocus>
                  </div>
                  <div class="form-group col">
                    <label for="domisili">Tempat Tinggal Saat ini</label>
                    <textarea class="form-control" id="domisili" rows="3" name="domisili" placeholder="Tempat Tinggal Saat Ini" required autofocus><?php echo $mahasiswa['domisili'] ?></textarea>
                  </div>
                  <div class="form-group col">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="alamat" rows="3" name="alamat" placeholder="Alamat (Sesuai KTP)" required autofocus><?php echo $mahasiswa['alamat'] ?></textarea>
                  </div>
                  <div class="container">
                    <div class="row">
                      <div class="form-group col-md-5">
                        <label for="tl">Tempat Lahir</label>
                        <input type="text" name="tl" placeholder="Tempat Lahir" id="tl" class="form-control" value="<?php echo $mahasiswa['tempat_lahir'] ?>" required autofocus>
                      </div>
                      <div class="form-group col-md-2">
                        <label for="tgl">Tanggal Lahir</label>
                        <input type="date" name="tgl" placeholder="Tanggal Lahir" id="tgl" class="form-control" value="<?php echo $mahasiswa['tanggal_lahir'] ?>" required autofocus>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col">
                    <label for="foto">Upload Foto</label><br>
                    <input type="file" name="foto" placeholder="foto" id="nama_file" class="block " value="<?php echo $mahasiswa['foto'] ?>">
                  </div>
                  </div>
                  <div class="modal-footer">
                    <a href="anggota.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary" name="edit">simpan</button>
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
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batalkan</button>
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