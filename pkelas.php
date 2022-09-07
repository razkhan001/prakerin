<?php
include "koneksi.php";
//error_reporting(0);
if ($_GET[proses] == "simpan") 
{
	$queryj = $smk->prepare("select * from kelas where idk ='$_POST[idk]'");
    $queryj->execute();
    $jml = $queryj->rowCount();
    echo $jml;

    if($jml == '0') {

	$query = $smk->prepare("insert into kelas (idk,nama_kelas,idj) values ('$_POST[idk]','$_POST[nama]','$_POST[idj]')");
	$query->execute(); 
	header("Location:template.php?modul=kelas");
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
	$query = $smk->prepare("update kelas set nama_kelas = '$_POST[nama]' where idj = '$_POST[idj]'");
	$query->execute();

header("Location:template.php?modul=kelas ");

}
if ($_GET[proses] == "hapus")
{
	$query = $smk->prepare("delete from kelas where idk = '$_GET[id]'");
$query->execute();

header("Location:template.php?modul=kelas");

}
?>