<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>admin - insert</title>

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
                        <h2 class="mb-0">Tambah Admin</h2>
                    </div>
                    <div class="card-body">
                        <?php
                        include 'config.php';

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $nama_admin = $_POST['nama_admin'];
                            $username = $_POST['username'];
                            $password = $_POST['password'];

                            $sql = "CALL insertToAdmin(?, ?, ?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("sss", $nama_admin, $username, $password);

                            if ($stmt->execute()) {
                                echo "<div class='alert alert-success'>Data berhasil ditambahkan!</div>";
                            } else {
                                echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
                            }

                            $stmt->close();
                            $conn->close();
                        }
                        ?>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="nama_admin">Nama Admin</label>
                                <input type="text" class="form-control" id="nama_admin" name="nama_admin" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="admin.php" class="btn btn-secondary">Kembali</a>
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