<?php
include "db_connect.php";

/* =========================
   ลบแมว
========================= */
if (isset($_GET['delete'])) {

    $id = intval($_GET['delete']);

    // ดึงรูปทั้งหมด
    $img = mysqli_query($conn, "SELECT image_url FROM cat_images WHERE cat_id=$id");

    while($row = mysqli_fetch_assoc($img)){
        $file_path = "up1/" . $row['image_url'];

        if(file_exists($file_path)){
            unlink($file_path);
        }
    }

    // ลบรูปใน DB
    mysqli_query($conn, "DELETE FROM cat_images WHERE cat_id=$id");

    // ลบแมว
    mysqli_query($conn, "DELETE FROM cats WHERE id=$id");

    header("Location: admin_list.php");
    exit();
}


/* =========================
   ซ่อน / แสดง
========================= */
if (isset($_GET['toggle'])) {

    $id = intval($_GET['toggle']);

    mysqli_query($conn,
        "UPDATE cats SET is_visible = 1 - is_visible WHERE id=$id"
    );

    header("Location: admin_list.php");
    exit();
}


/* =========================
   เพิ่ม / แก้ไขแมว
========================= */

$name_th = $_POST['name_th'];
$name_en = $_POST['name_en'];
$description = $_POST['description'];
$characteristics = $_POST['characteristics'];
$care = $_POST['care_instructions'];
$is_visible = $_POST['is_visible'];


/* ---------- เพิ่ม ---------- */
if (empty($_POST['id'])) {

    $sql = "INSERT INTO cats
    (name_th,name_en,description,characteristics,care_instructions,is_visible)
    VALUES (
        '$name_th',
        '$name_en',
        '$description',
        '$characteristics',
        '$care',
        '$is_visible'
    )";

    mysqli_query($conn, $sql);

    $cat_id = mysqli_insert_id($conn);

} 
/* ---------- แก้ไข ---------- */
else {

    $cat_id = intval($_POST['id']);

    $sql = "UPDATE cats SET
        name_th='$name_th',
        name_en='$name_en',
        description='$description',
        characteristics='$characteristics',
        care_instructions='$care',
        is_visible='$is_visible'
        WHERE id=$cat_id";

    mysqli_query($conn, $sql);

    // 🔥 ถ้ามีอัปโหลดรูปใหม่ → ลบรูปเก่าก่อน
    if (!empty($_FILES['images']['name'][0])) {

        $old_img = mysqli_query($conn,
            "SELECT image_url FROM cat_images WHERE cat_id=$cat_id"
        );

        while($row = mysqli_fetch_assoc($old_img)){

            $file_path = "up1/" . $row['image_url'];

            if(file_exists($file_path)){
                unlink($file_path);
            }
        }

        // ลบข้อมูลรูปเก่าใน DB
        mysqli_query($conn,
            "DELETE FROM cat_images WHERE cat_id=$cat_id"
        );
    }
}


/* =========================
   อัปโหลดหลายรูป
========================= */

if (!empty($_FILES['images']['name'][0])) {

    $upload_dir = "up1/";

    foreach($_FILES['images']['name'] as $key => $value){

        if($_FILES['images']['error'][$key] == 0){

            $tmp = $_FILES['images']['tmp_name'][$key];

            $new_name = time() . "_" . $value;

            move_uploaded_file($tmp, $upload_dir . $new_name);

            // บันทึกชื่อไฟล์ลง DB
            mysqli_query($conn,
                "INSERT INTO cat_images (cat_id, image_url)
                 VALUES ($cat_id, '$new_name')"
            );
        }
    }
}

header("Location: admin_list.php");
exit();
?>
