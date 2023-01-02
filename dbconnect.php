<?php
try
{
	$dsn = $_ENV['DSN'];
	$user = $_ENV['USER'];
	$password = $_ENV['PASSWORD'];
	$opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
	PDO::ATTR_EMULATE_PREPARES =>false);

	$db = new PDO($dsn, $user, $password, $opt);

}
catch (PDOException $e)
{
	echo $e->getMessage();
}
?>