<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>transaksi - update</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="container mt-5">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Update Pesanan</h2>
                    </div>
                    <div class="card-body">
                        <?php
                        include 'config.php';

                        // Fetch data for dropdowns
                        $pelanggan_result = $conn->query("SELECT NIK, NAMA_PELANGGAN FROM pelanggan");
                        $admin_result = $conn->query("SELECT ID_ADMIN, NAMA_ADMIN FROM admin_wbl");
                        $tiket_result = $conn->query("SELECT ID_TIKET, NAMA_TIKET FROM kriteria_tiket");

                        // Fetch existing data
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $booking_result = $conn->query("SELECT * FROM booking WHERE ID_BOOKING = $id");
                            $booking = $booking_result->fetch_assoc();
                        }

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $kode = $_POST['kode'];
                            $nik = $_POST['nik'];
                            $id_admin = $_POST['id_admin'];
                            $id_tiket = $_POST['id_tiket'];
                            $jumlah_tiket = $_POST['jumlah_tiket'];
                            $tanggal_booking = $_POST['tanggal_booking'];

                            $sql = "CALL updateTransaksi(?, ?, ?, ?, ?, ?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("isiiis", $kode, $nik, $id_admin, $id_tiket, $jumlah_tiket, $tanggal_booking);

                            try {
                                if ($stmt->execute()) {
                                    echo "<div class='alert alert-success'>Data berhasil diupdate!</div>";
                                } else {
                                    throw new Exception($stmt->error);
                                }
                            } catch (Exception $e) {
                                echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
                            }

                            $stmt->close();
                            $conn->close();
                        }
                        ?>
                        <form action="" method="POST">
                            <input type="hidden" name="kode" value="<?php echo $id; ?>">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <select class="form-control" id="nik" name="nik" required>
                                    <?php
                                    while ($row = $pelanggan_result->fetch_assoc()) {
                                        $selected = $row['NIK'] == $booking['NIK'] ? "selected" : "";
                                        echo "<option value='" . $row['NIK'] . "' $selected>" . $row['NIK'] . " - " . $row['NAMA_PELANGGAN'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_admin">Admin</label>
                                <select class="form-control" id="id_admin" name="id_admin" required>
                                    <?php
                                    while ($row = $admin_result->fetch_assoc()) {
                                        $selected = $row['ID_ADMIN'] == $booking['ID_ADMIN'] ? "selected" : "";
                                        echo "<option value='" . $row['ID_ADMIN'] . "' $selected>" . $row['NAMA_ADMIN'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_tiket">Tiket</label>
                                <select class="form-control" id="id_tiket" name="id_tiket" required>
                                    <?php
                                    while ($row = $tiket_result->fetch_assoc()) {
                                        $selected = $row['ID_TIKET'] == $booking['ID_TIKET'] ? "selected" : "";
                                        echo "<option value='" . $row['ID_TIKET'] . "' $selected>" . $row['NAMA_TIKET'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_tiket">Jumlah Tiket</label>
                                <input type="number" class="form-control" id="jumlah_tiket" name="jumlah_tiket" value="<?php echo $booking['JUMLAH_TIKET']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_booking">Tanggal Booking</label>
                                <input type="date" class="form-control" id="tanggal_booking" name="tanggal_booking" value="<?php echo $booking['TANGGAL_BOOKING']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="transaksi.php" class="btn btn-secondary">Kembali</a>
                        </form>
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
        <script src="js/sb-admin-2.min.js"></script>

</body>

</html>