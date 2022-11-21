<?php
error_reporting(~E_NOTICE & ~E_DEPRECATED);
if (!isset($_SESSION[''])) {
  session_start();
}
require_once("db_connect.php");
require_once("time.php");
require_once("functions.php");
if (isset($_SESSION['time-message'])) {
  if ((time() - $_SESSION['time-message']) > 2) {
    if (isset($_SESSION['message-success'])) {
      unset($_SESSION['message-success']);
    }
    if (isset($_SESSION['message-info'])) {
      unset($_SESSION['message-info']);
    }
    if (isset($_SESSION['message-warning'])) {
      unset($_SESSION['message-warning']);
    }
    if (isset($_SESSION['message-danger'])) {
      unset($_SESSION['message-danger']);
    }
    if (isset($_SESSION['message-dark'])) {
      unset($_SESSION['message-dark']);
    }
    unset($_SESSION['time-alert']);
  }
}

$baseURL = "http://$_SERVER[HTTP_HOST]/apps/sig-gereja-gmit/";
// $baseIP = $_SERVER['REMOTE_ADDR'];
$baseIP = "180.249.166.96";
$geoJSON = json_decode(file_get_contents("https://ipinfo.io/{$baseIP}/json"));

$frontPendeta = mysqli_query($conn, "SELECT * FROM pendeta JOIN gereja ON pendeta.id_gereja=gereja.id_gereja ORDER BY pendeta.id_pendeta DESC LIMIT 4");
$frontUGereja = mysqli_query($conn, "SELECT * FROM gereja ORDER By id_gereja DESC LIMIT 1");
$frontGereja = mysqli_query($conn, "SELECT * FROM gereja ORDER By id_gereja DESC LIMIT 1,2");
$frontAGereja = mysqli_query($conn, "SELECT * FROM gereja ORDER By id_gereja DESC LIMIT 3, 500");
$select_locationMaps = mysqli_query($conn, "SELECT * FROM gereja");

if (isset($_POST['cari-gereja'])) {
  $keyword = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['nama-gereja']))));
  $url = $keyword;
  $url = str_replace(" ", "-", $url);
  header("Location: gereja?namanya=" . $url);
  exit();
}

$frontFasilitas=mysqli_query($conn, "SELECT * FROM fasilitas");

if (!isset($_SESSION['data-user'])) {
  if (isset($_POST['masuk'])) {
    if (masuk($_POST) > 0) {
      header("Location: ../views/");
      exit();
    }
  }
}

if (isset($_SESSION['data-user'])) {
  $idUser = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-user']['id']))));
  if (!isset($_GET['id-fasilitas'])) {
    $selectFasilitas = mysqli_query($conn, "SELECT * FROM fasilitas ORDER BY nama_fasilitas ASC");
  } else if (isset($_GET['id-fasilitas'])) {
    $id = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['id-fasilitas']))));
    $selectFasilitas = mysqli_query($conn, "SELECT * FROM fasilitas WHERE id_fasilitas!='$id' ORDER BY nama_fasilitas ASC");
    $selectCheckFasilitas = mysqli_query($conn, "SELECT * FROM fasilitas WHERE id_fasilitas='$id' ORDER BY nama_fasilitas ASC");
  }
  $countUsers=mysqli_query($conn, "SELECT * FROM users WHERE id_user!='$idUser'");
  $countUsers=mysqli_num_rows($countUsers);
  $countFasilitas=mysqli_query($conn, "SELECT * FROM fasilitas");
  $countFasilitas=mysqli_num_rows($countFasilitas);
  $countGereja=mysqli_query($conn, "SELECT * FROM gereja");
  $countGereja=mysqli_num_rows($countGereja);
  $countPendeta=mysqli_query($conn, "SELECT * FROM pendeta");
  $countPendeta=mysqli_num_rows($countPendeta);
  $dataAGereja=mysqli_query($conn, "SELECT * FROM gereja ORDER BY id_gereja DESC");

  $profile = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$idUser'");
  if (isset($_POST['ubah-profile'])) {
    if (edit_profile($_POST) > 0) {
      $_SESSION['message-success'] = "Profil akun anda berhasil di ubah.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }

  $users = mysqli_query($conn, "SELECT * FROM users WHERE id_user!='$idUser' ORDER BY id_user DESC");
  if (isset($_POST['tambah-user'])) {
    if (add_user($_POST) > 0) {
      $_SESSION['message-success'] = "Pengguna " . $_POST['username'] . " berhasil ditambahkan.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['ubah-user'])) {
    if (edit_user($_POST) > 0) {
      $_SESSION['message-success'] = "Pengguna " . $_POST['usernameOld'] . " berhasil diubah.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['hapus-user'])) {
    if (delete_user($_POST) > 0) {
      $_SESSION['message-success'] = "Pengguna " . $_POST['username'] . " berhasil dihapus.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }

  $fasilitas = mysqli_query($conn, "SELECT * FROM fasilitas ORDER BY id_fasilitas DESC");
  if (isset($_POST['tambah-fasilitas'])) {
    if (add_fasilitas($_POST) > 0) {
      $_SESSION['message-success'] = "Nama fasilitas berhasil ditambahkan.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['ubah-fasilitas'])) {
    if (edit_fasilitas($_POST) > 0) {
      $_SESSION['message-success'] = "Nama fasilitas " . $_POST['namaOld'] . " berhasil diubah.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['hapus-fasilitas'])) {
    if (delete_fasilitas($_POST) > 0) {
      $_SESSION['message-success'] = "Nama fasilitas " . $_POST['namaOld'] . " berhasil dihapus.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }

  $gereja = mysqli_query($conn, "SELECT * FROM gereja ORDER BY gereja.id_gereja DESC");
  if (isset($_POST['tambah-gereja'])) {
    if (add_gereja($_POST) > 0) {
      $_SESSION['message-success'] = "Nama gereja berhasil ditambahkan.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['tambah-fasilitas-gereja'])) {
    if (add_fasilitas_gereja($_POST) > 0) {
      $_SESSION['message-success'] = "Fasilitas gereja " . $_POST['namaOld'] . " berhasil ditambahkan.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['hapus-fasilitas-gereja'])) {
    if (delete_fasilitas_gereja($_POST) > 0) {
      $_SESSION['message-success'] = "Fasilitas gereja " . $_POST['namaOld'] . " berhasil dihapus.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['ubah-gereja'])) {
    if (edit_gereja($_POST) > 0) {
      $_SESSION['message-success'] = "Nama gereja " . $_POST['namaOld'] . " berhasil diubah.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['hapus-gereja'])) {
    if (delete_gereja($_POST) > 0) {
      $_SESSION['message-success'] = "Nama gereja " . $_POST['namaOld'] . " berhasil dihapus.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }

  $selectGereja = mysqli_query($conn, "SELECT * FROM gereja");
  $pendeta = mysqli_query($conn, "SELECT pendeta.id_pendeta, pendeta.id_gereja, pendeta.img_pendeta, pendeta.nama_pendeta, pendeta.telp, pendeta.status, pendeta.created_at, pendeta.updated_at, gereja.nama_gereja FROM pendeta JOIN gereja ON pendeta.id_gereja=gereja.id_gereja ORDER BY pendeta.id_pendeta DESC");
  if (isset($_POST['tambah-pendeta'])) {
    if (add_pendeta($_POST) > 0) {
      $_SESSION['message-success'] = "Nama pendeta berhasil ditambahkan.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['ubah-pendeta'])) {
    if (edit_pendeta($_POST) > 0) {
      $_SESSION['message-success'] = "Nama pendeta " . $_POST['namaOld'] . " berhasil diubah.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['hapus-pendeta'])) {
    if (delete_pendeta($_POST) > 0) {
      $_SESSION['message-success'] = "Nama pendeta " . $_POST['namaOld'] . " berhasil dihapus.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
}
