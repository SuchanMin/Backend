<?php
header("Content-Type: application/json; charset=UTF-8");
include "db_connect.php";

$sql = "SELECT * FROM cats WHERE is_visible=1";
$result = $conn->query($sql);

$cats = [];

while($row = $result->fetch_assoc()) {

    $cat_id = $row['id'];

    // 🔥 ดึงรูปจากตาราง cat_images
    $img_sql = "SELECT image_url FROM cat_images WHERE cat_id = $cat_id";
    $img_result = $conn->query($img_sql);

    $images = [];

    while($img = $img_result->fetch_assoc()) {
        // เพิ่ม path ให้ถูกต้อง
        $images[] = "up1/" . $img['image_url'];
    }

    // ใส่ images เข้าไปใน array
    $row['images'] = $images;

    $cats[] = $row;
}

echo json_encode($cats, JSON_UNESCAPED_UNICODE);
?>
