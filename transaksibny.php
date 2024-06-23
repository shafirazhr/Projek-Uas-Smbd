<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>tiket - pendapatan</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">WBL</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                TRANSAKSI
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>WISATA</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">DATA WISATA</h6>
                        <a class="collapse-item" href="tiket.php">HARGA TIKET</a>
                        <a class="collapse-item" href="transaksi.php">TRANSAKSI</a>
                    </div>
                </div>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                PERSON
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>PERSON</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">DATA PERSON</h6>
                        <a class="collapse-item" href="admin.php">ADMIN</a>
                        <a class="collapse-item" href="pelanggan.php">PELANGGAN</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">admin</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>


                <!-- End of Topbar -->

                <div class="container mt-5">
                    <div class="card">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <a href="tiket.php" class="btn btn-info ml-auto">
                                <i class="fas fa-chart-bar mr-2"></i> Daftar Tiket
                            </a>
                        </div>
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pendapatan-harian-tab" data-toggle="tab" href="#pendapatan-harian" role="tab" aria-controls="pendapatan-harian" aria-selected="true">Pendapatan Harian</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pendapatan-tiket-tab" data-toggle="tab" href="#pendapatan-tiket" role="tab" aria-controls="pendapatan-tiket" aria-selected="false">Pendapatan Tiket</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pendapatan-tiket-tab" data-toggle="tab" href="#cektiket" role="tab" aria-controls="pendapatan-tiket" aria-selected="false">hitung harga tiket</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="pendapatan-harian" role="tabpanel" aria-labelledby="pendapatan-harian-tab">
                                    <table class="table table-bordered table-hover mt-3">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Pendapatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include 'config.php';

                                            $sql = "SELECT * FROM totalpendapatan";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>
                                        <td>" . $row["tanggal_pemesanan"] . "</td>
                                        <td>" . $row["PENDAPATAN_HARIAN"] . "</td>
                                    </tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='2'>No records found</td></tr>";
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="pendapatan-tiket" role="tabpanel" aria-labelledby="pendapatan-tiket-tab">
                                    <table class="table table-bordered table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>TIKET</th>
                                                <th>Total Bayar</th>
                                                <th>Jumlah Tiket Terjual</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include 'config.php';

                                            $sql = "SELECT * FROM PendapatanMacamTiket";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>
                                <td>" . $row["NAMA_TIKET"] . "</td>
                                <td>" . $row["total_bayar"] . "</td>
                                <td>" . $row["jumlah_tiket_terjual"] . "</td>
                              </tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='4'>No records found</td></tr>";
                                            }

                                            $conn->close();
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="cektiket" role="tabpanel" aria-labelledby="pendapatan-tiket-tab">
                                    <div class="card">
                                        <div class="card-header bg-primary text-white">
                                            <h2 class="mb-0">Hitung Harga Tiket</h2>
                                        </div>
                                        <div class="card-body">
                                            <?php
                                            include 'config.php';

                                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                $harga_asli = $_POST['harga_asli'];
                                                $tgl_pemesanan = $_POST['tgl_pemesanan'];
                                                $jumlahtiket = $_POST['jumlahtiket'];

                                                $sql = "CALL TotalHargaTiket(?, ?, ?)";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->bind_param("dsi", $harga_asli, $tgl_pemesanan, $jumlahtiket);

                                                if ($stmt->execute()) {
                                                    $result = $stmt->get_result();
                                                    $row = $result->fetch_assoc();
                                                    $harga_final = $row['Harga_Akhir'];
                                                    echo "<div class='alert alert-success'>Harga Akhir: " . number_format($harga_final, 2) . "</div>";
                                                } else {
                                                    echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
                                                }

                                                $stmt->close();
                                                $conn->close();
                                            }
                                            ?>
                                            <form action="" method="POST">
                                                <div class="form-group">
                                                    <label for="harga_asli">Harga Asli</label>
                                                    <input type="number" step="0.01" class="form-control" id="harga_asli" name="harga_asli" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tgl_pemesanan">Tanggal Pemesanan</label>
                                                    <input type="date" class="form-control" id="tgl_pemesanan" name="tgl_pemesanan" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jumlahtiket">Jumlah Tiket</label>
                                                    <input type="number" class="form-control" id="jumlahtiket" name="jumlahtiket" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">cek harga</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="index.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>