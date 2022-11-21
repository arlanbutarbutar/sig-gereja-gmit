<?php
if (!isset($_SESSION['data-user'])) {
  function masuk($data)
  {
    global $conn;
    $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
    $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));

    // check account
    $checkAccount = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($checkAccount) == 0) {
      $_SESSION['message-danger'] = "Maaf, akun yang anda masukan belum terdaftar.";
      $_SESSION['time-message'] = time();
      return false;
    } else if (mysqli_num_rows($checkAccount) > 0) {
      $row = mysqli_fetch_assoc($checkAccount);
      if (password_verify($password, $row['password'])) {
        $_SESSION['data-user'] = [
          'id' => $row['id_user'],
          'email' => $row['email'],
          'username' => $row['username'],
        ];
      } else {
        $_SESSION['message-danger'] = "Maaf, kata sandi yang anda masukan salah.";
        $_SESSION['time-message'] = time();
        return false;
      }
    }
  }
}

if (isset($_SESSION['data-user'])) {
  function edit_profile($data)
  {
    global $conn, $idUser;
    $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['username']))));
    $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "UPDATE users SET username='$username', password='$password' WHERE id_user='$idUser'");
    return mysqli_affected_rows($conn);
  }
  function add_user($data)
  {
    global $conn;
    $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['username']))));
    $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
    $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($checkEmail) > 0) {
      $_SESSION['message-danger'] = "Maaf, email yang anda masukan sudah terdaftar.";
      $_SESSION['time-message'] = time();
      return false;
    }
    $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users(username,email,password) VALUES('$username','$email','$password')");
    return mysqli_affected_rows($conn);
  }
  function edit_user($data)
  {
    global $conn, $time;
    $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
    $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['username']))));
    $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
    $emailOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['emailOld']))));
    if ($email != $emailOld) {
      $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
      if (mysqli_num_rows($checkEmail) > 0) {
        $_SESSION['message-danger'] = "Maaf, email yang anda masukan sudah terdaftar.";
        $_SESSION['time-message'] = time();
        return false;
      }
    }
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "UPDATE users SET username='$username', email='$email', updated_at='$updated_at' WHERE id_user='$id_user'");
    return mysqli_affected_rows($conn);
  }
  function delete_user($data)
  {
    global $conn;
    $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
    mysqli_query($conn, "DELETE FROM users WHERE id_user='$id_user'");
    return mysqli_affected_rows($conn);
  }
  function image($route_dir)
  {
    $namaFile = $_FILES["image"]["name"];
    $ukuranFile = $_FILES["image"]["size"];
    $error = $_FILES["image"]["error"];
    $tmpName = $_FILES["image"]["tmp_name"];
    if ($error === 4) {
      $_SESSION['message-danger'] = "Pilih gambar terlebih dahulu!";
      $_SESSION['time-message'] = time();
      return false;
    }
    $ekstensiGambarValid = ['jpg', 'png', 'jpeg', 'heic'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
      $_SESSION['message-danger'] = "Maaf, file kamu bukan gambar!";
      $_SESSION['time-message'] = time();
      return false;
    }
    if ($ukuranFile > 2000000) {
      $_SESSION['message-danger'] = "Maaf, ukuran gambar terlalu besar! (2 MB)";
      $_SESSION['time-message'] = time();
      return false;
    }
    $namaFile_encrypt = crc32($namaFile);
    $encrypt = $namaFile_encrypt . "." . $ekstensiGambar;
    move_uploaded_file($tmpName, '../assets/img/' . $route_dir . '/' . $encrypt);
    return $encrypt;
  }
  function add_fasilitas($data)
  {
    global $conn;
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $checkNama = mysqli_query($conn, "SELECT * FROM fasilitas WHERE nama_fasilitas='$nama'");
    if (mysqli_num_rows($checkNama) > 0) {
      $_SESSION['message-danger'] = "Maaf, nama fasilitas sudah ada.";
      $_SESSION['time-message'] = time();
      return false;
    }
    $deskripsi = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['deskripsi']))));
    $route_dir = "fasilitas";
    $image = image($route_dir);
    if (!$image) {
      return false;
    }
    mysqli_query($conn, "INSERT INTO fasilitas(img_fasilitas,nama_fasilitas,deskripsi_fasilitas) VALUES('$image','$nama','$deskripsi')");
    return mysqli_affected_rows($conn);
  }
  function edit_fasilitas($data)
  {
    global $conn, $time;
    $id = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id']))));
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $namaOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['namaOld']))));
    if ($nama != $namaOld) {
      $checkNama = mysqli_query($conn, "SELECT * FROM fasilitas WHERE nama_fasilitas='$nama'");
      if (mysqli_num_rows($checkNama) > 0) {
        $_SESSION['message-danger'] = "Maaf, nama fasilitas sudah ada.";
        $_SESSION['time-message'] = time();
        return false;
      }
    }
    $deskripsi = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['deskripsi']))));
    $route_dir = "fasilitas";
    $imageOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['imageOld']))));
    if (!empty($_FILES['image']["name"])) {
      $image = image($route_dir);
      if (!$image) {
        return false;
      } else {
        unlink('../assets/img/fasilitas/' . $imageOld);
      }
    } else {
      $image = $imageOld;
    }
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "UPDATE fasilitas SET img_fasilitas='$image', nama_fasilitas='$nama', deskripsi_fasilitas='$deskripsi', updated_at='$updated_at' WHERE id_fasilitas='$id'");
    return mysqli_affected_rows($conn);
  }
  function delete_fasilitas($data)
  {
    global $conn;
    $id = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id']))));
    $imageOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['imageOld']))));
    unlink("../assets/img/fasilitas/" . $imageOld);
    mysqli_query($conn, "DELETE FROM fasilitas WHERE id_fasilitas='$id'");
    return mysqli_affected_rows($conn);
  }
  function add_gereja($data)
  {
    global $conn;
    $dataID = mysqli_query($conn, "SELECT * FROM gereja ORDER BY id_gereja DESC LIMIT 1");
    if (mysqli_num_rows($dataID) > 0) {
      $row = mysqli_fetch_assoc($dataID);
      $id = $row['id_gereja'] + 1;
    } else if (mysqli_num_rows($dataID) == 0) {
      $id = 1;
    }
    $id_fasilitas = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-fasilitas']))));
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $checkNama = mysqli_query($conn, "SELECT * FROM gereja WHERE nama_gereja='$nama'");
    if (mysqli_num_rows($checkNama) > 0) {
      $_SESSION['message-danger'] = "Maaf, nama gereja sudah ada.";
      $_SESSION['time-message'] = time();
      return false;
    }
    $deskripsi = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['deskripsi']))));
    $jemaat = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jemaat']))));
    $alamat = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['alamat']))));
    $telp = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['telp']))));
    $latitude = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['latitude']))));
    $longitude = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['longitude']))));
    $route_dir = "gereja";
    $image = image($route_dir);
    if (!$image) {
      return false;
    }
    mysqli_query($conn, "INSERT INTO gereja(id_gereja,img_gereja,nama_gereja,deskripsi_gereja,jumlah_jemaat,alamat,telp,latitude,longitude) VALUES('$id','$image','$nama','$deskripsi','$jemaat','$alamat','$telp','$latitude','$longitude')");
    mysqli_query($conn, "INSERT INTO fasilitas_gereja(id_gereja,id_fasilitas) VALUES('$id','$id_fasilitas')");
    return mysqli_affected_rows($conn);
  }
  function add_fasilitas_gereja($data)
  {
    global $conn, $time;
    $id = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id']))));
    $id_fasilitas = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-fasilitas']))));
    $checkFasilitas = mysqli_query($conn, "SELECT * FROM fasilitas_gereja WHERE id_gereja='$id' AND id_fasilitas='$id_fasilitas'");
    if (mysqli_num_rows($checkFasilitas) > 0) {
      $_SESSION['message-danger'] = "Maaf, fasilitas gereja yang anda pilih sudah di checklist! Silakan pilih fasilitas yang lain.";
      $_SESSION['time-message'] = time();
      return false;
    }
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "INSERT INTO fasilitas_gereja(id_gereja,id_fasilitas) VALUES('$id','$id_fasilitas')");
    mysqli_query($conn, "UPDATE gereja SET updated_at='$updated_at' WHERE id_gereja='$id'");
    return mysqli_affected_rows($conn);
  }
  function delete_fasilitas_gereja($data)
  {
    global $conn, $time;
    $id = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id']))));
    $id_gereja = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-gereja']))));
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "DELETE FROM fasilitas_gereja WHERE id_fasilitas_gereja='$id'");
    mysqli_query($conn, "UPDATE gereja SET updated_at='$updated_at' WHERE id_gereja='$id_gereja'");
    return mysqli_affected_rows($conn);
  }
  function edit_gereja($data)
  {
    global $conn, $time;
    $id = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id']))));
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $namaOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['namaOld']))));
    if ($nama != $namaOld) {
      $checkNama = mysqli_query($conn, "SELECT * FROM gereja WHERE nama_gereja='$nama'");
      if (mysqli_num_rows($checkNama) > 0) {
        $_SESSION['message-danger'] = "Maaf, nama gereja sudah ada.";
        $_SESSION['time-message'] = time();
        return false;
      }
    }
    $deskripsi = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['deskripsi']))));
    $jemaat = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jemaat']))));
    $alamat = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['alamat']))));
    $telp = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['telp']))));
    $latitude = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['latitude']))));
    $longitude = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['longitude']))));
    $route_dir = "gereja";
    $imageOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['imageOld']))));
    if (!empty($_FILES['image']["name"])) {
      $image = image($route_dir);
      if (!$image) {
        return false;
      } else {
        unlink('../assets/img/gereja/' . $imageOld);
      }
    } else {
      $image = $imageOld;
    }
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "UPDATE gereja SET img_gereja='$image', nama_gereja='$nama', deskripsi_gereja='$deskripsi', jumlah_jemaat='$jemaat', alamat='$alamat', telp='$telp', latitude='$latitude', longitude='$longitude', updated_at='$updated_at' WHERE id_gereja='$id'");
    return mysqli_affected_rows($conn);
  }
  function delete_gereja($data)
  {
    global $conn;
    $id = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id']))));
    $imageOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['imageOld']))));
    unlink("../assets/img/gereja/" . $imageOld);
    mysqli_query($conn, "DELETE FROM fasilitas_gereja WHERE id_gereja='$id'");
    mysqli_query($conn, "DELETE FROM gereja WHERE id_gereja='$id'");
    return mysqli_affected_rows($conn);
  }
  function add_pendeta($data)
  {
    global $conn;
    $id_gereja = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-gereja']))));
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $checkNama = mysqli_query($conn, "SELECT * FROM pendeta WHERE nama_pendeta='$nama'");
    if (mysqli_num_rows($checkNama) > 0) {
      $_SESSION['message-danger'] = "Maaf, nama pendeta sudah ada.";
      $_SESSION['time-message'] = time();
      return false;
    }
    $telp = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['telp']))));
    $status = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['status']))));
    $route_dir = "pendeta";
    if (!empty($_FILES['image']["name"])) {
      $image = image($route_dir);
      if (!$image) {
        return false;
      }
    } else {
      $image = "user.png";
    }
    mysqli_query($conn, "INSERT INTO pendeta(id_gereja,img_pendeta,nama_pendeta,telp,status) VALUES('$id_gereja','$image','$nama','$telp','$status')");
    return mysqli_affected_rows($conn);
  }
  function edit_pendeta($data)
  {
    global $conn, $time;
    $id = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id']))));
    $id_gereja = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-gereja']))));
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $namaOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['namaOld']))));
    if ($nama != $namaOld) {
      $checkNama = mysqli_query($conn, "SELECT * FROM pendeta WHERE nama_pendeta='$nama'");
      if (mysqli_num_rows($checkNama) > 0) {
        $_SESSION['message-danger'] = "Maaf, nama pendeta sudah ada.";
        $_SESSION['time-message'] = time();
        return false;
      }
    }
    $telp = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['telp']))));
    $status = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['status']))));
    $route_dir = "pendeta";
    $imageOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['imageOld']))));
    if (!empty($_FILES['image']["name"])) {
      $image = image($route_dir);
      if (!$image) {
        return false;
      } else {
        if ($imageOld != "user.png") {
          unlink('../assets/img/pendeta/' . $imageOld);
        }
      }
    } else {
      $image = $imageOld;
    }
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "UPDATE pendeta SET id_gereja='$id_gereja', img_pendeta='$image', nama_pendeta='$nama', telp='$telp', status='$status', updated_at='$updated_at' WHERE id_pendeta='$id'");
    return mysqli_affected_rows($conn);
  }
  function delete_pendeta($data)
  {
    global $conn;
    $id = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id']))));
    $imageOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['imageOld']))));
    if ($imageOld != "user.png") {
      unlink('../assets/img/pendeta/' . $imageOld);
    }
    mysqli_query($conn, "DELETE FROM pendeta WHERE id_pendeta='$id'");
    return mysqli_affected_rows($conn);
  }
}
