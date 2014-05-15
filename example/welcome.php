<?php
include "lock.php";
include "classes/entry.php";
include "mapper.php";

$Mapper = new Mapper($db);

$entries = $Mapper->query(new Entry(), "SELECT * FROM <table>", []);

// $entry = new Entry('carl','thirst','right now','penis');
// var_dump($entry);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Presseract - Diary Entries</title>
	</head>
	<body>
		<?php
			foreach ($entries as &$entry)
				$entry->render();
		?>
		<a href="logout.php">Sign Out</a>
	</body>
</html>