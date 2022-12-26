<?php require_once("controller/script.php");
$_SESSION['page-name'] = "Profil";
$_SESSION['page-url'] = "profil";
?>

<!DOCTYPE html>
<html lang="en">

<head><?php require_once("resources/header.php"); ?></head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <?php require_once("resources/navbar.php"); ?>
  <!-- ***** Header Area End ***** -->

  <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-6 align-self-center">
              <div class="left-content header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                <h6>Geographic Information System</h6>
                <h2>Profil Gereja <em>GMIT</em></h2>
                <div class="main-blue-button mt-3">
                  <a href="#profil">Lihat Profil</a>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                <img src="assets/img/banner.jpg" alt="" style="border-top-left-radius: 50px;border-bottom-right-radius: 50px;">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="profil" class="our-services section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s">
          <div class="left-image">
            <img src="assets/img/bg-profil.jpg" alt="">
          </div>
        </div>
        <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
          <div class="section-heading">
            <h2>Profil Gereja GMIT</h2>
            <p class="text-justify">Gereja Masehi Injili di Timor (GMIT) adalah salah satu Gereja Bagian Mandiri dari Gereja Protestan di Indonesia (GBM GPI). Gereja ini terletak di provinsi Nusa Tenggara Timur (NTT) dan telah berdiri sejak 31 Oktober 1947. Pada tahun 1948, gereja ini bergabung dengan World Christian Conference (WCC). Selain itu Gereja ini juga ikut mendirikan dan tergabung dalam Gereja Protestan Indonesia (GPI), Dewan Gereja-gereja di Indonesia (DGI), yang sekarang disebut Persekutuan Gereja-gereja di Indonesia (PGI) pada tahun 1950.</p>
            <p class="text-justify">GMIT adalah salah satu dari 3 GBM pertama (Gereja Bagian Mandiri) dari Indische Kerk yang disetujui pada 1933 untuk mewakili wilayah Minahasa (keresidenan Minahasa), Maluku (Keresidenan Maluku), dan Timor (Keresidenan Timor & Pulau2), namun peresmiannya terjadi yang paling akhir pada tahun 1947, 2 gereja saudara yang telah mandiri adalah GMIM (1934) dan GPM (1935), GMIT yang akan menyusul pada 1937 tertunda akibat pergolakan politik daerah dan nasional, diikuti pecahnya perang dunia ke 2 (1939 - 1945), lalu masuknya jepang ke nusa tenggara 1942, dan pergerakan kemerdekaan (NIT/RIS 1946 - 1950).</p>
            <p class="text-justify">Pada Maret 1947 walaupun belum resmi menjadi Gereja Bagian Mandiri, GMIT termasuk dalam "Majelis Usaha bersama Gereja-Gereja di Indonesia bagian Timur" yang merumuskan DGI (Dewan Gereja2 Indonesia) di Makassar.</p>
            <p class="text-justify">kemandirian GMIT dipercepat segera dalam 3 bulan setelah rapat 1947 di Makassar dan akhirnya pada oktober 1947 diresmikan. hal ini ini agar tidak didahului GBM baru yaitu GIPB sebagai GBM saudara bagian barat dari ke 3 GBM awal, GPIB sudah dipersiapkan Indische kerk dan diresmikan pada desember 1948 sekaligus Indische Kerk berganti nama menjadi GPI (Gereja Protestan Indonesia) -yang mana penamaan GPI-B menandai sejarah pergantian nama ini.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php require_once("resources/footer.php"); ?>
</body>

</html>