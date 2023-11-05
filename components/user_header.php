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

      <a href="home.php" class="logo" title="Menu">KPDN</a>

      <nav class="navbar">
         <a href="home.php">Laman Utama</a>
         <a href="about.php">Info Kami</a>
         <a href="tempahan.php">Bilik Mesyuarat</a>
         <a href="pinjaman.php">Peralatan ICT</a>
         <a href="contact.php">Talian</a>
      </nav>

      <div class="icons">
         <a href="search.php"><i class="fas fa-search" title="Carian"></i></a></span></a>
         <div id="user-btn" class="fas fa-user" title="Profil"></div>
         <div id="menu-btn" class="fas fa-bars" title="Menu"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p class="name"><?= $fetch_profile['name']; ?></p>
         <div class="flex">
            <a href="profile.php" class="btn">Profil</a>
            <a href="components/user_logout.php" onclick="return confirm('Log Keluar?');" class="delete-btn">Log Keluar</a>
         </div>
         <p class="account">
            <a href="login.php">Log Masuk</a> or
            <a href="register.php">Daftar</a>
         </p> 
         <?php
            }else{
         ?>
            <p class="name">Sila Log Masuk!</p>
            <a href="login.php" class="btn">Log Masuk</a>
         <?php
          }
         ?>
      </div>

   </section>

</header>

