<?php
session_start();
include "db_connect.php";

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM admins 
        WHERE username='$username' 
        AND password='$password'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 1){

    $_SESSION['admin'] = $username;

    // ✅ เข้า admin เลย
    header("Location: admin_list.php");
    exit();

}else{
    echo "<script>
            alert('Username หรือ Password ไม่ถูกต้อง');
            window.location='login.php';
          </script>";
}
?>
