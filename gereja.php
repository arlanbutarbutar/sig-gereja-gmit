<?php require_once("controller/script.php");
if (isset($_GET['namanya'])) {
  $keyword = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['namanya']))));
  $nama_gereja = str_replace("-", " ", $keyword);
  $searchGereja = mysqli_query($conn, "SELECT * FROM gereja WHERE nama_gereja LIKE '%$nama_gereja%'");
  $searchDataGereja = mysqli_query($conn, "SELECT * FROM gereja WHERE nama_gereja LIKE '%$nama_gereja%' LIMIT 1");
  $_SESSION['page-name'] = "Gereja " . $nama_gereja;
  $_SESSION['page-url'] = "gereja?namanya=" . $keyword;
} else if (isset($_GET['namanya'])) {
  $_SESSION['page-name'] = "Gereja";
  $_SESSION['page-url'] = "gereja";
}
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
          <?php if (!isset($_GET['namanya'])) { ?>
            <div class="row">
              <div class="col-lg-6 align-self-center">
                <div class="left-content header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                  <h6>Geographic Information System</h6>
                  <h2>Gereja <em>GMIT</em></h2>
                  <div class="main-blue-button mt-3">
                    <a href="#gereja">Lihat Gereja</a>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                  <img src="assets/img/banner.jpg" alt="" style="border-top-left-radius: 50px;border-bottom-right-radius: 50px;">
                </div>
              </div>
            </div>
            <?php } else if (isset($_GET['namanya'])) {
            if (mysqli_num_rows($searchGereja) == 0) { ?>
              <div class="row" style="margin-top: -50px;">
                <div class="col-lg-6 align-self-center">
                  <div class="left-content header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                    <h6>Geographic Information System</h6>
                    <h2>Gereja <em>GMIT</em></h2>
                    <h4>Upps... pencarian gereja <em><?= $nama_gereja; ?></em> tidak ditemukan</h4>
                    <p>Kami memiliki rekomendasi lain yang bisa kamu lihat</p>
                    <div class="main-blue-button mt-3">
                      <a href="#gereja">Lihat Gereja</a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                    <img src="assets/img/no-data.png" alt="">
                  </div>
                </div>
              </div>
              <?php } else if (mysqli_num_rows($searchGereja) > 0) {
              while ($dataSearch = mysqli_fetch_assoc($searchGereja)) { ?>
                <div class="row" style="margin-top: -50px;">
                  <div class="col-lg-6 align-self-center">
                    <div class="left-content header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                      <h6>Geographic Information System</h6>
                      <h2>Gereja <em>GMIT</em></h2>
                      <h4>Data pencarian Gereja <em><?= $nama_gereja; ?></em> ditemukan</h4>
                      <div class="main-blue-button mt-3">
                        <a href="#yang-dicari">Lihat <?= $nama_gereja; ?></a>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                      <img src="assets/img/view-data.png" alt="">
                    </div>
                  </div>
                </div>
          <?php }
            }
          } ?>
        </div>
      </div>
    </div>
  </div>

  <?php if (isset($_GET['namanya'])) {
    if (mysqli_num_rows($searchDataGereja) > 0) {
      while ($data = mysqli_fetch_assoc($searchDataGereja)) { ?>
        <div id="yang-dicari" class="our-services section">
          <div class="container">
            <div class="row">
              <div class="col-lg-6 align-self-center  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s">
                <div class="left-image">
                  <img src="assets/img/gereja/<?= $data['img_gereja'] ?>" style="border-top-left-radius: 50px;border-bottom-right-radius: 50px;" alt="">
                </div>
              </div>
              <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
                <div class="section-heading">
                  <h2><?= $data['nama_gereja'] ?></h2>
                  <p style="margin-bottom: -10px;"><?= $data['deskripsi_gereja'] ?></p>
                  <p style="margin-bottom: -35px;">Jumlah Jemaat: <?= $data['jumlah_jemaat'] ?></p>
                  <p style="margin-bottom: -35px;">Alamat: <?= $data['alamat'] ?></p>
                  <p style="margin-bottom: 10px;">Telp: <?= $data['telp'] ?></p>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="first-bar progress-skill-bar">
                      <h4 style="margin-bottom: 10px;">Pendeta</h4>
                      <?php $id_gereja = $data['id_gereja'];
                      $takePendeta = mysqli_query($conn, "SELECT * FROM pendeta WHERE id_gereja='$id_gereja'");
                      if (mysqli_num_rows($takePendeta) > 0) {
                        while ($data_p = mysqli_fetch_assoc($takePendeta)) { ?>
                          <p style="margin-bottom: -10px;"><?= $data_p['nama_pendeta'] ?></p>
                      <?php }
                      } ?>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="second-bar progress-skill-bar">
                      <h4 style="margin-top: 0px;">Fasilitas</h4>
                      <?php $id_gereja = $data['id_gereja'];
                      $takeFasilitas = mysqli_query($conn, "SELECT * FROM fasilitas JOIN fasilitas_gereja ON fasilitas.id_fasilitas=fasilitas_gereja.id_fasilitas WHERE fasilitas_gereja.id_gereja='$id_gereja'");
                      if (mysqli_num_rows($takeFasilitas) > 0) {
                        while ($data_f = mysqli_fetch_assoc($takeFasilitas)) { ?>
                          <p style="margin-bottom: -10px;"><?= $data_f['nama_fasilitas'] ?></p>
                      <?php }
                      } ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div id="map" class="shadow" style="width: 100%; height: 500px;margin-top: 50px;"></div>
                <script>
                  var map = L.map('map').setView([<?= $geoJSON->loc; ?>], 12);
                  var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

                  var iconLock = L.icon({
                    iconUrl: 'assets/img/placeholder.png',
                    iconSize: [38, 40],
                  })

                  L.marker([<?= $data['latitude'] ?>, <?= $data['longitude'] ?>], {
                    icon: iconLock
                  }).bindPopup("<div><img src='assets/img/gereja/<?= $data['img_gereja'] ?>' style='width: 310px;' alt=''><h2 style='margin-top: 5px;'><?= $data['nama_gereja'] ?></h2><p style='margin-top: -5px;'><?= $data['deskripsi_gereja'] ?></p><p style='margin-bottom: 0;'>Jumlah jemaat <?= $data['jumlah_jemaat'] ?> jiwa</p><small><?= $data['alamat'] ?> | telp: <?= $data['telp'] ?></small></div>").addTo(map);

                  L.popup()
                    .setLatLng([<?= $data['latitude'] ?>, <?= $data['longitude'] ?>])
                    .setContent("<div><img src='assets/img/gereja/<?= $data['img_gereja'] ?>' style='width: 310px;' alt=''><h2 style='margin-top: 5px;'><?= $data['nama_gereja'] ?></h2><p style='margin-top: -5px;'><?= $data['deskripsi_gereja'] ?></p><p style='margin-bottom: 0;'>Jumlah jemaat <?= $data['jumlah_jemaat'] ?> jiwa</p><small><?= $data['alamat'] ?> | telp: <?= $data['telp'] ?></small></div>")
                    .openOn(map);


                  var control = L.Routing.control({
                    waypoints: [
                      L.latLng(<?= $geoJSON->loc; ?>),
                      L.latLng(<?= $data['latitude'] ?>, <?= $data['longitude'] ?>)
                    ],
                    routeWhileDragging: true
                  })
                  control.addTo(map);

                  function gass(lat, lng) {
                    var latLng = L.latLng(lat, lng);
                    control.spliceWaypoints(control.getWaypoints().length - 1, 1, latLng);
                  }
                </script>
              </div>
            </div>
          </div>
        </div>
  <?php }
    }
  } ?>

  <div id="gereja" class="our-blog section" style="margin-bottom: 100px;">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.25s">
          <div class="section-heading">
            <?php if (isset($_GET['namanya'])) { ?>
              <h4>Gereja</h4>
              <h2>Direkomendasikan untuk anda</h2>
            <?php } else if (!isset($_GET['namanya'])) { ?>
              <h2>Gereja</h2>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="row" style="margin-top: 20px;margin-bottom: 100px;">
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
      <div class="row">
        <?php if (mysqli_num_rows($frontAGereja) > 0) {
          while ($row_fg = mysqli_fetch_assoc($frontAGereja)) {
            $url_fg = $row_fg['nama_gereja'];
            $url_fg = str_replace(" ", "-", $url_fg); ?>
            <div class="col-lg-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.25s">
              <div class="right-list">
                <ul>
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
                </ul>
              </div>
            </div>
        <?php }
        } ?>
      </div>
    </div>
  </div>

  <?php require_once("resources/footer.php"); ?>
</body>

</html>