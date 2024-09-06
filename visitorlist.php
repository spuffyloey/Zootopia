<?php
	include("dbconn.php");
	$sql="select * from visitor";
	$query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error());
	$row = mysqli_num_rows($query);
	if($row == 0){
		echo "No record found";
	}
	else{
		echo"<font size='9'>List of zootopia's customer</font>";
		echo"<table border=1>";
		echo"<tr>";
		echo"<th>VISITOR ID</th>";
		echo"<th>ACCOUNT ID</th>";
		echo"<th>FIRST NAME</th>";
		echo"<th>LAST NAME</th>";
		echo"<th>PHONE NUMBER</th>";
		echo"<th>OPTIONS</th>";
		echo"</tr>";
while($row = mysqli_fetch_array($query)) {
		echo"<tr>";
		echo"<td>".$row["visitor_id"]."</td>";
		echo"<td>".$row["accountID"]."</td>";
		echo"<td>".$row["firstName"]."</td>";
		echo"<td>".$row["lastName"]."</td>";
		echo"<td>".$row["Phone"]."</td>";
		echo"<td><a href='del.php?p_code=".$row["visitor_id"]."'>DELETE</a></td>";
		echo"</tr>";
		}
		
	}	
?>