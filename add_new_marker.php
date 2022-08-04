<html>
 <head>
  <title>My website</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <style>
	form { display: inline; }
  </style>
 </head>
 
 <body>
  <?php require("phpsqlajax_dbinfo.php");?>
 <div id="container">
   <div id="header">
    <h1><a href="Home.php"><img src="logo.png" align="center" alt="logo" style="width:300px;height:60px;"></a><a href="http://gav.uop.gr/"><img src="gavlab.png" align="right" alt="logo" style="width:200px;height:55px;"></a></h1>

   </div>
   
   <div id="content" align="center">
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
    	  
    <div id="main" align = "center">
     <h6 align="center">Χάρτης</h6>
	 <?php	 include("map_code_add_marker.php");	?>
	 
	<div align="center" id="admin_menu">

 <?php
 	error_reporting(E_ALL & ~E_NOTICE ^ E_DEPRECATED ^ E_WARNING );

  SESSION_START();

	if($_SESSION['username'] == "admin"||$_SESSION['username'] == "username"){
	
	$con= mysqli_connect('localhost',$username1,$password1,$database);
	mysqli_set_charset('utf8');
	mysql_set_charset('utf8');
	
	if (mysqli_set_charset($con, "utf8")) {
	?>	
		<p align="center"> Μετακινήστε τη κόκκινη πινέζα στη τοποθεσία που θέλετε και στη συνέχεια συμπληρώστε τα υπόλοιπα στοιχεία. </p>
	
		<form id="main_form" name = "add_new_marker" action="add_new_marker.php" method="post">
		Γεωγραφικό πλάτος:<input type="textarea" value = "37.510357" name="lat" id="lat"  value="<?php if(isset($_POST['submit'])){ echo $_POST['lat'];}?>" readonly><br>
		&ensp;Γεωγραφικό μήκος:<input type="textarea" name="lng" value = "22.372385"id="lng" value="<?php if(isset($_POST['submit'])){ echo $_POST['lng'];}?>" readonly><br>
		&nbsp;&ensp;&emsp;&emsp;&emsp;&emsp;&emsp;Όνομα:<input type="textarea" name="name" id="name"><br>
		<br>
		<input type="submit" name="submit" value="OK">
	
		</form>
	
		<form align="center" id="prev" name = "prev" action="map.php" method="post">
		<?php
		
		echo '<input type="submit" value="Πίσω" name="edit">';
		echo '</form>';
	
	
		if(isset($_POST['submit'])){
	
			if (empty($_POST['name'])||(empty($_POST['lat'])||(empty($_POST['lat'])))) {
				echo '<br><span style="color:#8A0808;text-align:center;">Συμπληρώστε όλα τα πεδία της φόρμας.</span>';
				header( "refresh:0; url=add_new_marker.php" );
			
				}
			
				else {
				
			
					if ($result = mysqli_query($con, "SELECT id FROM demo_qr_array1 WHERE name ='".$_POST['name']."'")) {
						$row_cnt = mysqli_num_rows($result);

						if($row_cnt!=0) {
				
				
							echo '<br><span style="color:#8A0808;text-align:center;">Υπάρχει ήδη ένα σημείο με αυτό το όνομα στη βάση. Πληκτρολογήστε ένα άλλο όνομα για να ολοκληρωθεί η προσθήκη.</span>';

							header( "refresh:0; url=add_new_marker.php" );
						
						mysqli_free_result($result);
					}
					else {
						
						date_default_timezone_set('Europe/Athens');

						$timestamp_init = date("Y-m-d")." " . date("H:i:s");						
						
						$content_name = "Όνομα:" . ' ' . $_POST['name'];
						$content_lng = "Γεωγραφικό μήκος:" . ' ' . $_POST['lng'];
						$content_lat = "Γεωγραφικό πλάτος:" . ' ' . $_POST['lat'];
						$timestamp_with_text = "Ημερομηνία δημιουργίας:" . ' ' . $timestamp_init;
						$content_all = $content_name."<br>".$content_lng."<br>".$content_lat."<br>".$timestamp_with_text;						
						
						
						$sql = "INSERT INTO demo_qr_array1 (latitude, longitude, type, name,last_edited, html_code)
						VALUES ('".$_POST['lat']."', '".$_POST['lng']."', '1','".$_POST['name']."','".$timestamp_init."','".$content_all."')";
					
						if (mysqli_query($con, $sql)) {
			
							//header( "refresh:0; url=map.php" );
							
							
							echo'<script>
								location.replace("Map.php")
							</script>';
						
						} else {
							echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}
					
					}
					} else echo "Can't execute query";

				}	
			} 
		}
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