<?php

include "function.php";
include "database.php";

$data = new database();

session_start();

if (!isset($_SESSION['username']))
{
	header("location: ".MAIN_URL."config.php");
}
else
{
	$content = "home.php";

	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800))
	{
		session_unset();
		session_destroy();

		header("location: ".MAIN_URL."config.php");
	}

	$username = $_SESSION['username'];
	$nama = $_SESSION['nama'];
	$kelas = $_SESSION['kelas'];
	$no_absen = $_SESSION['indeks'];

	$log = "INSERT INTO user_log(username, status, halaman) VALUES ('$username', 'akses', 'home')";
	$hasil = $data->getDb()->query($log);

	$_SESSION['LAST_ACTIVITY'] = time();

	require "template.php";
}