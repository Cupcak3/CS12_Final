<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Contact book</title>
	<link rel="stylesheet" type="text/css" href="../../client-side/resources/css/contactbook.css">
	<script src=""></script>
</head>
<body>
<div id="page">

	<a href="../../client-side/resources/html/homepage.html" target="_self">Home</a>
	<a href="contactbook.php?1">Delete all contacts</a>
	<h1>Contact book<br></h1>


	<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "test";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($_GET)
	{
		if (isset($_GET['1']))
		{
			$conn->query("drop table contacts");
			header("Refresh:0; url=contactbook.php");
		}
	}

	$data = $conn->query("SELECT * from contacts");
	if (!$data)
	{
		$link = "<a href=../../client-side/resources/html/contacts.html target='_self'>Add contacts</a>";
		echo "No contacts yet!<br>";
		echo "$link";
		exit();
	}
	echo "<table border=\"1\">";


	//Determine all fields
	$info = $data->fetch_fields();
	echo "<tr>";
	foreach ($info as $column)
	{
		echo "<th>$column->name</th>";
	}
	echo "</tr>";

	//Determine all data per contact

	while ($cell = $data->fetch_row())
	{
		$address = $cell[1] === "NULL" ? "" : $cell[1];
		$number = $cell[2] === "NULL" ? "" : $cell[2];

		echo "<tr>";
		echo "<td>$cell[0]</td><td>$address</td><td>$number</td><td>$cell[3]</td>";
		echo "</tr>";
	}
	echo "</table>";
	?>
	<br>
	<a href="../../client-side/resources/html/contacts.html" target="_self">Add more contacts</a>

</div>
</body>
</html>