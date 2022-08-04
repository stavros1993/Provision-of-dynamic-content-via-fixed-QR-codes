<html>
 <head>
 <style>
   li a { display: block; }
 </style>
 <title>Χάρτης</title>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <link rel="stylesheet" type="text/css" href="style.css" />
 </head>
 <body>
 <?php require("phpsqlajax_dbinfo.php"); ?>
	<div id="container">
		<div id="header">
			<h1><a href="Home.php"><img src="logo.png" align="center" alt="logo" style="width:300px;height:60px;"></a><a href="http://gav.uop.gr/"><img src="gavlab.png" align="right" alt="logo" style="width:200px;height:55px;"></a></h1>

		</div>
   
			<div id="content" align="center">
				<div id="nav" >
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
					<h6 align="center">Χάρτης</h6>
	 
						<?php 	 include("map_code.php");	?>
	 
				<div align="center" id="admin_menu">

 <?php
 
 	error_reporting(E_ALL & ~E_NOTICE ^ E_DEPRECATED ^ E_WARNING );

	 if($_SESSION['username'] == "admin"||$_SESSION['username'] == "username"){
	
		$con= mysql_connect('localhost',$username1,$password1);
		mysql_set_charset('utf8');
		mysql_select_db($database);
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $con);

		$sql="SELECT * FROM demo_qr_array1";
	 
		$records=mysql_query($sql);
	
		echo '<br>';
	
		echo '<form id="main_form" name = "marker_list" action="marker_info.php" method="post">';
	
		echo "<select id = 'markerList' name = 'sub1' >";
	
		$_SESSION['name'] = $_POST['sub1'];
	
		while($row = mysql_fetch_assoc($records)){

			echo "<option value='" . $row['name'] ."'>" . $row['name'] . "</option>";
			
		}
	
		echo "</select>";
		echo '<input type="submit" value="Πληροφορίες και επεξεργασία σημείου" name="marker_info">';
		echo '</form>';
		
		echo '<form align="center" id="type_form" name = "add" action="add_new_marker.php" method="post">';
		echo '<input type="submit" value="Προσθήκη σημείου" name="add_field">';
		echo '</form>';
	
	}

	?>
	  
				    </div>
				</div>
			</div>
		<div id="footer">
    Copyright &copy; 2016 ΓΑΒ LAB
   </div>
  </div>
 </body>
</html>