<?php require_once("../controller/script.php");
require_once("redirect.php");
if (!isset($_GET['gereja'])) {
  header("Location: gereja");
  exit();
} else if (isset($_GET['gereja'])) {
  $keyword = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['gereja']))));
  $data = str_replace('-', ' ', $keyword);
  $dataGereja = mysqli_query($conn, "SELECT * FROM gereja WHERE nama_gereja='$data'");
  $row = mysqli_fetch_assoc($dataGereja);
  $id_gereja = $row['id_gereja'];
  $select_locationMaps = mysqli_query($conn, "SELECT * FROM gereja WHERE id_gereja!='$id_gereja'");
}
$_SESSION['page-name'] = "Lokasi Gereja " . $data;
$_SESSION['page-url'] = "lokasi?gereja=" . $keyword;
?>

<!DOCTYPE html>
<html lang="en">

<head><?php require_once("../resources/dash-header.php") ?></head>

<body>
  <?php if (isset($_SESSION['message-success'])) { ?>
    <div class="message-success" data-message-success="<?= $_SESSION['message-success'] ?>"></div>
  <?php }
  if (isset($_SESSION['message-info'])) { ?>
    <div class="message-info" data-message-info="<?= $_SESSION['message-info'] ?>"></div>
  <?php }
  if (isset($_SESSION['message-warning'])) { ?>
    <div class="message-warning" data-message-warning="<?= $_SESSION['message-warning'] ?>"></div>
  <?php }
  if (isset($_SESSION['message-danger'])) { ?>
    <div class="message-danger" data-message-danger="<?= $_SESSION['message-danger'] ?>"></div>
  <?php } ?>
  <div class="container-scroller">
    <?php require_once("../resources/dash-topbar.php") ?>
    <div class="container-fluid page-body-wrapper">
      <?php require_once("../resources/dash-sidebar.php") ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <h3><?= $_SESSION['page-name'] ?></h3>
                    </li>
                  </ul>
                </div>
                <div class="card rounded-0 mt-3">
                  <div class="card-body table-responsive">
                    <div id="map" style="width: 100%; height: 500px;"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
        <script>
          var map = L.map('map').setView([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>], 12);
          var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

          var iconLock = L.icon({
            iconUrl: '../assets/img/placeholder.png',
            iconSize: [38, 40],
          })
          var iconGereja = L.icon({
            iconUrl: '../assets/img/christian.png',
            iconSize: [38, 40],
          })

          L.marker([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>], {
            icon: iconLock
          }).bindPopup("<div><img src='../assets/img/gereja/<?= $row['img_gereja'] ?>' style='width: 310px;' alt=''><h2 style='margin-top: 5px;'><?= $row['nama_gereja'] ?></h2><p style='margin-top: -5px;'><?= $row['deskripsi_gereja'] ?></p><p style='margin-bottom: 0;'>Jumlah jemaat <?= $row['jumlah_jemaat'] ?> jiwa</p><small><?= $row['alamat'] ?> | telp: <?= $row['telp'] ?></small></div>").addTo(map);

          L.popup()
            .setLatLng([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>])
            .setContent("<div><img src='../assets/img/gereja/<?= $row['img_gereja'] ?>' style='width: 310px;' alt=''><h2 style='margin-top: 5px;'><?= $row['nama_gereja'] ?></h2><p style='margin-top: -5px;'><?= $row['deskripsi_gereja'] ?></p><p style='margin-bottom: 0;'>Jumlah jemaat <?= $row['jumlah_jemaat'] ?> jiwa</p><small><?= $row['alamat'] ?> | telp: <?= $row['telp'] ?></small></div>")
            .openOn(map);

          <?php if (mysqli_num_rows($select_locationMaps) > 0) {
            while ($row_g = mysqli_fetch_assoc($select_locationMaps)) {
          ?>
              L.marker([<?= $row_g['latitude'] ?>, <?= $row_g['longitude'] ?>], {
                icon: iconGereja
              }).bindPopup("<div><img src='../assets/img/gereja/<?= $row_g['img_gereja'] ?>' style='width: 310px;' alt=''><h2 style='margin-top: 5px;'><?= $row_g['nama_gereja'] ?></h2><p style='margin-top: -5px;'><?= $row_g['deskripsi_gereja'] ?></p><p style='margin-bottom: 0;'>Jumlah jemaat <?= $row_g['jumlah_jemaat'] ?> jiwa</p><small style='letter-spacing: 0;'><?= $row_g['alamat'] ?> | telp: <?= $row_g['telp'] ?></small><br></div>").addTo(map);
          <?php }
          } ?>
        </script>
</body>

</html>