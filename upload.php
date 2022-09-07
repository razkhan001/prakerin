<?php
include "koneksi.php";

$qd1 = $smk->prepare("select * from upload where nis = '$_POST[nis]'");
$qd1->execute();//eksekusi
$dd1 = $qd1->fetch();
$hapus ="upload/$dd1[file]";
unlink($hapus);

$qda = $smk->prepare("delete from upload where nis ='$_POST[nis]'");
$qda->execute();

move_uploaded_file($_FILES["file"]["tmp_name"],"upload/" .$_FILES["file"]["name"]);
$file = $_FILES["file"]["name"];

$qd = $smk->prepare("insert into upload values ('NULL','$_POST[nis]','$file')");
$qd->execute();
header("Location:template.php?modul=gurupklg&act=siswa&idp=$_POST[idp]&idg=$_POST[idg]&tapel=$_REQUEST[tapel]");
?>