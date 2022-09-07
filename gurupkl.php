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
              <form method="post" action= "?modul=gurupkl&act=pkl">
                <p><h3><b>Pilih Tahun Pelajaran Dan Jurusan</b></h3></p>
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

  case'pkl';
             echo "<div class='card'>
             
              
              <div class='card-body'>
                <a href='template.php?modul=gurupkl&act=tambah&tapel=$_REQUEST[tapel]&jurusan=$_GET[jurusan]' class='btn 
                        btn-primary'>tambah</a><p>";
                         $q = $smk->prepare("select * from pklguru where tapel = '$_REQUEST[tapel]'");//pengambilan data ditabel
                      $q->execute();
                      $jml = $q->rowCount();
                      if($jml>=1){
                        echo "
                <table id='example1' class='table table-bordered table-striped'>
                  <thead> 
                  <tr>
                      <th width=1%><center>No</th>
                      <th width=10%><center>Tahun Pelajaran</th>
                      <th width=20%><center>Nama Guru</th>
                      <th width=5%><center>Lihat Dudi</th>
                      <th width=2%><center>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>";
                
                      $queryj = $smk->prepare("select * from pklguru where tapel = '$_REQUEST[tapel]'");//pengambilan data ditabel
                      $queryj->execute();//eksekusi
                      $dataj = $queryj->fetchAll();//mengambil data secara keseluruhan
                      $no=1;
                      foreach ($dataj as $valuej)://untuk array(pengulangan data)  

                      $qs = $smk->prepare("select * from guru where nik = '$valuej[nik]'");
                      $qs->execute();
                      $ds = $qs->fetch();
                echo "
                <tr>
                      <td><center> $no</td>
                      <td> $valuej[tapel]</td>
                      <td> $ds[nama_guru]</td>
                      <td><center><a href='template.php?modul=gurupkl&act=dudi&idg=$valuej[idg]&tapel=$valuej[tapel]'><i class='fas fa-eye'></i></a></td>
                      <td><center>
                        <a href='pgurupkl.php?proses=hapus&idg=$valuej[idg]&tapel=$_REQUEST[tapel]' 
                        onclick=\"return confirm('Apakah yakin ingin menghapus data ini?')\" class='btn btn-danger'><i class='fas fa-trash'></i></a>
                      </td>
                </tr>";
                   $no++; endforeach;  echo "
                  </tbody>
                </table>";} else{echo"belum ada data";} echo"
              </div>
            </div>";
             break;

            case'tambah';

            echo "<div class='card'>
            <div class='card-body'>
            
            <form action='pgurupkl.php?proses=simpan&tapel=$_GET[tapel]' method='POST'>
            Ini Halaman Tambah Guru
            <table border='1' style='collapse' cellpadding='10'>
            <thead>
            <tr>
              <th>NO</th>
              <th>Nama Guru</th>
              <th>Pilih</th>
            </tr>
            </thead>
            <tbody>";
                      $querys = $smk->prepare("select nik from pklguru where tapel = '$_GET[tapel]'");
                      $querys->execute();
                      $var = array();
                      $datas = $querys->fetchAll();
                      foreach ($datas as $valuess):
                        $var[] = $valuess[nik];
                      endforeach;

                      $queryg = $smk->prepare("select * from guru ");//pengambilan data ditabel
                      $queryg->execute();//eksekusi
                      $datag = $queryg->fetchAll();//mengambil data secara keseluruhan
                      $no=1;
                      foreach ($datag as $valueg)://untuk array(pengulangan data)
                      if(!in_array($valueg[nik],$var)){

                echo"
            <tr>
                      <td><center>$no</td>
                      <td>$valueg[nama_guru]</td>
                      <td><center><input type='checkbox' name=nik[] value=$valueg[nik]></td>
            </tr>";  
            $no++; }
            endforeach;
          echo"
            </table>
            <br><button class='btn btn-primary'>simpan</button>
            <a href='?modul=gurupkl&act=pkl&tapel=$_GET[tapel]'><span class='btn btn-danger'>kembali</span></a>  
            </form>
        
            </div>
            </div>";
            break;

            case"dudi";

             echo "<div class='card'>";
              $gr = $smk->prepare("select *from guru a, pklguru b where a.nik = b.nik and b.idg = '$_GET[idg]'");
              $gr->execute();
              $dgr = $gr->fetch();

              echo "
              <div class='card-body'>
              <table>
              <tr>
              <td><h3>Nama Guru : $dgr[nama_guru]</h3></td>
              </tr>
              </table>
                <a href='template.php?modul=gurupkl&act=tambah1&idg=$_GET[idg]&tapel=$_GET[tapel]'' class='btn 
                        btn-primary'>tambah</a><p>";
                     $q = $smk->prepare("select * from pkldudi where idg = '$_GET[idg]'");//pengambilan data ditabel
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
                      <th rowspan='2'><center>Aksi</th>
                  </tr>
                  <tr>
                      <th>tambah</th>
                      <th>jumlah</th>
                  </tr>
                  </thead>
                  <tbody>";
                
                      $queryj = $smk->prepare("select * from pkldudi a, dudi b  where a.idd = b.idd and a.idg = '$_GET[idg]'");//pengambilan data ditabel
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
                      <td><h4><center><a href='template.php?modul=gurupkl&act=tambah2&idp=$valuej[idp]&idg=$_GET[idg]&tapel=$_GET[tapel]''><i class='fas fa-plus-circle'></i></a></h4></td>
                      <td><h4><center><a href='template.php?modul=gurupkl&act=siswa&idp=$valuej[idp]&idg=$_GET[idg]&tapel=$_GET[tapel]'' class='btn btn-primary'>$datajm[jml]</a></h4></td>
                      <td><center>
                        <a href='pgurupkl.php?proses=hapus1&idp=$valuej[idp]&idg=$_REQUEST[idg]&tapel=$_REQUEST[tapel]' 
                        onclick=\"return confirm('yakin mau ngehapus  bro?')\" class='btn btn-danger'><i class='fas fa-trash'></i></a>
                      </td>
                </tr>";
                   $no++; endforeach;  echo "
                  </tbody>
                </table>";} else{echo"belum ada data";} echo"<br><a href='?modul=gurupkl&act=pkl&tapel=$_GET[tapel]'><span class='btn btn-danger'>kembali</span></a>
              </div>
            </div>";
             break;

            case'tambah1';

            echo "<div class='card'>
            <div class='card-body'>
            
            <form action='pgurupkl.php?proses=simpan1&idg=$_GET[idg]&tapel=$_GET[tapel]'' method='POST'>
            Ini Halaman Tambah Dudi
            <table border='1' style='collapse' cellpadding='10'>
            <thead>
            <tr>
              <th>NO</th>
              <th>Nama Guru</th>
              <th>Pilih</th>
            </tr>
            </thead>
            <tbody>";
                      $querys = $smk->prepare("select idd from pkldudi where idg = '$_GET[idg]'");
                      $querys->execute();
                      $var = array();
                      $datas = $querys->fetchAll();
                      foreach ($datas as $valuess):
                        $var[] = $valuess[idd];
                      endforeach;

                      $queryg = $smk->prepare("select * from dudi ");//pengambilan data ditabel
                      $queryg->execute();//eksekusi
                      $datag = $queryg->fetchAll();//mengambil data secara keseluruhan
                      $no=1;
                      foreach ($datag as $valueg)://untuk array(pengulangan data)
                      if(!in_array($valueg[idd],$var)){

                echo"
            <tr>
                      <td><center>$no</td>
                      <td>$valueg[nama_dudi]</td>
                      <td><center><input type='checkbox' name=idd[] value=$valueg[idd]></td>
            </tr>";  
            $no++; }
            endforeach;
          echo"
            </table>
            <br><button class='btn btn-primary'>simpan</button>
            <a href='?modul=gurupkl&act=dudi&idg=$_GET[idg]&tapel=$_GET[tapel]'><span class='btn btn-danger'>kembali</span></a>  
            </form>
        
            </div>
            </div>";
            break;

            case'tambah2';

            echo "<div class='card'>
            <div class='card-body'>
            
            <form action='pgurupkl.php?proses=simpan2&idp=$_GET[idp]&idg=$_GET[idg]&tapel=$_GET[tapel]'' method='POST'>
            Ini Halaman Tambah Siswa
            <table border='1' style='collapse' cellpadding='10'>
            <thead>
            <tr>
              <th>NO</th>
              <th>Nama Siswa</th>
              <th>Pilih</th>
            </tr>
            </thead>
            <tbody>";
                      $querys = $smk->prepare("select nis from pklsiswa a, pkldudi b, pklguru c where a.idp = b.idp and b.idg = c.idg and (c.tapel = '$_GET[tapel]' or a.idp = '$_GET[idp]')");
                      $querys->execute();
                      $var = array();
                      $datas = $querys->fetchAll();
                      foreach ($datas as $valuess):
                        $var[] = $valuess[nis];
                      endforeach;

                      $queryg = $smk->prepare("select * from siswa ");//pengambilan data ditabel
                      $queryg->execute();//eksekusi
                      $datag = $queryg->fetchAll();//mengambil data secara keseluruhan
                      $no=1;
                      foreach ($datag as $valueg)://untuk array(pengulangan data)
                      if(!in_array($valueg[nis],$var)){

                echo"
            <tr>
                      <td><center>$no</td>
                      <td>$valueg[nama_siswa]</td>
                      <td><center><input type='checkbox' name=nis[] value=$valueg[nis]></td>
            </tr>";  
            $no++; }
            endforeach;
          echo"
            </table>
            <br><button class='btn btn-primary'>simpan</button>
            <a href='?modul=gurupkl&act=dudi&idg=$_GET[idg]&tapel=$_GET[tapel]'><span class='btn btn-danger'>kembali</span></a>  
            </form>
        
            </div>
            </div>";
            break;

             case'siswa';
             echo "<div class='card'>
             
              
              <div class='card-body'>";
                         $q = $smk->prepare("select * from pklsiswa where idp = '$_REQUEST[idp]'");//pengambilan data ditabel
                      $q->execute();
                      $jml = $q->rowCount();
                      if($jml>=1){
                        echo "
                <table id='example1' class='table table-bordered table-striped'>
                  <thead> 
                  <tr>
                      <th width=1%><center>No</th>
                      <th width=20%><center>Nama Siswa</th>
                      <th width=2%><center>Aksi</th>
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
                echo "
                <tr>
                      <td><center> $no</td>
                      <td> $ds[nama_siswa]</td>
                      <td><center>
                        <a href='pgurupkl.php?proses=hapus2&nis=$valuej[nis]&idp=$_GET[idp]&idg=$_REQUEST[idg]&tapel=$_REQUEST[tapel]' 
                        onclick=\"return confirm('Apakah yakin ingin menghapus data ini?')\" class='btn btn-danger'><i class='fas fa-trash'></i></a>
                      </td>
                </tr>";
                   $no++; endforeach;  echo "
                  </tbody>
                </table>";} else{echo"belum ada data";} echo"<br><a href='?modul=gurupkl&act=dudi&idg=$_GET[idg]&tapel=$_REQUEST[tapel]'><span class='btn btn-danger'>kembali</span></a>
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