<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>กำลังออกจากระบบ</title>

<!-- 🔥 เด้งกลับหน้าแรกหลัง 2 วินาที -->
<meta http-equiv="refresh" content="2;url=show_cat.php">

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

.logout-box{
    background:#ffffff;
    padding:50px;
    border-radius:30px;
    text-align:center;
    box-shadow:0 20px 40px rgba(0,0,0,0.2);
    animation:fadeIn 0.5s ease-in-out;
}

.logout-box h2{
    color:#ff6f91;
    margin-bottom:15px;
}

.logout-box p{
    color:#666;
}

@keyframes fadeIn{
    from{ opacity:0; transform:translateY(20px);}
    to{ opacity:1; transform:translateY(0);}
}
</style>
</head>

<body>

<div class="logout-box">
    <h2>🚪 ออกจากระบบสำเร็จ</h2>
    <p>กำลังกลับไปหน้าแรก...</p>
</div>

</body>
</html>
