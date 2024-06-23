<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>pelanggan - insert</title>

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
                        <h2 class="mb-0">Tambah Pelanggan</h2>
                    </div>
                    <div class="card-body">
                        <?php
                        include 'config.php';

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $nik = $_POST['nik'];
                            $nama_pelanggan = $_POST['nama_pelanggan'];
                            $jenis_kelamin = $_POST['jenis_kelamin'];

                            if (strlen($nik) != 16) {
                                echo "<div class='alert alert-danger'>NIK harus terdiri dari 16 karakter.</div>";
                            } else {
                                $sql = "CALL insertToPelanggan(?, ?, ?)";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("sss", $nik, $nama_pelanggan, $jenis_kelamin);

                                try {
                                    if ($stmt->execute()) {
                                        echo "<div class='alert alert-success'>Data berhasil ditambahkan!</div>";
                                    } else {
                                        throw new Exception($stmt->error);
                                    }
                                } catch (Exception $e) {
                                    echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
                                }

                                $stmt->close();
                                $conn->close();
                            }
                        }
                        ?>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik" maxlength="16" required>
                            </div>
                            <div class="form-group">
                                <label for="nama_pelanggan">Nama Pelanggan</label>
                                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="pelanggan.php" class="btn btn-secondary">Kembali</a>
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