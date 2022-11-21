<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION['page-name'] = "Fasilitas";
$_SESSION['page-url'] = "fasilitas";
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
                  <div>
                    <div class="btn-wrapper">
                      <a href="#" class="btn btn-primary text-white me-0 btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#tambah-fasilitas">Tambah</a>
                    </div>
                  </div>
                </div>
                <div class="card rounded-0 mt-3">
                  <div class="card-body table-responsive">
                    <table class="table table-striped table-hover table-borderless table-sm text-center display" id="datatable">
                      <thead>
                        <tr>
                          <th scope="col" class="text-center">#</th>
                          <th scope="col" class="text-center">Nama Fasilitas</th>
                          <th scope="col" class="text-center">Deskripsi</th>
                          <th scope="col" class="text-center">Tgl buat</th>
                          <th scope="col" class="text-center">Tgl ubah</th>
                          <th scope="col" class="text-center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (mysqli_num_rows($fasilitas) > 0) {
                          $no = 1;
                          while ($row = mysqli_fetch_assoc($fasilitas)) { ?>
                            <tr>
                              <th scope="row"><?= $no; ?></th>
                              <td>
                                <div class="d-flex ">
                                  <img src="../assets/img/fasilitas/<?= $row['img_fasilitas'] ?>" alt="" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#img-fasilitas<?= $row['id_fasilitas'] ?>">
                                  <div class="modal fade" id="img-fasilitas<?= $row['id_fasilitas'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header border-bottom-0 shadow">
                                          <h5 class="modal-title" id="exampleModalLabel"><?= $row['nama_fasilitas'] ?></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                          <img src="../assets/img/fasilitas/<?= $row['img_fasilitas'] ?>" class="rounded-0" style="width: 100%;height: 100%;" alt="">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="m-auto">
                                    <h6 style="margin-left: 10px;"><?= $row['nama_fasilitas'] ?></h6>
                                  </div>
                                </div>
                              </td>
                              <td><?= $row['deskripsi_fasilitas'] ?></td>
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
                                  <button type="button" onclick="window.location.href='gereja?id-fasilitas=<?= $row['id_fasilitas'] ?>'" class="btn btn-success btn-sm rounded-0 text-white" style="height: 30px;"><i class="bi bi-plus-lg"></i> Gereja</button>
                                </div>
                                <div class="col">
                                  <button type="button" class="btn btn-warning btn-sm rounded-0" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_fasilitas'] ?>">
                                    <i class="bi bi-pencil-square text-white"></i>
                                  </button>
                                  <div class="modal fade" id="ubah<?= $row['id_fasilitas'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header border-bottom-0 shadow">
                                          <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $row['nama_fasilitas'] ?></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                          <div class="modal-body">
                                            <div class="mb-3">
                                              <label for="image" class="form-label">Upload Foto Fasilitas</label>
                                              <input class="form-control" name="image" type="file" id="image">
                                            </div>
                                            <div class="mb-3">
                                              <label for="nama" class="form-label">Nama Fasilitas</label>
                                              <input type="text" name="nama" value="<?= $row['nama_fasilitas'] ?>" class="form-control text-center" id="nama" placeholder="Nama Fasilitas" required>
                                            </div>
                                            <div class="mb-3">
                                              <label for="deskripsi" class="form-label">Deskripsi</label>
                                              <textarea class="form-control" name="deskrispi" id="deskripsi" rows="3" style="height: 100px;"><?= $row['deskripsi_fasilitas'] ?></textarea>
                                            </div>
                                          </div>
                                          <div class="modal-footer justify-content-center border-top-0">
                                            <input type="hidden" name="id" value="<?= $row['id_fasilitas'] ?>">
                                            <input type="hidden" name="namaOld" value="<?= $row['nama_fasilitas'] ?>">
                                            <input type="hidden" name="imageOld" value="<?= $row['img_fasilitas'] ?>">
                                            <button type="button" class="btn btn-secondary rounded-0 shadow border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" name="ubah-fasilitas" class="btn btn-warning rounded-0 shadow border-0" style="height: 30px;">Ubah</button>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col">
                                  <button type="button" class="btn btn-danger btn-sm rounded-0" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_fasilitas'] ?>">
                                    <i class="bi bi-trash3 text-white"></i>
                                  </button>
                                  <div class="modal fade" id="hapus<?= $row['id_fasilitas'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header border-bottom-0 shadow">
                                          <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $row['nama_fasilitas'] ?></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          Anda yakin ingin menghapus fasilitas <?= $row['nama_fasilitas'] ?> ini?
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <button type="button" class="btn btn-secondary rounded-0 shadow border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                          <form action="" method="POST">
                                            <input type="hidden" name="id" value="<?= $row['id_fasilitas'] ?>">
                                            <input type="hidden" name="namaOld" value="<?= $row['nama_fasilitas'] ?>">
                                            <input type="hidden" name="imageOld" value="<?= $row['img_fasilitas'] ?>">
                                            <button type="submit" name="hapus-fasilitas" style="height: 30px;" class="btn btn-danger text-white rounded-0 shadow border-0">Hapus</button>
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
        </div>

        <div class="modal fade" id="tambah-fasilitas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header border-bottom-0 shadow">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Fasilitas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="" method="post" name="random_form" enctype="multipart/form-data">
                <div class="modal-body text-center">
                  <div class="mb-3">
                    <label for="image" class="form-label">Upload Foto Fasilitas</label>
                    <input class="form-control" name="image" type="file" id="image" required>
                  </div>
                  <div class="mb-3">
                    <label for="nama" class="form-label">Nama Fasilitas</label>
                    <input type="text" name="nama" value="<?php if (isset($_POST['nama'])) {
                                                            echo $_POST['nama'];
                                                          } ?>" class="form-control text-center" id="nama" placeholder="Nama Fasilitas" required>
                  </div>
                  <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" style="height: 100px;"><?php if (isset($_POST['deskripsi'])) {
                                                                                                                      echo $_POST['deskripsi'];
                                                                                                                    } ?></textarea>
                  </div>
                </div>
                <div class="modal-footer border-top-0 justify-content-center">
                  <button type="button" class="btn btn-secondary border-0 shadow rounded-0" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" name="tambah-fasilitas" class="btn btn-primary border-0 shadow rounded-0">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>