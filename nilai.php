<body class="hold-transition sidebar-mini">
<div class="wrapper">
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Nilai</h1>
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
<?php
              echo "<div class='card'>";
              $gr = $smk->prepare("select *from siswa  where nis = $_GET[nis]");
              $gr->execute();
              $dgr = $gr->fetch();

              echo "
              <div class='card-body'>
              <table>
              <tr>
              <td>Nama Siswa</td>
              <td> : $dgr[nama_siswa]</td>
              </tr>
              <tr>
              <td>NIS</td>
              <td> : $dgr[nis]</td>
              </tr>
              </table>";
?>
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Penilaian</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Sertifikat</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                     <form action="pnilai.php" method="POST">
                      <input type=hidden name=nis value='<?=$_GET['nis'];?>'>
                      <input type=hidden name=tapel value='<?=$_GET['tapel'];?>'>
                  <div class="nilai">
                    <table border="2" cellspacing="0" style="border-collapse: collapse;" width="80%">
                      <tr>
                        <th bgcolor="gray" width=5%><center>No.</th>
                        <th bgcolor="gray"><center>Nama Aspek</th>
                        <th bgcolor="gray" width=12%><center>Nilai</th>
                      </tr>
                      <tr>
                        <td colspan="3" class="mapel"><b>&nbsp;&nbsp;Laporan</b></td>
                      </tr>

                      <?php

                        $queryj = $smk->prepare("select * from aspek where idpkl = '1'");
                        $queryj->execute();//eksekusi
                        $dataj = $queryj->fetchAll();//mengambil data secara keseluruhan
                        $no=1;
                        foreach ($dataj as $valuej):
                            $q = $smk->prepare("select * from nilai where id_aspek = '$valuej[id_aspek]' and nis = '$_GET[nis]'");
                            $q->execute();//eksekusi
                            $d = $q->fetch();
                      echo"
                      <tr>
                        <td><center>$no <input type=hidden name=aspek[] value=$valuej[id_aspek]></td>
                        <td style='padding-left:7px; padding-right:7px;'>$valuej[nama_aspek]</td>
                        <td><center><input type='number' name='nilai[]' min='0' max='100' value='$d[nilai]'></td>
                      </tr>";
                     $no++;
                     endforeach;
                     ?>
                      <tr>
                        <td colspan='3'><b>&nbsp;&nbsp;Presentasi</b></td>
                      </tr>
                      <?php

                        $query = $smk->prepare("select * from aspek where idpkl = '2'");
                        $query->execute();//eksekusi
                        $data = $query->fetchAll();//mengambil data secara keseluruhan
                        $no=1;
                        foreach ($data as $value):
                           $qp = $smk->prepare("select * from nilai where id_aspek = '$value[id_aspek]' and nis = '$_GET[nis]'");
                           $qp->execute();//eksekusi
                           $dp = $qp->fetch();
                      echo "
                      <tr>
                        <td><center>$no <input type=hidden name=aspek[] value=$value[id_aspek]></td>
                        <td style='padding-left:7px; padding-right:7px;'>$value[nama_aspek]</td>
                        <td><center><input type='number' name='nilai[]' min='0' max='100' value='$dp[nilai]'></td>
                      </tr>";
                    $no++;
                    endforeach;
                    ?>
                      <tr>
                        <td colspan="3"><b>&nbsp;&nbsp;Dudi</b></td>
                      </tr>
                    <?php
                        $quer = $smk->prepare("select * from aspek where idpkl = '3'");
                        $quer->execute();//eksekusi
                        $dat = $quer->fetchAll();//mengambil data secara keseluruhan
                        $no=1;
                        foreach ($dat as $valu):
                          $qd = $smk->prepare("select * from nilai where id_aspek = '$valu[id_aspek]' and nis = '$_GET[nis]'");
                          $qd->execute();//eksekusi
                          $dd = $qd->fetch();
                      echo "
                      <tr>
                        <td><center>$no <input type=hidden name=aspek[] value=$valu[id_aspek]></td>
                        <td style='padding-left:7px; padding-right:7px;'>$valu[nama_aspek]</td>
                        <td><center><input type='number' name='nilai[]' min='0' max='100' value='$dd[nilai]'></td>
                      </tr>";
                    $no++;
                    endforeach;

                      ?>
                    </table>
                  </div><br>
                  <button class="btn btn-primary">Simpan</button>
                  </form>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                     <h3>Upload Sertifikat PKL</h3>
                     <form action="upload.php" method="POST" enctype="multipart/form-data">
                     <input type="file" name="file">
                     <input type="hidden" name="nis" value='<?=$_GET['nis'];?>'>
                     <input type="hidden" name="idp" value='<?=$_GET['idp'];?>'>
                     <input type="hidden" name="idg" value='<?=$_GET['idg'];?>'>
                     <input type="hidden" name="tapel" value='<?=$_GET['tapel'];?>'>
                     <br><br>
                     <button class="btn btn-primary">Simpan</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card -->
            <?php
                      
           echo"
          <a href='template.php?modul=gurupklg&act=siswa&idp=$_GET[idp]&idg=$_GET[idg]&tapel=$_REQUEST[tapel]'><span class='btn btn-danger'>kembali</span></a>";?>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->