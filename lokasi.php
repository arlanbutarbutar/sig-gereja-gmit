<?php require_once("controller/script.php");
$_SESSION['page-name'] = "Lokasi";
$_SESSION['page-url'] = "lokasi";
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

  <div class="wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div id="map" style="width: 100%; height: 700px;z-index: 0;margin-top: 100px;"></div>
    <script>
      var map = L.map('map').setView([<?= $geoJSON->loc; ?>], 10);
      var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

      var iconLock = L.icon({
        iconUrl: 'assets/img/placeholder.png',
        iconSize: [38, 40],
      })
      var iconGereja = L.icon({
        iconUrl: 'assets/img/christian.png',
        iconSize: [38, 40],
      })

      <?php
      $select_locationMaps = mysqli_query($conn, "SELECT * FROM gereja");
      if (mysqli_num_rows($select_locationMaps) > 0) {
        while ($row_g = mysqli_fetch_assoc($select_locationMaps)) {
      ?>
          L.marker([<?= $row_g['latitude'] ?>, <?= $row_g['longitude'] ?>], {
            icon: iconGereja
          }).bindPopup("<div><img src='assets/img/gereja/<?= $row_g['img_gereja'] ?>' style='width: 310px;' alt=''><h2 style='margin-top: 5px;'><?= $row_g['nama_gereja'] ?></h2><p style='margin-top: -5px;'><?= $row_g['deskripsi_gereja'] ?></p><p style='margin-bottom: 0;'>Jumlah jemaat <?= $row_g['jumlah_jemaat'] ?> jiwa</p><small style='letter-spacing: 0;'><?= $row_g['alamat'] ?> | telp: <?= $row_g['telp'] ?></small><br><button type='submit' class='btn btn-primary btn-sm mt-3' onclick='return gass(<?= $row_g['latitude'] ?>, <?= $row_g['longitude'] ?>)'>Lihat Rute</button></div>").addTo(map);
      <?php }
      } ?>

      var control = L.Routing.control({
        waypoints: [
          L.latLng(<?= $geoJSON->loc; ?>),
          L.latLng(-10.169909, 123.607844)
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
  <?php require_once("resources/footer.php"); ?>
</body>

</html>