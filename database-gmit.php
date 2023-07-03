<?php require_once("controller/script.php");
$_SESSION['page-name'] = "Database GMIT";
$_SESSION['page-url'] = "database-gmit";
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

  <embed src="https://app.powerbi.com/view?r=eyJrIjoiNmQ5NzEzYmYtZmNlYS00NzE1LWFlYTUtZjA4YWQ3NWQyNDExIiwidCI6IjAxMDk3NzYyLWQ0YjAtNDRmMy1iOWYwLTk5MTUzYWRkYmUzOSIsImMiOjEwfQ%3D%3D&pageName=ReportSection4fda3dd853e307265c08" style="margin-top: 100px;width: 100%;height: 100vh;" type="">

  <?php require_once("resources/footer.php"); ?>
</body>

</html>