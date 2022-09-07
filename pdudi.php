<?php
include "koneksi.php";
error_reporting(0);
if ($_GET[proses] == "simpan")
{
	$queryj = $smk->prepare("select * from dudi where idd='$_POST[idd]'");
    $queryj->execute();
    $jml = $queryj->rowCount();

    if($jml == '0') {

	$query = $smk->prepare("insert into dudi (idd,nama_dudi,pimpinan,hp,alamat) values ('$_POST[idd]','$_POST[dudi]','$_POST[nama]','$_POST[hp]','$_POST[alamat]')");
	$query->execute(); 
	header("Location:template.php?modul=dudi");
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
	$query = $smk->prepare("update dudi set pimpinan = '$_POST[nama]', alamat = '$_POST[alamat]', hp = $_POST[hp],nama_dudi = '$_POST[dudi]' where idd = '$_POST[idd]'");
	$query->execute();

header("Location:template.php?modul=dudi");

}
if ($_GET[proses] == "hapus")
{
	$query = $smk->prepare("delete from dudi where idd = '$_GET[id]'");
$query->execute();

header("Location:template.php?modul=dudi");

}
?>