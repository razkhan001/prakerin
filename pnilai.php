<?php

include "koneksi.php";
error_reporting(0);
if ($_GET[proses] == "simpan")
{
    $queryj = $smk->prepare("select * from nilai where nilai ='$_POST[nilai]'");
    $queryj->execute();
    $jml = $queryj->rowCount();

    $cek3 = $_POST[nilai];
    $jmlh = count($cek3);

    for ($i=0;$i<$jmlh;$i++)
    {
        $query = $smk->prepare("insert into nilai (id_aspek,nilai) VALUES ('$_GET[id_aspek]','$cek3[$i]')");
        $query->execute(); 
    }
    header("Location:template.php?modul=gurupklg&act=siswa&idp=$valuej[idp]&idg=$valuej[idg]&tapel=$_REQUEST[tapel]");
}
if ($_GET[proses] == "edit")
{
	$query = $smk->prepare("update nilai set nilai = '$_POST[nilai]' where id_nilai = '$_POST[id]'");
	$query->execute();

header("Location:template.php?modul=nilai&act=nilai&nis=$_REQUEST[nis]&tapel=$_REQUEST[tapel]");

}
if ($_GET[proses] == "hapus")
{
	$query = $smk->prepare("delete from nilai where nis = '$_GET[id]'");
$query->execute();

header("Location:template.php?modul=nilai&act=nilai&nis=$_REQUEST[nis]&tapel=$_REQUEST[tapel]");

}
    $query1 = $smk->prepare("delete from nilai where nis = '$_REQUEST[nis]'");
    $query1->execute(); 

    $cek3 = $_POST[nilai];
    $jmlh = count($cek3);
    $aspek = $_POST[aspek];

    for ($i=0;$i<$jmlh;$i++)
    {
        $query = $smk->prepare("insert into nilai (nis,id_aspek,nilai) VALUES ('$_POST[nis]','$aspek[$i]]','$cek3[$i]')");
        $query->execute(); 

        header("Location:template.php?modul=nilai&act=nilai&nis=$_REQUEST[nis]&tapel=$_REQUEST[tapel]");
    }

?>