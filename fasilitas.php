<?php require_once("controller/script.php");
$_SESSION['page-name'] = "Fasilitas";
$_SESSION['page-url'] = "fasilitas";
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
                <h2>Fasilitas Gereja <em>GMIT</em></h2>
                <div class="main-blue-button mt-3">
                  <a href="#fasilitas">Lihat Fasilitas</a>
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

  <div id="fasilitas" class="about-us section">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="left-image wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
            <img src="assets/img/about-left-image.png" style="width: 100%;" alt="person graphic">
          </div>
        </div>
        <div class="col-lg-7 align-self-center">
          <div class="services">
            <div class="row" style="height: 350px;overflow-y: auto;">
              <div class="col-md-12">
                <h2 class="mb-3">Fasilitas</h2>
              </div>
              <?php if (mysqli_num_rows($frontFasilitas) > 0) {
                while ($data = mysqli_fetch_assoc($frontFasilitas)) { ?>
                  <div class="col-lg-6">
                    <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                      <div class="icon">
                        <img src="assets/img/fasilitas/<?= $data['img_fasilitas'] ?>" class="rounded-circle" style="background-size: cover;object-fit: cover;height: 70px;cursor: pointer;" alt="Image Fasilitas" data-bs-toggle="modal" data-bs-target="#image<?= $data['id_fasilitas'] ?>">
                      </div>
                      <div class="right-text">
                        <h4><?= $data['nama_fasilitas'] ?></h4>
                        <p><?= $data['deskripsi_fasilitas'] ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="modal fade" id="image<?= $data['id_fasilitas'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 sahdow">
                          <h5 class="modal-title" id="exampleModalLabel"><?= $data['nama_fasilitas'] ?></h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                          <img src="assets/img/fasilitas/<?= $data['img_fasilitas'] ?>" style="background-size: cover;object-fit: cover;" alt="Image Fasilitas">
                        </div>
                      </div>
                    </div>
                  </div>
              <?php }
              } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php require_once("resources/footer.php"); ?>
</body>

</html>