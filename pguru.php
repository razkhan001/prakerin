<?php
include "koneksi.php";
error_reporting(0);
if ($_GET[proses] == "simpan")
{
	$queryj = $smk->prepare("select * from guru where nik='$_POST[nik]'");
    $queryj->execute();
    $jml = $queryj->rowCount();

    if($jml == '0') {

	$query = $smk->prepare("insert into guru (nik,nama_guru) values ('$_POST[nik]','$_POST[nama]')");
	$query->execute(); 
	header("Location:template.php?modul=guru");
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
	$query = $smk->prepare("update guru set nama_guru = '$_POST[nama]' where nik = '$_POST[nik]'");
	$query->execute();

header("Location:template.php?modul=guru");

}
if ($_GET[proses] == "hapus")
{
	$query = $smk->prepare("delete from guru where nik = '$_GET[id]'");
$query->execute();

header("Location:template.php?modul=guru");

}
?>