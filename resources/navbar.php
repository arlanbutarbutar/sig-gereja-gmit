<header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <nav class="main-nav">
          <!-- ***** Logo Start ***** -->
          <a href="./" class="logo">
            <img src="assets/img/logo-gmit.png" alt="Logo" style="width: 70px;padding-bottom: 20px;">
          </a>
          <!-- ***** Logo End ***** -->
          <!-- ***** Menu Start ***** -->
          <ul class="nav">
            <li class="scroll-to-section"><a href="./#top" <?php if ($_SESSION['page-name'] == "Beranda") {
                                                              echo " class='active'";
                                                            } ?>>Beranda</a></li>
            <li class="scroll-to-section"><a href="profil" <?php if ($_SESSION['page-name'] == "Profil") {
                                                                echo " class='active'";
                                                              } ?>>Profil</a></li>
            <li class="scroll-to-section"><a href="gereja" <?php if ($_SESSION['page-name'] == "Gereja") {
                                                              echo " class='active'";
                                                            } ?>>Gereja</a></li>
            <li class="scroll-to-section"><a href="lokasi" <?php if ($_SESSION['page-name'] == "Lokasi") {
                                                              echo " class='active'";
                                                            } ?>>Lokasi</a></li>
            <li class="scroll-to-section"><a href="database-gmit" <?php if ($_SESSION['page-name'] == "Database GMIT") {
                                                              echo " class='active'";
                                                            } ?>>Database GMIT</a></li>
            <style>
              .mobile-view {
                display: none;
              }

              @media screen and (max-width: 400px) {
                .mobile-view {
                  display: block;
                }
              }
            </style>
            <li class="scroll-to-section mobile-view"><a href="auth/">Masuk</a></li>
            <li class="scroll-to-section">
              <div class="main-red-button"><a href="auth/">Masuk</a></div>
            </li>
          </ul>
          <a class='menu-trigger'>
            <span>Menu</span>
          </a>
          <!-- ***** Menu End ***** -->
        </nav>
      </div>
    </div>
  </div>
</header>