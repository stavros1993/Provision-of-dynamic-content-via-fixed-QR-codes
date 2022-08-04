<html>
 <head>
 <style>
   li a { display: block; }
 </style>
  <title>My website</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
 </head>
 <body>
 <?php require("phpsqlajax_dbinfo.php"); ?>

 <div id="container">
   <div id="header">
    <h1><a href="Home.php"><img src="logo.png" align="center" alt="logo" style="width:300px;height:60px;"></a><a href="http://gav.uop.gr/"><img src="gavlab.png" align="right" alt="logo" style="width:200px;height:55px;"></a></h1>

   </div>
  <div id="content">
    <div id="nav">
     <h3 align="center">Πλοήγηση</h3>
     <ul id="menu">
      <li align="center"><a href="Home.php">Αρχική</a></li>
	  <li align="center"><a href="Map.php">Χάρτης</a></li>
	  <?php  
		SESSION_START(); 
		error_reporting(E_ALL & ~E_NOTICE ^ E_DEPRECATED ^ E_WARNING );  
		if($_SESSION['username'] == "admin"||$_SESSION['username'] == "username")
		 echo'<li align="center"><a href="logout.php">Αποσύνδεση</a></li>'; 
		else echo' <li align="center"><a href="index.php"> Σύνδεση </a></li>';
	   ?>
      <li align="center"><a href="Contact.php">Επικοινωνία</a></li>
     </ul>

    </div>
    	  
    <div id="main">
     <h6 align="center">Eπικοινωνία:</h6>
	 
	 <p align = "center"> Για οποιαδήποτε ερώτηση ή βοήθεια επικοινωνήστε μαζί μας με email στο <b> cst11042@uop.gr </b> και θα σας απαντήσουμε το συντομότερο δυνατόν.  </p>

    </div>
  
   </div>
   <div id="footer">
    Copyright &copy; 2016 ΓΑΒ LAB
   </div>
  </div>
 </body>
</html>﻿