<?php require_once("controller/script.php");
$_SESSION['page-name'] = "Beranda";
$_SESSION['page-url'] = "./";
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
                <h2>Gereja <em>GMIT</em></h2>
                <p>Cari Gereja GMIT yang mau kamu datangi sekarang dengan petunjuk arah yang mudah dibaca.</p>
                <form id="search" action="#" method="POST">
                  <fieldset>
                    <input type="text" name="nama-gereja" class="gereja" placeholder="Cari gereja..." autocomplete="on" required>
                  </fieldset>
                  <fieldset>
                    <button type="submit" name="cari-gereja" class="main-button">Cari</button>
                  </fieldset>
                </form>
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

  <div id="portfolio" class="our-portfolio section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="section-heading  wow bounceIn" data-wow-duration="1s" data-wow-delay="0.2s">
            <h2>Pendeta</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <?php if (mysqli_num_rows($frontPendeta) > 0) {
          while ($row_fp = mysqli_fetch_assoc($frontPendeta)) { ?>
            <div class="col-lg-3 col-sm-6">
              <a href="#">
                <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                  <div class="hidden-content">
                    <h4><?= $row_fp['nama_pendeta'] ?></h4>
                    <p>saat ini berada di gereja <?= $row_fp['nama_gereja'] ?> <?php if ($row_fp['status'] != "") {
                                                                                  echo "dan berstatus " . $row_fp['status'];
                                                                                } ?></p>
                    <small class="text-white">Telp: <?= $row_fp['telp'] ?></small>
                  </div>
                  <div class="showed-content">
                    <img src="assets/img/pendeta/<?= $row_fp['img_pendeta'] ?>" alt="">
                  </div>
                </div>
              </a>
            </div>
        <?php }
        } ?>
      </div>
    </div>
  </div>

  <div id="blog" class="our-blog section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.25s">
          <div class="section-heading">
            <h2>Gereja</h2>
          </div>
        </div>
      </div>
      <div class="row" style="margin-top: 100px;">
        <?php if (mysqli_num_rows($frontUGereja) > 0) {
          while ($row_fug = mysqli_fetch_assoc($frontUGereja)) {
            $url_fug = $row_fug['nama_gereja'];
            $url_fug = str_replace(" ", "-", $url_fug); ?>
            <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.25s">
              <div class="left-image">
                <a href="gereja?namanya=<?= $url_fug; ?>"><img src="assets/img/gereja/<?= $row_fug['img_gereja'] ?>" alt="Workspace Desktop"></a>
                <div class="info">
                  <div class="inner-content w-75">
                    <a href="gereja?namanya=<?= $url_fug; ?>">
                      <h4><?= $row_fug['nama_gereja'] ?></h4>
                    </a>
                    <p><?php $num_char = 100;
                        $text = trim($row_fug['deskripsi_gereja']);
                        $text = preg_replace('#</?strong.*?>#is', '', $text);
                        echo substr($text, 0, $num_char) . '...'; ?></p>
                  </div>
                </div>
              </div>
            </div>
        <?php }
        } ?>
        <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.25s">
          <div class="right-list">
            <ul>
              <?php if (mysqli_num_rows($frontGereja) > 0) {
                while ($row_fg = mysqli_fetch_assoc($frontGereja)) {
                  $url_fg = $row_fg['nama_gereja'];
                  $url_fg = str_replace(" ", "-", $url_fg); ?>
                  <li>
                    <div class="left-content align-self-center w-100">
                      <a href="gereja?namanya=<?= $url_fg; ?>">
                        <h4><?= $row_fg['nama_gereja'] ?></h4>
                      </a>
                      <p><?php $num_char = 100;
                          $text = trim($row_fg['deskripsi_gereja']);
                          $text = preg_replace('#</?strong.*?>#is', '', $text);
                          echo substr($text, 0, $num_char) . '...'; ?></p>
                    </div>
                    <div class="right-image">
                      <a href="gereja?namanya=<?= $url_fg; ?>"><img src="assets/img/gereja/<?= $row_fg['img_gereja'] ?>" style="height: 200px;background-size: cover;" alt=""></a>
                    </div>
                  </li>
              <?php }
              } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="maps" class="contact-us section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div id="map" class="shadow" style="width: 100%; height: 500px;"></div>
        </div>
      </div>
    </div>
  </div>

  <?php require_once("resources/footer.php"); ?>
  <script>
    var map = L.map('map').setView([<?= $geoJSON->loc; ?>], 12);
    var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

    var iconGereja = L.icon({
      iconUrl: 'assets/img/christian.png',
      iconSize: [38, 40],
    })

    <?php if (mysqli_num_rows($select_locationMaps) > 0) {
      while ($row = mysqli_fetch_assoc($select_locationMaps)) {
        $url = "gereja?namanya=" . $row['nama_gereja'];
        $url = str_replace(" ", "-", $url);
    ?>
        L.marker([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>], {
          icon: iconGereja
        }).bindPopup("<div><img src='assets/img/gereja/<?= $row['img_gereja'] ?>' style='width: 310px;' alt=''><h2 style='margin-top: 5px;'><a href='<?= $url ?> '><?= $row['nama_gereja'] ?></a></h2><p style='margin-top: -5px;'><?= $row['deskripsi_gereja'] ?></p><p style='margin-bottom: 0;'>Jumlah jemaat <?= $row['jumlah_jemaat'] ?> jiwa</p><small><?= $row['alamat'] ?> | telp: <?= $row['telp'] ?></small></div>").addTo(map);
    <?php }
    } ?>
  </script>
</body>

</html>