<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

      <a href="tempahan_admin.php" class="logo" title="Laman">Admin<span>Panel</span></a>

      <nav class="navbar">
         <!-- <a href="dashboard.php">Laman Utama</a> -->
         <a href="tempahan_admin.php" title="Rekod Tempahan">Tempahan</a>
         <a href="pinjam_admin.php" title="Rekod Pinjaman">Pinjaman</a>
         <a href="admin_accounts.php" title="Senarai Akaun Admin">Admin</a>
         <a href="users_accounts.php" title="Senarai Akaun Pengguna">Pengguna</a>
         <a href="messages.php">Mesej</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user" title="Profil Admin"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn">Kemaskini Profil</a>
         <div class="flex-btn">
            <a href="admin_login.php" class="option-btn">Log Masuk</a>
            <a href="register_admin.php" class="option-btn">Daftar Admin</a>
         </div>
         <a href="../components/admin_logout.php" onclick="return confirm('Log Keluar?');" class="delete-btn">Log Keluar</a>
      </div>

   </section>

</header>