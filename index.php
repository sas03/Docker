<?php
	const SQL_DSN = "mysql:host=172.19.0.4;dbname=web_database";
	const SQL_USERNAME = "root";
	const SQL_PASSWORD = "root";
	const SQL_DRIVER_OPTIONS = null;
	const COUNTER_ID = 1;
	try
	{
		$PDOInstance = new \PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD, SQL_DRIVER_OPTIONS);
	}
	catch (PDOException $e)
	{
		die("PDO CONNECTION ERROR: " . $e->getMessage() . "<br/>");
	}

	if (count($PDOInstance->query("SELECT visits FROM counters WHERE id = " . COUNTER_ID . ";")->fetchAll()) === 0) {
		$PDOInstance->exec("INSERT INTO counters VALUES (1,0);");
	}

	$PDOInstance->exec("UPDATE counters SET visits = visits + 1 WHERE id = " . COUNTER_ID . ";");

	$counts = $PDOInstance->query("SELECT visits FROM counters WHERE id =" . COUNTER_ID . ";")->fetchAll(PDO::FETCH_ASSOC);
	if (count($counts) > 0) {
		$visits = $counts[0]["visits"];
	} else {
		$visits = "Pas de ligne dans la table";
	}
?>
<!doctype html>
<html>
<head>
<title>Juste un compteur</title>
<style>
* { font-family: sans-serif; margin: 0; padding: 0 }
div { width: 100vw; height: 100vh; font-size: 4rem; text-align: center; }
span { font-size: 30rem }
</style>
</head>
<body>
<div><span><?= $visits ?></span>visites.<br />Cette valeur provient depuis une base MySQL executée sur un autre conteneur.</div>
</body>
</html>
