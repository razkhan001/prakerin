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
            <h1>Data siswa</h1>
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
              
              
              <!-- /.card-header -->
              <div class="card-body">
                <a href="template.php?modul=siswa&act=tambah" class="btn 
                        btn-primary">tambah</a><p>
                <table id="example1" class="table table-bordered table-striped">
                  <thead> 
                  <tr>
                      <th width=5%><center>No</th>
                      <th><center>NIS</th>
                      <th><center>NISN</th> 
                      <th><center>Nama Siswa</th>
                      <th width=10%>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php
                      $queryj = $smk->prepare("select * from siswa ");//pengambilan data ditabel
                      $queryj->execute();//eksekusi
                      $dataj = $queryj->fetchAll();//mengambil data secara keseluruhan
                      $no=1;
                      foreach ($dataj as $valuej)://untuk array(pengulangan data)  
                ?>
                <tr>
                      <td align=center><center><?php echo $no; ?></td>
                      <td width=25%><?php echo $valuej["nis"]; ?></td>
                      <td width=25%><?php echo $valuej["nisn"]; ?></td>
                      <td><?php echo $valuej["nama_siswa"]; ?></td>
                      <td>
                        <a href="template.php?modul=siswa&act=edit&id=<?=$valuej['nisn']?>" class="btn 
                        btn-warning"><i class="fas fa-pen"></i></a>
                        <a href="psiswa.php?proses=hapus&id=<?=$valuej['nisn']?>" 
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
            
            <form action='psiswa.php?proses=simpan' method='POST'>
            ini halaman tambah
            <table>
            <tr>
              <td><b>NIS</b></td>
              <td><input type='text' name='nis'></td>
            </tr> 
            <tr>
              <td><b>NISN</b></td>
              <td><input type='text' name='nisn'></td>
            </tr> 
            <tr>
              <td><b>Nama Siswa</b></td>
              <td><input type='text' name='nama'></td>
            </tr>
            </table>
            <br><button class='btn btn-primary'>simpan</button>
            <a href='template.php?modul=siswa'><span class='btn btn-danger'>kembali</span></a>  
            </form>
        
            </div>
            </div>";
            break;

            case"edit";
            $s = $smk->prepare("select *from siswa where nisn = '$_GET[id]'");
            $s->execute();
            $ds = $s->fetch();

            echo"<div class='card'>
            <div class='card-body'>
           <form action='psiswa.php?proses=edit' method=POST>
            ini halaman edit
            <input type='hidden' name='nisn' value='$ds[nisn]'>
            <table>
            
            <tr>
              <td><b>NISN</b></td>
              <td><b>$ds[nisn]</td>
            </tr>
            <tr>
              <td><b>Nama Siswa</b></td>
              <td><input type='text' name='nama' value='$ds[nama_siswa]'></td>
            </tr>
            </table>
            <br><button class='btn btn-primary'>simpan</button>
            <a href='template.php?modul=siswa'><span class='btn btn-danger'>kembali</span></a>
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