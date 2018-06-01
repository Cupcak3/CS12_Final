<?php
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../../client-side/resources/css/contactbook.css\">";
$name = $_POST["name"];
$address = $_POST["address"];
$number = $_POST["phonenumber"];
$email = $_POST["email"];

class contact
{
	public $name, $address, $number, $email;

	function __construct($name, $address, $number, $email)
	{
		$this->name = $name;
		if ($address !== '')
			$this->address = $address;
		else
		{
			$this->address = NULL;
		}
		if ($number !== '')
			$this->number = $number;
		else
		{
			$this->number = NULL;
		}
		$this->email = $email;

	}
}

$contact = new contact($name, $address, $number, $email);

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error)
{
	die("Connection failed: " . $conn->connect_error);
}

if (mysqli_query($conn, "select 1 from contacts limit 1") === FALSE)
{
	$sql = "CREATE TABLE contacts 
(
	fullname varchar(255) NOT NULL,
	address varchar(255),
	number varchar(255),
	email varchar(255),
	PRIMARY KEY (email)
	)";
	$conn->query($sql);
}


$contactaddress = !empty($contact->address) ? "$contact->address" : "NULL";
$contactnumber = !empty($contact->number) ? "$contact->number" : "NULL";


$sql = "INSERT INTO contacts (fullname, address, number, email) VALUES ('$contact->name','$contactaddress','$contactnumber', 
'$contact->email')";
if ($conn->query($sql) === TRUE)
{
	echo "Successfully added contact<br>";
} else
{
	if ($conn->errno === 1062)
	{
		echo "Contact with that email already exists! Click below to go back or be redirected in a few seconds.<br>";
		header("Refresh:5; url=../../client-side/resources/html/contacts.html");
		echo "<a href=../../client-side/resources/html/contacts.html target='_self'>Go back</a>";
		exit();

	}

}


echo "<br>Done<br>";
$conn->close();
header("Refresh:5; url=../../client-side/resources/html/contacts.html");
echo "<a href=../../client-side/resources/html/contacts.html target='_self'>Go back</a>";
exit();
