<?php
include "db_connect.php";

$data = [
    'id'=>'','name_th'=>'','name_en'=>'',
    'description'=>'','characteristics'=>'',
    'care_instructions'=>'',
    'is_visible'=>1
];

$images = [];

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // ดึงข้อมูลแมว
    $sql = "SELECT * FROM cats WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);

    // ดึงรูปหลายรูป
    $img_sql = "SELECT * FROM cat_images WHERE cat_id=$id";
    $img_result = mysqli_query($conn, $img_sql);
    while($row = mysqli_fetch_assoc($img_result)){
        $images[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>เพิ่ม / แก้ไขแมว</title>

<style>
body{
    margin:0;
    font-family:"Segoe UI",Tahoma,sans-serif;
    background:linear-gradient(135deg,#fff1f5,#e0f7fa);
}
.cat-park{
    max-width:900px;
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
    background:#fff;
    border-radius:30px;
    padding:30px;
    border:4px dashed #ffb6c1;
    box-shadow:0 15px 35px rgba(0,0,0,0.15);
}
label{
    font-weight:600;
    color:#555;
}
input, textarea, select{
    width:100%;
    padding:12px;
    border-radius:20px;
    border:2px solid #ffd1dc;
    margin-top:6px;
    margin-bottom:16px;
    font-size:14px;
    outline:none;
}
textarea{
    resize:vertical;
    min-height:90px;
}
button{
    background:linear-gradient(135deg,#ff9a9e,#fad0c4);
    border:none;
    padding:14px 30px;
    border-radius:30px;
    color:#fff;
    font-size:16px;
    cursor:pointer;
    transition:0.2s;
}
button:hover{
    transform:scale(1.05);
}
.preview{
    margin-bottom:15px;
}
.preview img{
    width:160px;
    border-radius:20px;
    margin:8px;
    box-shadow:0 8px 20px rgba(0,0,0,0.15);
}
</style>
</head>

<body>

<div class="cat-park">

    <div class="header">
        <div class="decor">🎡 🐱 🎠</div>
        <h2>เพิ่ม / แก้ไขข้อมูลแมว</h2>
    </div>

    <div class="card">

        <form action="crud_catbreeds.php" method="post" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $data['id']; ?>">

            <label>ชื่อไทย</label>
            <input name="name_th" required value="<?= $data['name_th']; ?>">

            <label>ชื่ออังกฤษ</label>
            <input name="name_en" required value="<?= $data['name_en']; ?>">

            <label>คำอธิบาย</label>
            <textarea name="description" required><?= $data['description']; ?></textarea>

            <label>ลักษณะนิสัย</label>
            <textarea name="characteristics"><?= $data['characteristics']; ?></textarea>

            <label>การเลี้ยงดู</label>
            <textarea name="care_instructions"><?= $data['care_instructions']; ?></textarea>

            <label>รูปภาพ (เลือกได้หลายรูป)</label>
            <input type="file" name="images[]" multiple>

            <?php if(!empty($images)){ ?>
            <div class="preview">
                <?php foreach($images as $img){ ?>
                    <!-- ✅ แก้ path ให้ตรงกับโฟลเดอร์ up1 -->
                    <img src="up1/<?= $img['image_url']; ?>">
                <?php } ?>
            </div>
            <?php } ?>

            <label>สถานะการแสดง</label>
            <select name="is_visible">
                <option value="1" <?= $data['is_visible']==1?'selected':''; ?>>แสดง</option>
                <option value="0" <?= $data['is_visible']==0?'selected':''; ?>>ไม่แสดง</option>
            </select>

            <div style="text-align:center;">
                <button type="submit">🐾 บันทึกข้อมูล</button>
            </div>

        </form>

    </div>

</div>

</body>
</html>
