<?php
session_start();
if(isset($_SESSION['admin'])){
    header("Location: show_cat.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>Login - Cat Park</title>

<style>
body{
    margin:0;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:"Segoe UI",Tahoma,sans-serif;
    background:linear-gradient(135deg,#ffdde1,#c2e9fb);
}

.login-card{
    background:#fff;
    padding:40px;
    border-radius:25px;
    width:350px;
    box-shadow:0 15px 35px rgba(0,0,0,0.2);
    text-align:center;
}

.login-card h2{
    margin-bottom:25px;
    color:#ff6f91;
}

input{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border-radius:15px;
    border:1px solid #ddd;
    outline:none;
}

button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:20px;
    background:linear-gradient(135deg,#ff6f91,#ff9a9e);
    color:white;
    font-weight:bold;
    cursor:pointer;
    transition:0.2s;
}

button:hover{
    transform:scale(1.05);
}

.back{
    margin-top:15px;
    display:inline-block;
    color:#888;
    text-decoration:none;
    font-size:14px;
}
</style>
</head>

<body>

<div class="login-card">
    <h2>🔐 เข้าสู่ระบบ</h2>

    <form action="check_login.php" method="POST">
        <input type="text" name="username" placeholder="ชื่อผู้ใช้" required>
        <input type="password" name="password" placeholder="รหัสผ่าน" required>
        <button type="submit">เข้าสู่ระบบ</button>
    </form>

    <a href="show_cat.php" class="back">⬅ กลับหน้าแรก</a>
</div>

</body>
</html>
