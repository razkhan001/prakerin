<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | DataTables</title>

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
            <h1>Data Kelas</h1>
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
                default:
                ?>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features 1</h3>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <a href="template.php?modul=kelas&act=tambah" class="btn 
                        btn-primary">tambah</a><p>
                <table id="example1" class="table table-bordered table-striped">
                  <thead> 
                  <tr>
                      <th width=5%><center>No</th>
                      <th><center> Kelas</th>
                      <th><center> jurusan</th>
                      <th width=10%>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php
                      $queryj = $smk->prepare("select * from kelas ");//pengambilan data ditabel
                      $queryj->execute();//eksekusi
                      $dataj = $queryj->fetchAll();//mengambil data secara keseluruhan
                      $no=1;
                      foreach ($dataj as $valuej)://untuk array(pengulangan data)
                      $qj = $smk->prepare("select * from jurusan where idj = '$valuej[idj]'");
                      $qj->execute();
                      $dj = $qj->fetch();  
                ?>
                <tr>
                      <td align=center><center><?php echo $no; ?></td>
                      <td><?php echo $valuej["nama_kelas"]; ?></td>
                      <td><?php echo "$dj[nama_jurusan]"; ?></td>
                      <td>
                        <a href="template.php?modul=kelas&act=edit&id=<?=$valuej['idk']?>" class="btn 
                        btn-warning"><i class="fas fa-pen"></i></a>
                        <a href="pkelas.php?proses=hapus&id=<?=$valuej['idk']?>" 
                        onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                      </td>
                </tr>
                  <?php $no++; endforeach; ?> 
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <?php break;

            case'tambah';

            echo "<div class='card'>
            <div class='card-body'>
            
            <form action='pkelas.php?proses=simpan' method='POST'>
            ini halaman tambah
            <table>
            <tr>
              <td><b>Nama Kelas</b></td>
              <td><input type='text' name='nama'></td>
            </tr>
            <tr>
              <td><b>jurusan</b></td>
               <td><select name ='idj'>";
               $queryj = $smk->prepare("select * from jurusan ");//pengambilan data ditabel
                      $queryj->execute();//eksekusi
                      $dataj = $queryj->fetchAll();//mengambil data secara keseluruhan
                      $no=1;
                      foreach ($dataj as $valuej):
                        echo"<option value = $valuej[idj]>$valuej[skt_jurusan]</option>";
                      endforeach;
                      echo "
            </tr>
            </table>
            <br><button class='btn btn-primary'>simpan</button>
            <a href='template.php?modul=kelas'><span class='btn btn-danger'>kembali</span></a>  
            </form>
        
            </div>
            </div>";
            break;

            case"edit";
            $s = $smk->prepare("select *from kelas where idk = '$_GET[id]'");
            $s->execute();
            $ds = $s->fetch();

            echo"<div class='card'>
            <div class='card-body'>
           <form action='pkelas.php?proses=edit' method=POST>
            ini halaman edit
            <input type='hidden' name='idk' value='$ds[idk]'>
            <input type='hidden' name='idj' value='$ds[idj]'>
            <table>
            <tr>
              <td><b>ID Kelas</b></td>
              <td><b>$ds[idk]</td>
            </tr>
            <tr>
              <td><b>Nama Kelas</b></td>
              <td><input type='text' name='nama' value='$ds[nama_kelas]'></td>
            </tr>
            <tr>
              <td><b>ID jurusan</b></td>
              <td><select name ='idj'>";
               $queryj = $smk->prepare("select * from jurusan ");//pengambilan data ditabel
                      $queryj->execute();//eksekusi
                      $dataj = $queryj->fetchAll();//mengambil data secara keseluruhan
                      $no=1;
                      foreach ($dataj as $valuej):
                        echo"<option value = $valuej[idj]>$valuej[skt_jurusan]</option>";
                      endforeach;
                      echo "
            </tr>
            </table>
            <br><button class='btn btn-primary'>simpan</button>
            <a href='template.php?modul=kelas'><span class='btn btn-danger'>kembali</span></a>
            </form>
        
            </div>
            </div>";
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