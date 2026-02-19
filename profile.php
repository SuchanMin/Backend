<?php
session_start();
include "db_connect.php";

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

$username = $_SESSION['admin'];

// ดึงข้อมูล admin
$sql = "SELECT * FROM admins WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>โปรไฟล์ผู้ดูแล</title>
<style>
body{
    font-family:Segoe UI;
    background:linear-gradient(135deg,#fff1f5,#e0f7fa);
}
.container{
    max-width:500px;
    margin:60px auto;
    background:#fff;
    padding:30px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
}
input{
    width:100%;
    padding:10px;
    margin-bottom:15px;
    border-radius:15px;
    border:1px solid #ccc;
}
button{
    padding:10px 20px;
    border:none;
    border-radius:20px;
    background:#ff6f91;
    color:#fff;
    cursor:pointer;
}
a{
    display:inline-block;
    margin-top:10px;
}
</style>
</head>

<body>

<div class="container">
<h2>แก้ไขโปรไฟล์</h2>

<form action="update_profile.php" method="post">

<input type="hidden" name="id" value="<?= $data['id']; ?>">

<label>Username</label>
<input type="text" name="username" value="<?= $data['username']; ?>" required>

<label>Password ใหม่</label>
<input type="password" name="password" placeholder="กรอกถ้าต้องการเปลี่ยน">

<button type="submit">บันทึกข้อมูล</button>

</form>

<a href="admin_list.php">⬅ กลับหน้า Admin</a>

</div>

</body>
</html>
