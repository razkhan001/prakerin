<?php 
 session_start(); 
 include 'koneksi.php';
 
 $username = $_POST['username'];
 $password = $_POST['password'];
 
 $login = $smk->prepare("select * from user where username='$username' and password='$password'");
 $login->execute();//eksekusi
 $cek = $login->rowCount();
 echo "$cek";
 echo "$_SESSION[username]";

 if($cek >= 1){
 $_SESSION[username] = $username;
 header("location:template.php?modul=dashboard");
}
 
 else{?>
	 		<script>
	 			alert("username tidak ada");
	 			javascript:history.back();
	 		</script>
	 	<?php
 }
?>






