<?php
include "koneksi.php";
//error_reporting(0);
if ($_GET[proses] == "simpan")
{
	$queryj = $smk->prepare("select * from pklguru where nik='$_POST[nik]'");
    $queryj->execute();
    $jml = $queryj->rowCount();

    $cek = $_POST[nik];
    $jumlah = count($cek);

    for ($i=0;$i<$jumlah;$i++)
    {
    	$query = $smk->prepare("insert into pklguru (tapel,nik) VALUES ('$_GET[tapel]','$cek[$i]')");
    	$query->execute();
    }
header("Location:template.php?modul=gurupkl&act=pkl&tapel=$_REQUEST[tapel]");

}

if ($_GET[proses] == "simpan1")
{
	$query = $smk->prepare("select * from pkldudi where idd='$_POST[idd]'");
    $query->execute();
    $jm = $query->rowCount();

    $cek1 = $_POST[idd];
    $jmlh = count($cek1);

    for ($i=0;$i<$jmlh;$i++)
    {
    	$quer = $smk->prepare("insert into pkldudi (idg,idd) VALUES ('$_GET[idg]','$cek1[$i]')");
    	$quer->execute();
    }
header("Location:template.php?modul=gurupkl&act=dudi&idg=$_GET[idg]&tapel=$_GET[tapel]");

}

if ($_GET[proses] == "simpan2")
{
    $cek2 = $_POST[nis];
    $jmh = count($cek2);

    for ($i=0;$i<$jmh;$i++)
    {
    	$quer = $smk->prepare("insert into pklsiswa (idp,nis) VALUES ('$_GET[idp]','$cek2[$i]')");
    	$quer->execute();
    }
header("Location:template.php?modul=gurupkl&act=dudi&idg=$_GET[idg]&tapel=$_GET[tapel]");

}





if ($_GET[proses] == "hapus")
{
	$query = $smk->prepare("select * from pklguru a, pkldudi b where a.idg = b.idg and a.idg = '$_GET[idg]' and a.tapel = '$_GET[tapel]'");
    $query->execute();
    $dataj = $query->fetchAll();
        foreach ($dataj as $valuej):
                $q = $smk->prepare("delete from pklsiswa where idp ='$valuej[idp]'");
                $q->execute();
        endforeach;

                $qa = $smk->prepare("delete from pkldudi where idg ='$_GET[idg]'");
                $qa->execute();

                $qb = $smk->prepare("delete from pklguru where idg ='$_GET[idg]' and tapel = '$_GET[tapel]'");
                $qb->execute();

    header("Location:template.php?modul=gurupkl&act=pkl&tapel=$_GET[tapel]");
}


if ($_GET[proses] == "hapus1")
{
                $q = $smk->prepare("delete from pklsiswa where idp ='$_GET[idp]'");
                $q->execute();

                $qa = $smk->prepare("delete from pkldudi where idp = '$_GET[idp]'");
                $qa->execute();

header("Location:template.php?modul=gurupkl&act=dudi&idg=$_GET[idg]&tapel=$_GET[tapel]");
}

if ($_GET[proses] == "hapus2")
{
    $query = $smk->prepare("delete from pklsiswa where nis = '$_GET[nis]' and idp ='$_GET[idp]'");
$query->execute();

header("Location:template.php?modul=gurupkl&act=siswa&idp=$_GET[idp]&idg=$_GET[idg]&tapel=$_REQUEST[tapel]");
}

?>