<?php include "koneksi.php"; ?>
		<center><h3><b>Data Guru</h3></b></center>
				
		<table >
		<thead>
				<tr>
				<th width=5%><center>No</th>
				<th><center>NIK</th>
				<th><center>Nama Guru</th>
				<th width=10% ><center>Aksi</th>
				</tr></thead>
				<tbody>
<?php
				$queryj = $ravi->prepare("select * from guru ");
				$queryj->execute();
				$dataj = $queryj->fetchAll();
				$no=1;
				foreach ($dataj as $valuej):
					
?>
				<tr><td align=center><center><?php echo $no; ?></td>
					<td width=25%><?php echo $valuej[nik]; ?></td>
					<td><?php echo $valuej[nama]; ?></td>
					</tr>
					<?php $no++; endforeach; ?>								
					</tbody>
					</table>