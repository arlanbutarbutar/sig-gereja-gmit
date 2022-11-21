
      <?php 
        // Ubah sesuai Web Server Local yang kalian gunakan
        // Sebagai contoh Web Server XAMPP, kalian ubah password dan nama database sesuai yang ada di XAMPP kalian

        $conn=mysqli_connect("localhost","root","","sig_gereja_gmit");
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);}
    