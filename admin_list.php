<?php
session_start();
include "db_connect.php";

/* ✅ กันเข้าหน้า admin ถ้ายังไม่ login */
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM cats ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>จัดการแมวยอดนิยม</title>

<style>
body{
    margin:0;
    font-family:"Segoe UI",Tahoma,sans-serif;
    background:linear-gradient(135deg,#fff1f5,#e0f7fa);
}
.cat-park{
    max-width:1200px;
    margin:40px auto;
    padding:20px;
}
.header{
    text-align:center;
    margin-bottom:30px;
}
.header h2{
    font-size:34px;
    color:#ff6f91;
    text-shadow:2px 2px #ffd1dc;
    margin:0;
}
.decor{
    font-size:42px;
    margin-bottom:10px;
}
.card{
    background:#ffffff;
    border-radius:30px;
    padding:30px;
    border:4px dashed #ffb6c1;
    box-shadow:0 15px 35px rgba(0,0,0,0.15);
}
.btn{
    display:inline-block;
    background:linear-gradient(135deg,#ff9a9e,#fad0c4);
    color:#fff;
    padding:12px 24px;
    border-radius:30px;
    text-decoration:none;
    margin-right:10px;
    margin-bottom:25px;
    transition:0.2s;
}
.btn.secondary{
    background:linear-gradient(135deg,#a1c4fd,#c2e9fb);
}
.btn.logout{
    background:linear-gradient(135deg,#ff6f91,#ff9a9e);
}
.btn:hover{
    transform:scale(1.05);
}
.block-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(260px,1fr));
    gap:25px;
}
.cat-block{
    background:#fff7fa;
    border-radius:25px;
    padding:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.12);
    text-align:center;
}
.cat-block img{
    width:140px;
    border-radius:20px;
    margin:5px;
    box-shadow:0 8px 20px rgba(0,0,0,0.15);
}
.cat-name{
    font-size:20px;
    color:#ff6f91;
    font-weight:600;
    margin-bottom:6px;
}
.status{
    font-size:14px;
    margin-bottom:12px;
    color:#555;
}
.actions a{
    display:inline-block;
    margin:4px 3px;
    padding:6px 14px;
    border-radius:20px;
    text-decoration:none;
    font-size:14px;
    color:#fff;
}
.actions .edit{ background:#ff9a9e; }
.actions .delete{ background:#ff6f91; }
.actions .toggle{ background:#a1c4fd; }
</style>
</head>

<body>

<div class="cat-park">

    <div class="header">
        <div class="decor">🎡 🐱 🎠</div>
        <h2>จัดการข้อมูลแมวยอดนิยม</h2>
    </div>

    <div class="card">

        <!-- ปุ่มด้านบน -->
        <a href="add_cat.php" class="btn">➕ เพิ่มแมว</a>

        <a href="show_cat.php" class="btn secondary" target="_blank">
            👀 ดูสำหรับผู้อ่าน
        </a>

        <a href="profile.php" class="btn secondary">
            👤 โปรไฟล์
        </a>

        <a href="logout.php" class="btn logout">
            🚪 ออกจากระบบ
        </a>

        <div class="block-grid">

            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <div class="cat-block">

                <?php
                $cat_id = $row['id'];
                $img_sql = "SELECT image_url FROM cat_images WHERE cat_id=$cat_id";
                $img_result = mysqli_query($conn, $img_sql);

                while($img = mysqli_fetch_assoc($img_result)){
                    echo "<img src='up1/".$img['image_url']."'>";
                }
                ?>

                <div class="cat-name"><?= $row['name_th']; ?></div>

                <div class="status">
                    สถานะ:
                    <?= $row['is_visible'] ? "แสดง" : "ไม่แสดง"; ?>
                </div>

                <div class="actions">

                    <a href="add_cat.php?id=<?= $row['id']; ?>" class="edit">
                        ✏ แก้ไข
                    </a>

                    <a href="crud_catbreeds.php?delete=<?= $row['id']; ?>"
                       onclick="return confirm('ลบข้อมูลนี้?')" 
                       class="delete">
                       🗑 ลบ
                    </a>

                    <a href="crud_catbreeds.php?toggle=<?= $row['id']; ?>" 
                       class="toggle">
                        <?= $row['is_visible'] ? "ซ่อน" : "แสดง"; ?>
                    </a>

                </div>

            </div>
            <?php } ?>

        </div>

    </div>

</div>

</body>
</html>
