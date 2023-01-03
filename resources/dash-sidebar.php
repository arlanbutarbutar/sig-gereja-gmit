<nav class="sidebar sidebar-offcanvas shadow" style="background-color: rgb(3, 164, 237);" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='./'">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <?php if ($_SESSION['data-user']['role'] != 2) { ?>
      <li class="nav-item nav-category">Kelola Pengguna</li>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='users'">
          <i class="mdi mdi-account-multiple-outline menu-icon"></i>
          <span class="menu-title">Users</span>
        </a>
      </li>
    <?php } ?>
    <li class="nav-item nav-category">Data SIG</li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='fasilitas'">
        <i class="mdi mdi-sort-variant menu-icon"></i>
        <span class="menu-title">Fasilitas</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='gereja'">
        <i class="mdi mdi-church menu-icon"></i>
        <span class="menu-title">Gereja</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='pendeta'">
        <i class="mdi mdi-account-star menu-icon"></i>
        <span class="menu-title">Pendeta</span>
      </a>
    </li>
    <li class="nav-item nav-category"></li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='../auth/signout'">
        <i class="mdi mdi-logout-variant menu-icon"></i>
        <span class="menu-title">Keluar</span>
      </a>
    </li>
  </ul>
</nav>