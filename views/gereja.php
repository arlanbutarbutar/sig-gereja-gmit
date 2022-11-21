<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION['page-name'] = "Gereja";
$_SESSION['page-url'] = "gereja";
?>

<!DOCTYPE html>
<html lang="en">

<head><?php require_once("../resources/dash-header.php") ?></head>

<body style="font-family: 'Montserrat', sans-serif;">
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
              </div>
            </div>
          </div>
          <?php if (!isset($_GET['ubah'])) { ?>
            <div class="row">
              <div class="col-lg-8 mt-3">
                <div id="map" class="shadow" style="width: 100%; height: 930px;z-index: 0;"></div>
                <script>
                  var map = L.map('map').setView([<?= $geoJSON->loc; ?>], 12);
                  var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

                  // get coordinat location
                  var latInput = document.querySelector("[name=latitude]");
                  var lngInput = document.querySelector("[name=longitude]");
                  var curLocation = [<?= $geoJSON->loc; ?>];
                  map.attributionControl.setPrefix(false);
                  var marker = new L.marker(curLocation, {
                    draggable: 'true',
                  });
                  marker.on('dragend', function(event) {
                    var position = marker.getLatLng();
                    marker.setLatLng(position, {
                      draggable: 'true',
                    }).bindPopup(position).update();
                    $("#latitude").val(position.lat);
                    $("#longitude").val(position.lng);
                  });
                  map.addLayer(marker);

                  map.on("click", function(e) {
                    var lat = e.latlng.lat;
                    var lng = e.latlng.lng;
                    if (!marker) {
                      marker = L.marker(e.latlng).addTo(map);
                    } else {
                      marker.setLatLng(e.latlng);
                    }
                    latInput.value = lat;
                    lngInput.value = lng;
                  });
                </script>
              </div>
              <div class="col-lg-4 mt-3">
                <div class="card border-0 rounded-0 shadow">
                  <div class="card-header border-bottom-0 shadow text-center">
                    <h4 class="modal-title p-3" id="exampleModalLabel">Tambah Gereja</h4>
                  </div>
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-body text-center">
                      <div class="mb-3">
                        <label for="image" class="form-label">Upload Foto Gereja</label>
                        <input class="form-control" name="image" type="file" id="image" required>
                      </div>
                      <div class="mb-3">
                        <label for="fasilitas" class="form-label">Fasilitas</label>
                        <select name="id-fasilitas" class="form-select" aria-label="Default select example" required>
                          <?php if (isset($_GET['id-fasilitas'])) {
                            foreach ($selectCheckFasilitas as $row_cf) : ?>
                              <option selected value="<?= $row_cf['id_fasilitas'] ?>"><?= $row_cf['nama_fasilitas'] ?></option>
                            <?php endforeach;
                            foreach ($selectFasilitas as $row_f) : ?>
                              <option value="<?= $row_f['id_fasilitas'] ?>"><?= $row_f['nama_fasilitas'] ?></option>
                            <?php endforeach;
                          } else if (!isset($_GET['id-fasilitas'])) { ?>
                            <option selected value="">Pilih Fasilitas</option>
                            <?php foreach ($selectFasilitas as $row_f) : ?>
                              <option value="<?= $row_f['id_fasilitas'] ?>"><?= $row_f['nama_fasilitas'] ?></option>
                          <?php endforeach;
                          } ?>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="nama" class="form-label">Nama Gereja</label>
                        <input type="text" name="nama" class="form-control text-center" value="<?php if (isset($_POST['nama'])) {
                                                                                                  echo $_POST['nama'];
                                                                                                } ?>" id="nama" placeholder="Nama Gereja" required>
                      </div>
                      <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" style="height: 100px;"><?php if (isset($_POST['deskripsi'])) {
                                                                                                                          echo $_POST['deskripsi'];
                                                                                                                        } ?></textarea>
                      </div>
                      <div class="mb-3">
                        <label for="jemaat" class="form-label">Jumlah Jemaat</label>
                        <input type="number" name="jemaat" value="<?php if (isset($_POST['jemaat'])) {
                                                                    echo $_POST['jemaat'];
                                                                  } ?>" class="form-control text-center" id="jemaat" placeholder="Jumlah Jemaat" required>
                      </div>
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" name="alamat" value="<?php if (isset($_POST['alamat'])) {
                                                                  echo $_POST['alamat'];
                                                                } ?>" class="form-control text-center" id="alamat" placeholder="Alamat" required>
                      </div>
                      <div class="mb-3">
                        <label for="telp" class="form-label">Telpon</label>
                        <input type="tel" name="telp" value="<?php if (isset($_POST['telp'])) {
                                                                echo $_POST['telp'];
                                                              } ?>" class="form-control text-center" id="telp" placeholder="Telpon" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4||3}" required>
                      </div>
                      <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="number" name="latitude" value="<?php if (isset($_POST['latitude'])) {
                                                                      echo $_POST['latitude'];
                                                                    } ?>" class="form-control text-center" id="latitude" placeholder="Latitude" readonly required>
                      </div>
                      <div class="mb-3">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="number" name="longitude" value="<?php if (isset($_POST['longitude'])) {
                                                                        echo $_POST['longitude'];
                                                                      } ?>" class="form-control text-center" id="longitude" placeholder="Longitude" readonly required>
                      </div>
                    </div>
                    <div class="card-footer border-top-0 text-center shadow">
                      <button type="submit" name="tambah-gereja" class="btn btn-primary border-0 shadow rounded-0">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          <?php } else if (isset($_GET['ubah'])) {
            $idg = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['ubah']))));
            $ubahGereja = mysqli_query($conn, "SELECT * FROM gereja WHERE id_gereja='$idg'");
            $row_ubah = mysqli_fetch_assoc($ubahGereja); ?>
            <div class="row">
              <div class="col-lg-8 mt-3">
                <div id="map" class="shadow" style="width: 100%; height: 850px;z-index: 0;"></div>
                <script>
                  var map = L.map('map').setView([<?= $row_ubah['latitude'] ?>, <?= $row_ubah['longitude'] ?>], 14);
                  var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

                  // get coordinat location
                  var latInput = document.querySelector("[name=latitude]");
                  var lngInput = document.querySelector("[name=longitude]");
                  var curLocation = [<?= $row_ubah['latitude'] ?>, <?= $row_ubah['longitude'] ?>];
                  map.attributionControl.setPrefix(false);
                  var marker = new L.marker(curLocation, {
                    draggable: 'true',
                  });
                  marker.on('dragend', function(event) {
                    var position = marker.getLatLng();
                    marker.setLatLng(position, {
                      draggable: 'true',
                    }).bindPopup(position).update();
                    $("#latitude").val(position.lat);
                    $("#longitude").val(position.lng);
                  });
                  map.addLayer(marker);

                  map.on("click", function(e) {
                    var lat = e.latlng.lat;
                    var lng = e.latlng.lng;
                    if (!marker) {
                      marker = L.marker(e.latlng).addTo(map);
                    } else {
                      marker.setLatLng(e.latlng);
                    }
                    latInput.value = lat;
                    lngInput.value = lng;
                  });
                </script>
              </div>
              <div class="col-lg-4 mt-3">
                <div class="card border-0 rounded-0 shadow">
                  <div class="card-header border-bottom-0 shadow text-center">
                    <h4 class="modal-title p-3" id="exampleModalLabel">Ubah Gereja <?= $row_ubah['nama_gereja'] ?></h4>
                  </div>
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-body text-center">
                      <div class="mb-3">
                        <label for="image" class="form-label">Upload Foto Gereja</label>
                        <input class="form-control" name="image" type="file" id="image">
                      </div>
                      <div class="mb-3">
                        <label for="nama" class="form-label">Nama Gereja</label>
                        <input type="text" name="nama" class="form-control text-center" value="<?php if (isset($_POST['nama'])) {
                                                                                                  echo $_POST['nama'];
                                                                                                } else {
                                                                                                  echo $row_ubah['nama_gereja'];
                                                                                                } ?>" id="nama" placeholder="Nama Gereja" required>
                      </div>
                      <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" style="height: 100px;"><?php if (isset($_POST['deskripsi'])) {
                                                                                                                          echo $_POST['deskripsi'];
                                                                                                                        } else {
                                                                                                                          echo $row_ubah['deskripsi_gereja'];
                                                                                                                        } ?></textarea>
                      </div>
                      <div class="mb-3">
                        <label for="jemaat" class="form-label">Jumlah Jemaat</label>
                        <input type="number" name="jemaat" value="<?php if (isset($_POST['jemaat'])) {
                                                                    echo $_POST['jemaat'];
                                                                  } else {
                                                                    echo $row_ubah['jumlah_jemaat'];
                                                                  } ?>" class="form-control text-center" id="jemaat" placeholder="Jumlah Jemaat" required>
                      </div>
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" name="alamat" value="<?php if (isset($_POST['alamat'])) {
                                                                  echo $_POST['alamat'];
                                                                } else {
                                                                  echo $row_ubah['alamat'];
                                                                } ?>" class="form-control text-center" id="alamat" placeholder="Alamat" required>
                      </div>
                      <div class="mb-3">
                        <label for="telp" class="form-label">Telpon</label>
                        <input type="tel" name="telp" value="<?php if (isset($_POST['telp'])) {
                                                                echo $_POST['telp'];
                                                              } else {
                                                                echo $row_ubah['telp'];
                                                              } ?>" class="form-control text-center" id="telp" placeholder="Telpon" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4||3}" required>
                      </div>
                      <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="number" name="latitude" value="<?php if (isset($_POST['latitude'])) {
                                                                      echo $_POST['latitude'];
                                                                    } else {
                                                                      echo $row_ubah['latitude'];
                                                                    } ?>" class="form-control text-center" id="latitude" placeholder="Latitude" readonly required>
                      </div>
                      <div class="mb-3">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="number" name="longitude" value="<?php if (isset($_POST['longitude'])) {
                                                                        echo $_POST['longitude'];
                                                                      } else {
                                                                        echo $row_ubah['longitude'];
                                                                      } ?>" class="form-control text-center" id="longitude" placeholder="Longitude" readonly required>
                      </div>
                    </div>
                    <div class="card-footer border-top-0 text-center shadow">
                      <input type="hidden" name="id" value="<?= $row_ubah['id_gereja'] ?>">
                      <input type="hidden" name="namaOld" value="<?= $row_ubah['nama_gereja'] ?>">
                      <input type="hidden" name="imageOld" value="<?= $row_ubah['img_gereja'] ?>">
                      <button type="submit" name="ubah-gereja" class="btn btn-primary border-0 shadow rounded-0">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          <?php } ?>
          <div class="row">
            <div class="col-md-12">
              <div class="card rounded-0 mt-3">
                <div class="card-body table-responsive">
                  <table class="table table-striped table-hover table-borderless table-sm text-center display" id="datatable">
                    <thead>
                      <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Nama Gereja</th>
                        <th scope="col" class="text-center">Deskripsi</th>
                        <th scope="col" class="text-center">Fasilitas</th>
                        <th scope="col" class="text-center">Jemaat</th>
                        <th scope="col" class="text-center">Alamat</th>
                        <th scope="col" class="text-center">Telp</th>
                        <th scope="col" class="text-center">Lokasi</th>
                        <th scope="col" class="text-center">Tgl buat</th>
                        <th scope="col" class="text-center">Tgl ubah</th>
                        <th scope="col" class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (mysqli_num_rows($gereja) > 0) {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($gereja)) { ?>
                          <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td>
                              <div class="d-flex ">
                                <img src="../assets/img/gereja/<?= $row['img_gereja'] ?>" alt="" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#img-gereja<?= $row['id_gereja'] ?>">
                                <div class="modal fade" id="img-gereja<?= $row['id_gereja'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel"><?= $row['nama_gereja'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body text-center">
                                        <img src="../assets/img/gereja/<?= $row['img_gereja'] ?>" class="rounded-0" style="width: 100%;height: 100%;" alt="">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="m-auto">
                                  <h6 style="margin-left: 10px;"><?= $row['nama_gereja'] ?></h6>
                                </div>
                              </div>
                            </td>
                            <td>
                              <button type="button" class="btn btn-link btn-sm rounded-0 border-0 shadow text-decoration-none" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#deskripsi<?= $row['id_gereja'] ?>">
                                <i class="mdi mdi-eye"></i> Lihat
                              </button>
                              <div class="modal fade" id="deskripsi<?= $row['id_gereja'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Gereja <?= $row['nama_gereja'] ?></h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-left">
                                      <textarea class="form-control rounded-0 border-0" style="height: 300px;" id="exampleFormControlTextarea1" rows="3"><?= $row['deskripsi_gereja'] ?></textarea>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td>
                              <?php $id_gereja = $row['id_gereja'];
                              $takeFasilitas = mysqli_query($conn, "SELECT * FROM gereja JOIN fasilitas_gereja ON gereja.id_gereja=fasilitas_gereja.id_gereja JOIN fasilitas ON fasilitas_gereja.id_fasilitas=fasilitas.id_fasilitas WHERE fasilitas_gereja.id_gereja='$id_gereja'");
                              while ($row_tf = mysqli_fetch_assoc($takeFasilitas)) { ?>
                                <div class="d-flex">
                                  <p>
                                    <i class="mdi mdi-check"></i> <?= $row_tf['nama_fasilitas'] ?>
                                  </p>
                                  <form action="" method="post">
                                    <input type="hidden" name="id" value="<?= $row_tf['id_fasilitas_gereja'] ?>">
                                    <input type="hidden" name="id-gereja" value="<?= $row['id_gereja'] ?>">
                                    <input type="hidden" name="namaOld" value="<?= $row['nama_gereja'] ?>">
                                    <button type="submit" name="hapus-fasilitas-gereja" class="btn btn-link text-decoration-none"><i class="bi bi-trash3 text-danger"></i></button>
                                  </form>
                                </div>
                              <?php } ?>
                              <hr>
                              <button type="button" class="btn btn-primary btn-sm rounded-0 border-0 shadow" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#tambah-fasilitas<?= $row['id_gereja'] ?>">
                                <i class="mdi mdi-plus"></i> Tambah
                              </button>
                              <div class="modal fade" id="tambah-fasilitas<?= $row['id_gereja'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header border-bottom-0 shadow">
                                      <h5 class="modal-title" id="exampleModalLabel">Tambah Fasilitas <?= $row['nama_gereja'] ?></h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="" method="POST">
                                      <div class="modal-body">
                                        <div class="mb-3">
                                          <label for="fasilitas" class="form-label">Fasilitas</label>
                                          <select name="id-fasilitas" class="form-select" aria-label="Default select example" required>
                                            <option selected value="">Pilih Fasilitas</option>
                                            <?php foreach ($selectFasilitas as $row_f) : ?>
                                              <option value="<?= $row_f['id_fasilitas'] ?>"><?= $row_f['nama_fasilitas'] ?></option>
                                            <?php endforeach; ?>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="modal-footer justify-content-center border-top-0">
                                        <input type="hidden" name="id" value="<?= $row['id_gereja'] ?>">
                                        <input type="hidden" name="namaOld" value="<?= $row['nama_gereja'] ?>">
                                        <button type="button" class="btn btn-secondary rounded-0 shadow border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" name="tambah-fasilitas-gereja" class="btn btn-success rounded-0 shadow border-0" style="height: 30px;">Tambah</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td><?= $row['jumlah_jemaat'] ?></td>
                            <td><?= $row['alamat'] ?></td>
                            <td><?= $row['telp'] ?></td>
                            <td>
                              <button type="button" onclick="window.location.href='lokasi?gereja=<?php $url = $row['nama_gereja'];
                                                                                                  echo str_replace(' ', '-', $url); ?>'" class="btn btn-success btn-sm rounded-0 text-white" style="height: 30px;"><i class="mdi mdi-map"></i> Gereja</button>
                            </td>
                            <td>
                              <div class="badge badge-opacity-success">
                                <?php $dateCreate = date_create($row['created_at']);
                                echo date_format($dateCreate, "l, d M Y h:i a"); ?>
                              </div>
                            </td>
                            <td>
                              <div class="badge badge-opacity-warning">
                                <?php $dateUpdate = date_create($row['updated_at']);
                                echo date_format($dateUpdate, "l, d M Y h:i a"); ?>
                              </div>
                            </td>
                            <td class="d-flex justify-content-center">
                              <div class="col">
                                <button type="button" class="btn btn-warning btn-sm rounded-0" style="height: 30px;" onclick="window.location.href='gereja?ubah=<?= $row['id_gereja'] ?>'">
                                  <i class="bi bi-pencil-square text-white"></i>
                                </button>
                              </div>
                              <div class="col">
                                <button type="button" class="btn btn-danger btn-sm rounded-0" style="height: 30px;margin-left: 10px;" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_gereja'] ?>">
                                  <i class="bi bi-trash3 text-white"></i>
                                </button>
                                <div class="modal fade" id="hapus<?= $row['id_gereja'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $row['nama_gereja'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        Anda yakin ingin menghapus gereja <?= $row['nama_gereja'] ?> ini?
                                      </div>
                                      <div class="modal-footer justify-content-center border-top-0">
                                        <button type="button" class="btn btn-secondary rounded-0 shadow border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                        <form action="" method="POST">
                                          <input type="hidden" name="id" value="<?= $row['id_gereja'] ?>">
                                          <input type="hidden" name="namaOld" value="<?= $row['nama_gereja'] ?>">
                                          <input type="hidden" name="imageOld" value="<?= $row['img_gereja'] ?>">
                                          <button type="submit" name="hapus-gereja" style="height: 30px;" class="btn btn-danger text-white rounded-0 shadow border-0">Hapus</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                      <?php $no++;
                        }
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
        <script>
          //<![CDATA[
          shortcut = {
            all_shortcuts: {},
            add: function(a, b, c) {
              var d = {
                type: "keydown",
                propagate: !1,
                disable_in_input: !1,
                target: document,
                keycode: !1
              };
              if (c)
                for (var e in d) "undefined" == typeof c[e] && (c[e] = d[e]);
              else c = d;
              d = c.target, "string" == typeof c.target && (d = document.getElementById(c.target)), a = a.toLowerCase(), e = function(d) {
                d = d || window.event;
                if (c.disable_in_input) {
                  var e;
                  d.target ? e = d.target : d.srcElement && (e = d.srcElement), 3 == e.nodeType && (e = e.parentNode);
                  if ("INPUT" == e.tagName || "TEXTAREA" == e.tagName) return
                }
                d.keyCode ? code = d.keyCode : d.which && (code = d.which), e = String.fromCharCode(code).toLowerCase(), 188 == code && (e = ","), 190 == code && (e = ".");
                var f = a.split("+"),
                  g = 0,
                  h = {
                    "`": "~",
                    1: "!",
                    2: "@",
                    3: "#",
                    4: "$",
                    5: "%",
                    6: "^",
                    7: "&",
                    8: "*",
                    9: "(",
                    0: ")",
                    "-": "_",
                    "=": "+",
                    ";": ":",
                    "'": '"',
                    ",": "<",
                    ".": ">",
                    "/": "?",
                    "\\": "|"
                  },
                  i = {
                    esc: 27,
                    escape: 27,
                    tab: 9,
                    space: 32,
                    "return": 13,
                    enter: 13,
                    backspace: 8,
                    scrolllock: 145,
                    scroll_lock: 145,
                    scroll: 145,
                    capslock: 20,
                    caps_lock: 20,
                    caps: 20,
                    numlock: 144,
                    num_lock: 144,
                    num: 144,
                    pause: 19,
                    "break": 19,
                    insert: 45,
                    home: 36,
                    "delete": 46,
                    end: 35,
                    pageup: 33,
                    page_up: 33,
                    pu: 33,
                    pagedown: 34,
                    page_down: 34,
                    pd: 34,
                    left: 37,
                    up: 38,
                    right: 39,
                    down: 40,
                    f1: 112,
                    f2: 113,
                    f3: 114,
                    f4: 115,
                    f5: 116,
                    f6: 117,
                    f7: 118,
                    f8: 119,
                    f9: 120,
                    f10: 121,
                    f11: 122,
                    f12: 123
                  },
                  j = !1,
                  l = !1,
                  m = !1,
                  n = !1,
                  o = !1,
                  p = !1,
                  q = !1,
                  r = !1;
                d.ctrlKey && (n = !0), d.shiftKey && (l = !0), d.altKey && (p = !0), d.metaKey && (r = !0);
                for (var s = 0; k = f[s], s < f.length; s++) "ctrl" == k || "control" == k ? (g++, m = !0) : "shift" == k ? (g++, j = !0) : "alt" == k ? (g++, o = !0) : "meta" == k ? (g++, q = !0) : 1 < k.length ? i[k] == code && g++ : c.keycode ? c.keycode == code && g++ : e == k ? g++ : h[e] && d.shiftKey && (e = h[e], e == k && g++);
                if (g == f.length && n == m && l == j && p == o && r == q && (b(d), !c.propagate)) return d.cancelBubble = !0, d.returnValue = !1, d.stopPropagation && (d.stopPropagation(), d.preventDefault()), !1
              }, this.all_shortcuts[a] = {
                callback: e,
                target: d,
                event: c.type
              }, d.addEventListener ? d.addEventListener(c.type, e, !1) : d.attachEvent ? d.attachEvent("on" + c.type, e) : d["on" + c.type] = e
            },
            remove: function(a) {
              var a = a.toLowerCase(),
                b = this.all_shortcuts[a];
              delete this.all_shortcuts[a];
              if (b) {
                var a = b.event,
                  c = b.target,
                  b = b.callback;
                c.detachEvent ? c.detachEvent("on" + a, b) : c.removeEventListener ? c.removeEventListener(a, b, !1) : c["on" + a] = !1
              }
            }
          }, shortcut.add("enter", function() {
            Swal.fire({
              icon: 'warning',
              title: 'Peringatan!',
              text: 'Anda tidak diperkenankan menggunakan fitur enter pada keyboard untuk mengisi deskripsi gereja.',
            })
          });
          //]]>
        </script>
</body>

</html>