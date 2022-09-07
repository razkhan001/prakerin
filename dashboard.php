<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/icon.png" alt="AdminLTELogo" height="500px" width="500px">
  </div>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <?php
             $gr = $smk->prepare("select * from user where username = '$_SESSION[username]'");
              $gr->execute();
              $dgr = $gr->fetch();
          ?>
            <h1><b>Welcome to <?=$dgr['akses'];?></b></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="template.php?modul=dashboard">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
     <div class="card">
              <!-- /.card-header -->
              <div class="card-body"><?php

$login = $smk->prepare("select * from user where username='$_SESSION[username]'");
 $login->execute();//eksekusi
 $data = $login->fetch();

              if ($data['akses'] == "admin") {
              ?>
                <center><h1><i class=" fab fa-teamspeak"></i></h1>
            <br><a href="template.php?modul=gurupkl" class="btn btn-primary">Lihat Data</a></center>
          <?php }
          else if ($data['akses'] == "guru") {?>
            <center><h1><i class=" fab fa-jenkins"></i></h1>
            <br><a href="template.php?modul=gurupklg" class="btn btn-primary">Lihat Data</a></center>
         <?php }?>

              </div>
             <!-- /.card-body -->
      </div>
    </div>
  </div>