<?php
/*
This is the only part you need to edit in this file
Change the below defaults with your database name, user and password and you'll be ready to go.
*/
$db = "jqueryplugin";
$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "password";
/* end of the part you need to edit */

/* database connection, no need to edit (or you can use your own database layer class and replace this */

// Create connection
$con=mysqli_connect($dbHost,$dbUser,$dbPassword,$db);
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

/* end of connecting to database */

$json = "[";
/* if countries list is not generated and no country code sent with the request to fetch the cities of this country
retrieve all countris from the database */

if($_GET["countryCode"] == null)
   {
	try {
	$sqlCountries = "SELECT countryCode, countryName FROM countries ORDER BY countryName";
	$result = mysqli_query($con, $sqlCountries) or die(mysql_error());
	$numberOfRows = @mysql_num_rows($result);
	
	$i = 0;
		
	while($row = mysqli_fetch_array($result))
	{
		$i++;
		$json .= "{\"countryCode\": \"" . $row["countryCode"] . "\", ";
		$json .= "\"countryName\": \"" . $row["countryName"] . "\"}";
		
		  if($i < $numberOfRows)
			$json.= ",";
	}
}
catch(Exception $e)
  {
  echo 'Message: ' .$e->getMessage();
  }

    mysqli_close($con);
}
else //if countries list is already generated and a request is sent to fetch the cities of the selected country
{
        $countryCode = $_GET["countryCode"];
        
	try {
        $sqlCities = "SELECT cityId, cityName FROM cities WHERE cityCountryCode='" . $countryCode ."'";
	$result = mysqli_query($con, $sqlCities) or die(mysql_error());
	$numberOfRows = @mysql_num_rows($result);
	}
	catch(Exception $e)
	  {
	  echo 'Message: ' .$e->getMessage();
	  }
    			$i = 0;
    			    			
			while($row = mysqli_fetch_array($result))
			  {
			  $i++;
	                  $json.= "{\"cityId\": \"" . $row["cityId"] . "\", ";
	                  $json.= "\"cityName\": \"" . $row["cityName"] . "\"}";
	                  
                  if($i < $numberOfRows)
                    $json.= ",";                      
		}

 	mysqli_close($con);
    
}      
$json .= "]";
echo $json;
?>