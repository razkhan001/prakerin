<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Guru PKL</h1>
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
             error_reporting(0);
              switch($_GET["act"]) 
              {
                default:?>
            <div class='card'>
            <div class='card-body'>
              <form method="post" action= "?modul=gurupklg&act=dudi">
                <p><h3><b>Pilih Tahun Pelajaran</b></h3></p>
                <h4><select name="tapel">
                    <option value="2020/2021">2020/2021</option>
                    <option value="2021/2022">2021/2022</option>
                    <option value="2022/2023">2022/2023</option>
                    <option value="2023/2024">2023/2024</option>
                    <option value="2024/2025">2024/2025</option>
                 </select>
                <button class="btn btn-primary"><i class='fas fa-eye'></i></button></h4>
                </form>
              </div>
            </div>
               <?php break;

  case"dudi";

             echo "<div class='card'>";
              $gr = $smk->prepare("select *from guru a, pklguru b where a.nik = b.nik and b.nik = '$_SESSION[username]'");
              $gr->execute();
              $dgr = $gr->fetch();

              echo "
              <div class='card-body'>
              <table>
              <tr>
              <td><h3>Nama Guru : $dgr[nama_guru]</h3></td>
              </tr>
              </table>";
                     $q = $smk->prepare("select * from pkldudi a, pklguru b, dudi c where a.idg = b.idg and a.idd = c.idd and b.tapel = '$_REQUEST[tapel]' and b.nik = '$_SESSION[username]'");//pengambilan data ditabel
                      $q->execute();
                      $jml = $q->rowCount();
                      if($jml>=1){
                        echo "
                <table id='example1' class='table table-bordered table-striped'>
                  <thead> 
                  <tr>
                      <th rowspan='2'><center>No</th>
                      <th rowspan='2'><center>Nama Perusahaan</th>
                      <th colspan='2'><center>Siswa</th>
                  </tr>
                  </thead>
                  <tbody>";
                
                      $queryj = $smk->prepare("select * from pkldudi a, pklguru b, dudi c where a.idg = b.idg and a.idd = c.idd and b.tapel = '$_REQUEST[tapel]' and b.nik = '$_SESSION[username]'");//pengambilan data ditabel
                      $queryj->execute();//eksekusi
                      $dataj = $queryj->fetchAll();//mengambil data secara keseluruhan
                      $no=1;
                      foreach ($dataj as $valuej)://untuk array(pengulangan data)  

                      $qd = $smk->prepare("select * from dudi where idd = '$valuej[idd]'");
                      $qd->execute();
                      $dd = $qd->fetch();

                     $queryjm = $smk->prepare("select count(nis) as jml from pklsiswa where idp = '$valuej[idp]'");
                     $queryjm->execute();
                     $datajm = $queryjm->fetch();

                     $query = $smk->prepare("select * from pklsiswa a, pkldudi b  where a.idp = b.idp and a.idp = '$_GET[idp]'");
                     $query->execute();
                     $data = $query->fetch();

                echo "
                <tr>
                      <td><center> $no</td>
                      <td> $dd[nama_dudi]</td>
                      <td><h4><center><a href='template.php?modul=gurupklg&act=siswa&idp=$valuej[idp]&idg=$valuej[idg]&tapel=$_REQUEST[tapel]' class='btn btn-primary'>$datajm[jml]</a></h4></td>
                </tr>";
                   $no++; endforeach;  echo "
                  </tbody>
                </table>";} else{echo"belum ada data";} echo"<br><a href='?modul=gurupklg&act=pkl&tapel=$_REQUEST[tapel]'><span class='btn btn-danger'>kembali</span></a>
              </div>
            </div>";
             break;

    case'siswa';
             echo "<div class='card'>";
              $gr = $smk->prepare("select *from guru a, pklguru b,dudi c where a.nik = b.nik and b.nik = '$_SESSION[username]'");
              $gr->execute();
              $dgr = $gr->fetch();
             
              echo"
              <div class='card-body'>
              <table>
              <tr>
              <td><h3>Nama Guru : $dgr[nama_guru]</h3></td>
              </tr>
              </table>";
                         $q = $smk->prepare("select * from pklsiswa where idp = '$_REQUEST[idp]'");//pengambilan data ditabel
                      $q->execute();
                      $jml = $q->rowCount();
                      if($jml>=1){
                        echo "
                <table id='example1' class='table table-bordered table-striped'>
                  <thead> 
                  <tr>
                      <th width=1%><center>No</th>
                      <th><center>NIS</th>
                      <th><center>Nama Siswa</th>
                      <th width=15% colspan='3'><center>Nilai</th>
                  </tr>
                  </thead>
                  <tbody>";
                
                      $queryj = $smk->prepare("select * from pklsiswa where idp = '$_REQUEST[idp]'");//pengambilan data ditabel
                      $queryj->execute();//eksekusi
                      $dataj = $queryj->fetchAll();//mengambil data secara keseluruhan
                      $no=1;
                      foreach ($dataj as $valuej)://untuk array(pengulangan data)  

                      $qs = $smk->prepare("select * from siswa where nis = '$valuej[nis]'");
                      $qs->execute();
                      $ds = $qs->fetch();

                      $qss = $smk->prepare("select * from upload where nis = '$valuej[nis]'");
                      $qss->execute();
                      $dss = $qss->fetch();
                echo "
                <tr>
                      <td><center> $no</td>
                      <td> $ds[nis]</td>
                      <td> $ds[nama_siswa]</td>
                      <td><center><a href='template.php?modul=nilai&act=nilai&nis=$valuej[nis]&tapel=$_REQUEST[tapel]&idp=$_REQUEST[idp]&idg=$_REQUEST[idg]' class='text-success'><i class='fas fa-pen'></i></a></td>
                      <td><center><a href='cnilai.php?nis=$valuej[nis]&tapel=$_REQUEST[tapel]&idp=$_REQUEST[idp]&idg=$_REQUEST[idg]' target=_blank><i class='fas fa-list'></i></a></td>
                      <td><center><a href='upload/$dss[file]' target=_blank><i class='fas fa-file'></i></a></td>
                      
                </tr>";
                   $no++; endforeach;  echo "
                  </tbody>
                </table>";} else{echo"belum ada data";} echo"<br><a href='?modul=gurupklg&act=dudi&idg=$_GET[idg]&tapel=$_GET[tapel]'><span class='btn btn-danger'>kembali</span></a>
              </div>
            </div>
                ";
             break;
          }
            ?>

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>