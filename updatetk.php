<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>tiket - update</title>

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
                        <h2 class="mb-0">Update Tiket</h2>
                    </div>
                    <div class="card-body">
                        <?php
                        include 'config.php';

                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $result = $conn->query("SELECT * FROM kriteria_tiket WHERE ID_TIKET = $id");
                            $row = $result->fetch_assoc();
                        }

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $id = $_POST['id'];
                            $nama_tiket = $_POST['nama_tiket'];
                            $keterangan = $_POST['keterangan'];
                            $harga = $_POST['harga'];

                            $sql = "CALL UpdateTiket(?, ?, ?, ?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("issd", $id, $nama_tiket, $keterangan, $harga);

                            try {
                                if ($stmt->execute()) {
                                    echo "<div class='alert alert-success'>Data berhasil diperbarui!</div>";
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
                            <input type="hidden" name="id" value="<?php echo $row['ID_TIKET']; ?>">
                            <div class="form-group">
                                <label for="nama_tiket">Nama Tiket</label>
                                <input type="text" class="form-control" id="nama_tiket" name="nama_tiket" value="<?php echo $row['NAMA_TIKET']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" required><?php echo $row['KETERANGAN']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" step="0.01" class="form-control" id="harga" name="harga" value="<?php echo $row['HARGA']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="tiket.php" class="btn btn-secondary">Kembali</a>
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