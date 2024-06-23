<?php
//mengakses config.php
include 'config.php';
//
$user = $_POST['username'];
$pass = $_POST['pass'];

$login = mysqli_query($conn, "SELECT * FROM admin_wbl WHERE username ='$user' and passw0rd = '$pass'");
$cek = mysqli_num_rows($login);

if ($cek > 0) {
    session_start();
    $_SESSION['username'] = $username;
    echo "berhasil login successful";
    header("location: dashboard.php");
} else {
    echo "
        <script>
            alert('Login gagal');
            document.location.href = 'index.php';
        </script>
        ";
    // header("location: index.php");
}
