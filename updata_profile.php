<?php
session_start();
include "db_connect.php";

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

$id = intval($_POST['id']);
$username = $_POST['username'];
$password = $_POST['password'];

if(!empty($password)){
    $sql = "UPDATE admins 
            SET username='$username', password='$password'
            WHERE id=$id";
}else{
    $sql = "UPDATE admins 
            SET username='$username'
            WHERE id=$id";
}

mysqli_query($conn, $sql);

// อัปเดต session
$_SESSION['admin'] = $username;

echo "<script>
alert('อัปเดตข้อมูลสำเร็จ');
window.location='admin_list.php';
</script>";
?>
