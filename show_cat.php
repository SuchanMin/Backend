<?php
session_start();
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>Cat Park</title>

<style>
body{
    margin:0;
    font-family:"Segoe UI",Tahoma,sans-serif;
    background:linear-gradient(135deg,#fff1f5,#e0f7fa);
}

/* ===== เมนู ===== */
.navbar{
    background:#ff6f91;
    padding:15px 30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 5px 15px rgba(0,0,0,0.15);
    position:sticky;
    top:0;
    z-index:100;
}
.navbar a{
    color:white;
    text-decoration:none;
    margin-left:15px;
    padding:8px 14px;
    border-radius:20px;
    background:rgba(255,255,255,0.2);
    transition:0.3s;
}
.navbar a:hover{
    background:white;
    color:#ff6f91;
}

/* ===== Layout ===== */
.cat-park{
    max-width:1200px;
    margin:40px auto;
    padding:20px;
}
.header{
    text-align:center;
    margin-bottom:40px;
}
.header h1{
    font-size:40px;
    color:#ff6f91;
}

/* ===== Card ===== */
.cat-item{
    background:white;
    border-radius:25px;
    padding:25px;
    margin-bottom:40px;
    box-shadow:0 15px 35px rgba(0,0,0,0.15);
    transition:0.4s;
}
.cat-item:hover{
    transform:translateY(-8px);
    box-shadow:0 25px 50px rgba(0,0,0,0.25);
}

/* ===== Image Grid ===== */
.cat-images{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(200px,1fr));
    gap:15px;
    margin-bottom:20px;
}
.cat-images img{
    width:100%;
    height:200px;
    object-fit:cover;
    border-radius:20px;
    transition:0.4s;
}
.cat-images img:hover{
    transform:scale(1.05);
}

/* ===== Text Section ===== */
.cat-title{
    font-size:26px;
    color:#ff6f91;
    margin-bottom:10px;
}
.sub{
    color:#888;
    margin-bottom:15px;
}
.info-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}
.info-block{
    background:#fff7fa;
    padding:15px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
}
.info-block.full{
    grid-column:1 / -1;
}
.info-title{
    font-weight:bold;
    color:#ff6f91;
    margin-bottom:5px;
}
.info-content{
    color:#555;
    line-height:1.6;
}

/* Responsive */
@media(max-width:768px){
    .info-grid{
        grid-template-columns:1fr;
    }
}
</style>
</head>

<body>

<div class="navbar">
    <div>
        <a href="show_cat.php">🏠 หน้าแรก</a>
    </div>
    <div>
        <?php if(isset($_SESSION['admin'])){ ?>
            <a href="admin_list.php">⚙ Admin</a>
            <a href="profile.php">👤 โปรไฟล์</a>
            <a href="logout.php">🚪 ออกจากระบบ</a>
        <?php } else { ?>
            <a href="login.php">🔐 เข้าสู่ระบบ</a>
        <?php } ?>
    </div>
</div>

<div class="cat-park">

    <div class="header">
        <h1>🐱 Cat Park</h1>
    </div>

    <div id="cat-container"></div>

</div>

<script>
async function fetchCats() {
    const response = await fetch('api_cats.php');
    const cats = await response.json();

    const container = document.getElementById('cat-container');
    container.innerHTML = '';

    cats.forEach(cat => {

        let imagesHtml = '';
        if (cat.images && cat.images.length > 0) {
            cat.images.forEach(img => {
                imagesHtml += `<img src="${img}" alt="รูปแมว">`;
            });
        }

        const catHtml = `
            <div class="cat-item">

                <div class="cat-images">
                    ${imagesHtml}
                </div>

                <div class="cat-title">${cat.name_th}</div>
                <div class="sub">English: ${cat.name_en}</div>

                <div class="info-grid">

                    <div class="info-block full">
                        <div class="info-title">คำอธิบาย</div>
                        <div class="info-content">${cat.description}</div>
                    </div>

                    <div class="info-block">
                        <div class="info-title">ลักษณะนิสัย</div>
                        <div class="info-content">${cat.characteristics}</div>
                    </div>

                    <div class="info-block">
                        <div class="info-title">การเลี้ยงดู</div>
                        <div class="info-content">${cat.care_instructions}</div>
                    </div>

                </div>
            </div>
        `;

        container.innerHTML += catHtml;
    });
}

fetchCats();
</script>

</body>
</html>
