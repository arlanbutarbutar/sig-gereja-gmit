<?php require_once("../controller/script.php"); ?>

<div class="tab-content tab-content-basic">
  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
    <div class="row">
      <div id="map" class="shadow" style="width: 100%; height: 600px;z-index: 0;"></div>
      <script>
        var map = L.map('map').setView([-10.170164, 123.607757], 12);
        var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

        var iconLock = L.icon({
          iconUrl: '../assets/img/placeholder.png',
          iconSize: [38, 40],
        })
        var iconGereja = L.icon({
          iconUrl: '../assets/img/christian.png',
          iconSize: [38, 40],
        })

        <?php if (mysqli_num_rows($select_locationO) > 0) {
          while ($row = mysqli_fetch_assoc($select_locationO)) {
        ?>
            L.marker([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>], {
              icon: iconGereja
            }).bindPopup("<div><img src='../assets/img/gereja/<?= $row['img_gereja'] ?>' style='width: 310px;' alt=''><h2 style='margin-top: 5px;'><?= $row['nama_gereja'] ?></h2><p style='margin-top: -5px;'><?= $row['deskripsi_gereja'] ?></p><p style='margin-bottom: 0;'>Jumlah jemaat <?= $row['jumlah_jemaat'] ?> jiwa</p><small><?= $row['alamat'] ?> | telp: <?= $row['telp'] ?></small></div>").addTo(map);
        <?php }
        } ?>
      </script>
    </div>
  </div>
</div>