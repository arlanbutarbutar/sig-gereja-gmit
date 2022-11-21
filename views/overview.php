<?php require_once("../controller/script.php"); ?>

<div class="row">
  <div class="col-sm-12 mt-3 m-0 p-0">
    <div class="statistics-details d-flex align-items-center justify-content-between">
      <div class="rounded-0 p-4 m-3 ml-0 w-100 shadow" style="background-color: #0283be;">
        <p class="statistics-title text-white">Users</p>
        <h3 class="rate-percentage text-white"><?= $countUsers; ?></h3>
        <p class="text-danger d-flex">
          <a href="users" class="text-white text-decoration-none">
            <i class="mdi mdi-eye"></i><span> Lihat</span>
          </a>
        </p>
      </div>
      <div class="rounded-0 p-4 m-3 w-100 shadow" style="background-color: #0283be;">
        <p class="statistics-title text-white">Fasilitas</p>
        <h3 class="rate-percentage text-white"><?= $countFasilitas; ?></h3>
        <p class="text-danger d-flex">
          <a href="fasilitas" class="text-white text-decoration-none">
            <i class="mdi mdi-eye"></i><span> Lihat</span>
          </a>
        </p>
      </div>
      <div class="rounded-0 p-4 m-3 w-100 shadow" style="background-color: #0283be;">
        <p class="statistics-title text-white">Gereja</p>
        <h3 class="rate-percentage text-white"><?= $countGereja; ?></h3>
        <p class="text-danger d-flex">
          <a href="gereja" class="text-white text-decoration-none">
            <i class="mdi mdi-eye"></i><span> Lihat</span>
          </a>
        </p>
      </div>
      <div class="rounded-0 p-4 m-3 w-100 shadow" style="background-color: #0283be;">
        <p class="statistics-title text-white">Pendeta</p>
        <h3 class="rate-percentage text-white"><?= $countPendeta; ?></h3>
        <p class="text-danger d-flex">
          <a href="pendeta" class="text-white text-decoration-none">
            <i class="mdi mdi-eye"></i><span> Lihat</span>
          </a>
        </p>
      </div>
    </div>
  </div>
</div>
<div class="row" id="pemesanan">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card rounded-0 shadow" style="margin-top: -40px;">
      <div class="card-body">
        <div class="d-sm-flex justify-content-between align-items-start">
          <div>
            <h4 class="card-title card-title-dash">Gereja GMIT</h4>
            <p class="card-subtitle card-subtitle-dash">Lihat semua data lengkap tentang Gereja GMIT</p>
          </div>
        </div>
        <div class="table-responsive mt-1">
          <table class="table table-striped table-hover table-borderless table-sm text-center display" id="datatable">
            <thead class="text-center">
              <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Nama Gereja</th>
                <th scope="col" class="text-center">Pendeta</th>
                <th scope="col" class="text-center">Deskripsi</th>
                <th scope="col" class="text-center">Fasilitas</th>
                <th scope="col" class="text-center">Jemaat</th>
                <th scope="col" class="text-center">Alamat</th>
                <th scope="col" class="text-center">Telp</th>
                <th scope="col" class="text-center">Lokasi</th>
                <th scope="col" class="text-center">Tgl buat</th>
                <th scope="col" class="text-center">Tgl ubah</th>
              </tr>
            </thead>
            <tbody>
              <?php if (mysqli_num_rows($dataAGereja) > 0) {
                $no = 1;
                while ($row = mysqli_fetch_assoc($dataAGereja)) { ?>
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
                      <?php $id_gereja = $row['id_gereja'];
                      $takePendeta = mysqli_query($conn, "SELECT * FROM pendeta JOIN gereja ON pendeta.id_gereja=gereja.id_gereja WHERE gereja.id_gereja='$id_gereja'");
                      while ($row_tp = mysqli_fetch_assoc($takePendeta)) { ?>
                        <div class="d-flex">
                          <p>
                            <i class="mdi mdi-check"></i> <?= $row_tp['nama_pendeta'] ?>
                          </p>
                        </div>
                      <?php } ?>
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
                        </div>
                      <?php } ?>
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

<script src="../assets/datatable/datatables.js"></script>
<script>
  $(document).ready(function() {
    $('#datatable').DataTable();
  });
</script>
<script>
  (function() {
    function scrollH(e) {
      e.preventDefault();
      e = window.event || e;
      let delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
      document.querySelector('.table-responsive').scrollLeft -= (delta * 40);
    }
    if (document.querySelector('.table-responsive').addEventListener) {
      document.querySelector('.table-responsive').addEventListener('mousewheel', scrollH, false);
      document.querySelector('.table-responsive').addEventListener('DOMMouseScroll', scrollH, false);
    }
  })();
</script>