<?php

	$host = "localhost";
    $username = "root";
    $pass = "";
	$dbname = "prakerin_";
    try {
        $smk = new PDO("mysql:host={$host};dbname={$dbname}", $username, $pass);
        $smk->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exception){
        die("Connection error: " . $exception->getMessage());
    }
?>
