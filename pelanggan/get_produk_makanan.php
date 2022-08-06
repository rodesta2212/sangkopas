<?php
	include("config.php");
	session_start();
	$config = new Config(); $db = $config->getConnection();

?>