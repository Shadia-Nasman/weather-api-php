<!DOCTYPE html>
<html lang="en">
<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
</head>
<body>

    <form action="weather.php" method="post">
	
        City Name: <input type="text" name="cityName"><br>
	   		   
		 <button type="submit"  name="add" value="ADD"> search</button>
	
    </form>
	
<?php
$city=$_POST['cityName']; 
$api_url = "https://api.openweathermap.org/data/2.5/forecast?q=$city&units=metric&appid=b6c0dee41c3b13be7620763da1f9352b";
 
// Read JSON file



//  print_r($city_data);


 if(isset($_POST['add'])) {
	
	

	$json_data = file_get_contents($api_url);

	// Decode JSON data into PHP array
	$city_data = json_decode($json_data);
	echo '<h1>'.$city_data->city->name.'</h1>';
for ($i; $i<=count($city_data->list);$i++) {
	$timeHour=substr($city_data->list[$i]->dt_txt,11,2);
  if ($timeHour==15){

	 echo '<h2>'.date('l', strtotime($city_data->list[$i]->dt_txt)).'</h2>';

	// // temperature Display
	
	echo '<p><strong>Temperatuer:</strong> '. $city_data->list[$i]->main->temp. '&deg; C</p>';

	
	// // // wind display
	
	 echo '<p><strong>wind speed:</strong> '. $city_data->list[$i]->wind->speed.' m/s</p>';
	
	
	// // // description display
	
	echo '<p><strong>description:</strong> '.$city_data->list[$i]->weather[0]->description.'</p>';
 }
}	
 }

?>	


</body>
</html>