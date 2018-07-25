<!DOCTYPE html>
<html lang="th"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example with a side menu that hides on mobile, just like the Pure website.">
    <title>โครงการคลังข้อมูล TTS</title>
    
    <link rel="stylesheet" href="css/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <link rel="stylesheet" href="css/1.css">
</head>
<body>

<div id="layout" class="">
    <!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="menu-link">
        <!-- Hamburger icon -->
        <span></span>
    </a>

    <div id="menu" class="">
        <div class="pure-menu">
            <a class="pure-menu-heading" href="#">TTS</a>
            <ul class="pure-menu-list">
                <li class="pure-menu-item menu-item-divided pure-menu-selected"><a href="index.php" class="pure-menu-link">Home</a></li>
                <?php if(isset($_COOKIE['user'])){
                    echo '<li class="pure-menu-item"><a href="corpus.php" class="pure-menu-link">คลังข้อมูล</a></li>';
                    echo '<li class="pure-menu-item"><a href="logout.php" class="pure-menu-link">ลงชื่อออก</a></li>';
                }
                else{
                 echo '<li class="pure-menu-item"><a href="login.html" class="pure-menu-link">เข้าสู่ระบบ</a></li>';
                }?>
                <li class="pure-menu-item"><a href="#" class="pure-menu-link">About</a></li>
            </ul>
        </div>
    </div>

    <div id="main">
        <div class="header">
            <h1>ระบบอัดเสียงสำหรับ TTS</h1>
        </div>

        <div class="content">
            <h2 class="content-subhead">How to use this layout</h2>
            <p>ทดสอบ
            </p>

            <div class="pure-g">
                <div class="pure-u-1-4">
                    <img class="pure-img-responsive" src="%E0%B9%84%E0%B8%9F%E0%B8%A5%E0%B9%8C_tt/9069037713_1752f5daeb.jpg" alt="Peyto Lake">
                </div>
                <div class="pure-u-1-4">
                    <img class="pure-img-responsive" src="%E0%B9%84%E0%B8%9F%E0%B8%A5%E0%B9%8C_tt/9069585985_80da8db54f.jpg" alt="Train">
                </div>
                <div class="pure-u-1-4">
                    <img class="pure-img-responsive" src="%E0%B9%84%E0%B8%9F%E0%B8%A5%E0%B9%8C_tt/9121446012_c1640e42d0.jpg" alt="T-Shirt Store">
                </div>
                <div class="pure-u-1-4">
                    <img class="pure-img-responsive" src="%E0%B9%84%E0%B8%9F%E0%B8%A5%E0%B9%8C_tt/9086701425_fda3024927.jpg" alt="Mountain">
                </div>
            </div>
        </div>
    </div>
</div>




<script src="js/1.13"></script>



</body></html>