<?php
include "koneksi.php";
//error_reporting(0);
if ($_GET[proses] == "simpan")
{
	$queryj = $smk->prepare("select * from aspek where id_aspek ='$_POST[id]'");
    $queryj->execute();
    $jml = $queryj->rowCount();

    if($jml == '0') {

	$query = $smk->prepare("insert into aspek (id_aspek,nama_aspek) values ('$_POST[id]','$_POST[aspek]')");
	$query->execute(); 
	header("Location:template.php?modul=aspek");
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
	$query = $smk->prepare("update aspek set nama_aspek = '$_POST[aspek]' where id_aspek = '$_POST[id]'");
	$query->execute();

header("Location:template.php?modul=aspek");

}
if ($_GET[proses] == "hapus")
{
	$query = $smk->prepare("delete from aspek where id_aspek = '$_GET[id]'");
$query->execute();

header("Location:template.php?modul=aspek");

}
?>