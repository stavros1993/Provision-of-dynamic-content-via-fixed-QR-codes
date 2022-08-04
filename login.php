<?php 

error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
session_start();

$username=$_POST['username'];
$password=$_POST['password'];

if($username&&$password)
	
{
require("phpsqlajax_dbinfo.php");
$connect=mysql_connect("127.0.0.1",$username1,$password1) or die("couldn't connect!");
mysql_select_db($database, $connect) or die("Couldnt find db");

$query=mysql_query("SELECT * FROM demo_qr_admin_secure_info WHERE username='$username' ");

$numrows = mysql_num_rows($query);

 
if($numrows!=0)
{

	while ($row = mysql_fetch_assoc($query))
	{
		$dbusername = $row['username'];
		$dbpassword = $row['password'];
	}
	//md5($password)==$dbpassword)
	if($username==$dbusername&&(md5($password)==$dbpassword))
	{

	  
	   $_SESSION['username']=$username;
		
		//echo "<script type='text/javascript'>alert('Συνδεθήκατε! Επιστρέφετε αυτόματα στην αρχική σελίδα.');</script>";
		header( "refresh:0; url=home.php" );

	}
	else {
		echo "Λάθος κωδικός. ";
		echo "<a href='index.php'>Ξαναπροσπαθήστε.</a>";
		//header( "refresh:0; url=index.php" );
		}
	}
	else{
	echo "Ο χρήστης με αυτό το username δεν υπάρχει. ";
	echo "<a href='index.php'>Ξαναπροσπαθήστε.</a>";
	//header( "refresh:0; url=index.php" );
	}

	}
	else{
	echo "Πληκτρολογήστε και το username και τον κωδικό.</script>";
	echo "<a href='index.php'> Ξαναπροσπαθήστε.</a>";
	//header( "refresh:0; url=index.php" );
	}

?>