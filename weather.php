<!DOCTYPE html>
<html lang="en">
<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="stylesheet" href="style.css">
</head>
<body>


<center>
<div id="formDiv">
    <form action="weather.php" method="post">
	
        City Name: <input type="text" name="cityName"><br>
	   		   
		 <button type="submit"  name="add" value="ADD"> search</button>
	
    </form>
</div>	
<?php
$city=$_POST['cityName']; 
$api_url = "https://api.openweathermap.org/data/2.5/forecast?q=$city&units=metric&appid=b6c0dee41c3b13be7620763da1f9352b";
 


 if(isset($_POST['add'])) 
 {

	// Read JSON file
	$json_data = file_get_contents($api_url);

	// Decode JSON data into PHP array
	$city_data = json_decode($json_data);

	echo '<div id="nameDiv"><h1>'.$city_data->city->name.'</h1></div>';
	echo"<div class=body_container>";//////////////////////////the whole container////////////////////

	
	//go through every array in the result////
	for ($i; $i<=count($city_data->list);$i++) 
	{
	echo"<div class=containers>";//////////////////////////the divs////////////////////
	
	$timeHour=substr($city_data->list[$i]->dt_txt,11,2);
	
		if ($timeHour==18)//every day temperature at 12 oclock
	  {

		echo '<h2>'.date('l', strtotime($city_data->list[$i]->dt_txt)).'</h2>';
		$src="https://openweathermap.org/img/wn/".$city_data->list[$i]->weather[0]->icon."@2x.png";
		echo "<img src=$src height 100 width=100>";

		// // temperature Display
		
		echo '<p><strong>Temperatuer:<br></strong> '. $city_data->list[$i]->main->temp. '&deg; C</p>';

		
		// // // wind display
		
		echo '<p><strong>wind speed: <br></strong> '. $city_data->list[$i]->wind->speed.' m/s</p>';
		
		
		// // // description display
		
		echo '<p><strong>description:<br></strong> '.$city_data->list[$i]->weather[0]->description.'</p>';
		

		 }
		 echo"</div>";//////////////////////////the divs////////////////////
	}	
 }
 echo"</div>"; //////////////////////////the whole container////////////////////
?>	

</center>
</body>
</html>
