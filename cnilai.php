<style>

  table
  {
    border-collapse: collapse;
  }

  td,th
  {
    height:30px;
  }

  body
  {
    font-family: tahoma;

  }

</style> 
<body onload="javascript:window.print()">
            <h3>Data Nilai</h3>
         
<?php
    include "koneksi.php";
              $gr = $smk->prepare("select *from siswa  where nis = $_GET[nis]");
              $gr->execute();
              $dgr = $gr->fetch();

              echo "
              <div class='card-body'>
              <table>
              <tr>
              <td>Nama Siswa</td>
              <td> : $dgr[nama_siswa]</td>
              </tr>
              <tr>
              <td>NIS</td>
              <td> : $dgr[nis]</td>
              </tr>
              </table>";
?>

                    <table  border=1 width=100%>
                      <thead>
                      <tr>
                        <th bgcolor="gray" width=5%><center>No.</th>
                        <th bgcolor="gray"><center>Nama Aspek</th>
                        <th bgcolor="gray" width=12%><center>Nilai</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td colspan="3" class="mapel"><b>&nbsp;&nbsp;Laporan</b></td>
                      </tr>

                      <?php

                        $queryj = $smk->prepare("select * from aspek where idpkl = '1'");
                        $queryj->execute();//eksekusi
                        $dataj = $queryj->fetchAll();//mengambil data secara keseluruhan
                        $no=1;
                        foreach ($dataj as $valuej):
                            $q = $smk->prepare("select * from nilai where id_aspek = '$valuej[id_aspek]' and nis = '$_GET[nis]'");
                            $q->execute();//eksekusi
                            $d = $q->fetch();
                      echo"
                      <tr>
                        <td><center>$no <input type=hidden name=aspek[] value=$valuej[id_aspek]></td>
                        <td style='padding-left:7px; padding-right:7px;'>$valuej[nama_aspek]</td>
                        <td><center>$d[nilai]</td>
                      </tr>";
                     $no++;
                     endforeach;

                      
                      $q1 = $smk->prepare("select a.nilai from nilai a, aspek b where a.nis = '$_GET[nis]' and a.id_aspek = b.id_aspek and b.idpkl = '1'");
                      $q1->execute();
                      $d1 = $q1->fetchAll();
                      $nl =0;
                      foreach ($d1 as $v1):
                        $nl = $nl + $v1['nilai'];
                      endforeach;
                      $rata = $nl / 5;
                      $rata1 = number_format($rata,1);
                     ?>
                      <tr bgcolor=#ddd>
                        <td colspan=2><center><b>Jumlah Nilai Laporan</td>
                        <td ><center><b><?=$nl;?><b></td>
                      </tr>
                       <tr bgcolor=#ddd>
                        <td colspan=2><center><b>Rata-Rata</td>
                        <td ><center><b><?=$rata1;?></td>
                      </tr>
                      <tr>
                        <td colspan='3'><b>&nbsp;&nbsp;Presentasi</b></td>
                      </tr>
                      <?php

                        $query = $smk->prepare("select * from aspek where idpkl = '2'");
                        $query->execute();//eksekusi
                        $data = $query->fetchAll();//mengambil data secara keseluruhan
                        $no=1;
                        foreach ($data as $value):
                           $qp = $smk->prepare("select * from nilai where id_aspek = '$value[id_aspek]' and nis = '$_GET[nis]'");
                           $qp->execute();//eksekusi
                           $dp = $qp->fetch();
                      echo "
                      <tr>
                        <td><center>$no <input type=hidden name=aspek[] value=$value[id_aspek]></td>
                        <td style='padding-left:7px; padding-right:7px;'>$value[nama_aspek]</td>
                        <td><center>$dp[nilai]</td>
                      </tr>";
                    $no++;
                    endforeach;

                      $q2 = $smk->prepare("select a.nilai from nilai a, aspek b where a.nis = '$_GET[nis]' and a.id_aspek = b.id_aspek and b.idpkl = '2'");
                      $q2->execute();
                      $d2 = $q2->fetchAll();
                      $nr =0;
                      foreach ($d2 as $v2):
                        $nr = $nr + $v2['nilai'];
                      endforeach;
                      $rat = $nr / 2;
                      $rat2 = number_format($rat,1);
                    ?> 
                      <tr bgcolor=#ddd>
                        <td colspan=2><center><b>Jumlah Nilai Presentasi</td>
                        <td ><center><b><?=$nr;?><b></td>
                      </tr>
                       <tr bgcolor=#ddd>
                        <td colspan=2><center><b>Rata-Rata</td>
                        <td ><center><b><?=$rat2;?></td>
                      </tr>
                      <tr>
                        <td colspan="3"><b>&nbsp;&nbsp;Dudi</b></td>
                      </tr>
                    <?php
                        $quer = $smk->prepare("select * from aspek where idpkl = '3'");
                        $quer->execute();//eksekusi
                        $dat = $quer->fetchAll();//mengambil data secara keseluruhan
                        $no=1;
                        foreach ($dat as $valu):
                          $qd = $smk->prepare("select * from nilai where id_aspek = '$valu[id_aspek]' and nis = '$_GET[nis]'");
                          $qd->execute();//eksekusi
                          $dd = $qd->fetch();
                      echo "
                      <tr>
                        <td><center>$no <input type=hidden name=aspek[] value=$valu[id_aspek]></td>
                        <td style='padding-left:7px; padding-right:7px;'>$valu[nama_aspek]</td>
                        <td><center><b>$dd[nilai]</td>
                      </tr>";
                    $no++;
                    endforeach;
                        $na = ($rata1 * 0.3) + ($rat2 * 0.3) + ($dd['nilai'] * 0.4); //ubah sesuai bobot %
                        $na1 = number_format($na,1);
                      ?>
                      </tbody>
                    </table>
                    <p>
                      <table border=1 width=100%>
                        <tr bgcolor=#ddd>
                          <td width=88%><center><B>Nilai Akhir</td>
                          <td><center><b><?=$na1;?></td>
                        </tr>
                      </table>
                  