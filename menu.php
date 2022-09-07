<?php

$login = $smk->prepare("select * from user where username='$_SESSION[username]'");
 $login->execute();//eksekusi
 $data = $login->fetch();

if($data['akses'] == "admin"){?>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
              <li class="nav-item">
                <a href="template.php?modul=dashboard" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                  <a href="template.php?modul=gurupkl" class="nav-link">
                    <i class="fas fa-chalkboard-teacher nav-icon"></i>
                    <p>Data Guru PKL</p>
                  </a>
                </li>
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-school"></i>
                  <p>
                    Data 
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                 <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="template.php?modul=guru" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Guru</p>
                </a>
                </li>
                <li class="nav-item">
                  <a href="template.php?modul=siswa" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data siswa</p>
                  </a>
                </li>
                </li>
                <li class="nav-item">
                  <a href="template.php?modul=kelas" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Kelas</p>
                  </a>
                </li>
                 <li class="nav-item">
                  <a href="template.php?modul=jurusan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data jurusan</p>
                  </a>
                </li>
                 <li class="nav-item">
                  <a href="template.php?modul=dudi" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Perusahaan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="template.php?modul=aspek" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Aspek</p>
                  </a>
                </li>
                <li class="nav-item">
                <a href="template.php?modul=nilai" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nilai</p>
                </a>
                </li>
                </li>
              </ul>
                <li class="nav-item">
                  <a href="logout.php" class="nav-link">
                    <i class="fas fa-fighter-jet"></i>
                    <p>Keluar</p>
                  </a>
                </li>
          </li>
        </li>
      </ul><?php }

      else if($data['akses'] == "guru"){
        ?>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
              <li class="nav-item">
                <a href="template.php?modul=dashboard" class="nav-link">
                   <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                  <a href="template.php?modul=gurupklg" class="nav-link">
                    <i class="fas fa-chalkboard-teacher nav-icon"></i>
                    <p>Data Guru PKL</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="template.php?modul=aspek" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Aspek</p>
                  </a>
                </li>
                </li>
                <li class="nav-item">
                  <a href="logout.php" class="nav-link">
                    <i class="fas fa-fighter-jet"></i>
                    <p>Keluar</p>
                  </a>
                </li>
          </li>
        </li><?php }?>

