<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>pelanggan - hapus</title>

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
                    <div class="card-header bg-danger text-white">
                        <h2 class="mb-0">Hapus Pelanggan</h2>
                    </div>
                    <div class="card-body">
                        <?php
                        include 'config.php';

                        // Mengambil NIK dari URL
                        if (isset($_GET['id'])) {
                            $kode = $_GET['id'];

                            $sql = "CALL hapusPelanggan(?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $kode);
                            if ($stmt->execute()) {
                                echo "<script>
                                alert('Data berhasil dihapus!');
                                window.location.href = 'pelanggan.php';
                              </script>";
                                exit; // Menghentikan eksekusi script PHP setelah redirect
                            } else {
                                throw new Exception($stmt->error);
                            }



                            $stmt->close();
                            $conn->close();
                        } else {
                            echo "<div class='alert alert-warning'>NIK tidak valid atau tidak ada.</div>";
                        }
                        ?>
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