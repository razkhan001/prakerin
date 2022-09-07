<?php
include "koneksi.php";
//error_reporting(0);
if ($_GET[proses] == "simpan")
{
	$queryj = $smk->prepare("select * from siswa where nis='$_POST[nis]'");
    $queryj->execute();
    $jml = $queryj->rowCount();

    if($jml == '0') {

	$query = $smk->prepare("insert into siswa (nis,nisn,nama_siswa) values ('$_POST[nis]','$_POST[nisn]','$_POST[nama]')");
	$query->execute(); 
	header("Location:template.php?modul=siswa");
	}
	 else {
	 	?>
	 		<script>
	 			alert("Data Sudah Ada");
	 			javascript:history.back();
	 		</script>
	 	<?php
	 }


}

if ($_GET[proses] == "edit")
{
	$query = $smk->prepare("update siswa set nama_siswa = '$_POST[nama]' where nisn = '$_POST[nisn]'");
	$query->execute();

header("Location:template.php?modul=siswa");

}
if ($_GET[proses] == "hapus")
{
	$query = $smk->prepare("delete from siswa where nisn = '$_GET[id]'");
$query->execute();

header("Location:template.php?modul=siswa");

}
?>