<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HitaDel</title>

    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <header class="header">
        <nav class="navigation">
            <a href="{{ route('login') }}" class="btnLogin-popup"><i class='bx bxs-user'></i></a>
        </nav>
    </header>


    <section class="home" id="home">
        <div class="hero-content">
            <h3 class="pembatas">Welcome To Our Website</h3>
            <h1>HitaDel</h1>
            <a href="#about" class="btn">Go To Profile</a> 
        </div>
    </section>

    <section class="about" id="about">
    <h2 class="heading">About <span>Website</span></h2>
    
    <div class="about-content">
        <div class="about-img">
            <img src="{{ asset('img/aboutus/th.jpeg') }}" alt="Image 1">
        </div>
        <div class="about-text">
            <p>Hita del adalah sebuah website yang bertujuan sebagai tempat mencari informasi terkait pekerjaan tersedia.</p>
        </div>
    </div>

    <div class="about-content">
        <div class="about-img">
            <img src="{{ asset('img/aboutus/th1.jpeg') }}" alt="Image 2">
        </div>
        <div class="about-text">
            <p>Hita Del menyediakan informasi pekerjaan yang sesuai dengan latar belakang akademis dan keterampilan mereka. Mulai dari posisi administratif, program magang lanjutan, hingga pekerjaan full-time di berbagai bidang tersedia. Alumni juga bisa mengakses informasi tentang lowongan terbaru melalui pusat pengembangan karir atau portal karir.</p>
        </div>
    </div>
</section>

    
   <footer class="footer" style="width: 100%; height:auto; background:black; padding:20px 50px 30px 50px;">
    <div style="width: 100%; height:auto">
        <div class="logo" style="display: flex; justify-content:center;">
        </div>
        <br>
        <div class="isi" style="display: flex; justify-content:space-around; margin-top:5vh;">
            <div class="contactus">
                <h3>Contact Us</h3>
                <br>
                <a style="display:flex; align-items:center; color: white; margin: 0 10px 0 0;" href="#" target="_blank" title="Location">
                    <div style="background:white;width:32px; height:32px; border-radius:50%; padding:1px;">
                        <i style="background:rgb(255, 255, 255); font-size:28px; border-radius:50%; color: rgb(0, 0, 0); margin: 0 20px 0 0;" class='bx bx-home'></i>
                    </div>
                    <p style="margin-left: 10px;">Jl. Sitoluama, Kec. Balige, Kab. Toba, Institut Teknologi Del, Sumatera Utara - Indonesia</p>
                </a>
            </div>
            <div class="medsos">
                <h3>Media Social</h3>
                <br>
                <div class="social-media" style="display: block;">
                    <a style="display:flex; align-items:center; color: white; margin: 0 10px 0 0;" href="#" target="_blank" title="YouTube">
                        <div style="background:white;width:32px; height:32px; border-radius:50%; padding:1px;">
                            <ion-icon style="background:rgb(255, 255, 255);width:30px; height:30px; border-radius:50%; color: rgb(0, 0, 0); margin: 0 20px 0 0;" name="logo-youtube"></ion-icon>
                        </div>
                        <p style="margin-left: 10px;">YouTube</p>
                    </a>
                    <br><br>
                    <a style=" display:flex; align-items:center; color: white; margin: 0 10px 0 0;" href="#" target="_blank" title="Email">
                        <div style="background:white;width:32px; height:32px; border-radius:50%; padding:1px;">
                            <ion-icon style="background:rgb(255, 255, 255);width:30px; height:30px; border-radius:50%; color: rgb(0, 0, 0); margin: 0 20px 0 0;" name="mail"></ion-icon>
                        </div>
                        <p style="margin-left: 10px;">Email</p>
                    </a>
                    <br><br>
                    <a style="display:flex; align-items:center; color: white; margin: 0 10px 0 0;" href="#" target="_blank" title="WhatsApp">
                        <div style="background:white;width:32px; height:32px; border-radius:50%; padding:1px;">
                            <ion-icon style="background:rgb(255, 255, 255);width:30px; height:30px; border-radius:50%; color: rgb(0, 0, 0); margin: 0 20px 0 0;" name="logo-whatsapp"></ion-icon>
                        </div>
                        <p style="margin-left: 10px;">WhatsApp</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <hr style="background: white; width:100%; height:2px">
    <br>
    <div style="text-align: center;" class="footer-content">
    </div>
</footer>
<script src="../js/login.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
