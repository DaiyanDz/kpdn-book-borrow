<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="tempahan_admin.php">AdminPanel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link" href="tempahan_admin.php">Tempahan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pinjam_admin.php">Pinjaman</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_accounts.php">Admin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="users_accounts.php">Pengguna</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="messages.php">Mesej</a>
        </li>

        <?php if(isset($_SESSION["admin_id"])){ ?>
          <li class="nav-item dropdown float-right">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-user"></i>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="update_profile.php">Kemaskini Profil</a></li>
            <li><a class="dropdown-item" href="../components/admin_logout.php" onclick="return confirm('Log Keluar?');">Log Keluar</a></li>
          </ul>
        </li>
        <?php } ?>
      
      </ul>

    </div>
  </div>
</nav>