<?php
include "koneksi.php";
//error_reporting(0);
if ($_GET[proses] == "simpan") 
{
	$queryj = $smk->prepare("select * from jurusan where idj ='$_POST[idj]'");
    $queryj->execute();
    $jml = $queryj->rowCount();
    echo $jml;

    if($jml == '0') {

	$query = $smk->prepare("insert into jurusan (idj,nama_jurusan,skt_jurusan) values ('$_POST[idj]','$_POST[nama]','$_POST[skt]')");
	$query->execute(); 
	header("Location:template.php?modul=jurusan");
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
	$query = $smk->prepare("update jurusan set nama_jurusan = '$_POST[nama]',skt_jurusan = '$_POST[skt]' where idj = '$_POST[idj]'");
	$query->execute();

header("Location:template.php?modul=jurusan");

}
if ($_GET[proses] == "hapus")
{
	$query = $smk->prepare("delete from jurusan where idj = '$_GET[id]'");
$query->execute();

header("Location:template.php?modul=jurusan");

}
?>