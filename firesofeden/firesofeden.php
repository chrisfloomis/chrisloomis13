<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
    	<title>The Fires of Eden</title>
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>
	<body>
		<h1>The Fires of Eden</h1>
		<figure>
			<a href="/~loomisc/campaign_map_05.jpg">
			<img src="campaign_map_05.jpg" alt="Campaign Map" style="width:500px;">
			</a>
			<figcaption>Click to enlarge</figcaption>
		</figure>
		<div>
			<form method="POST" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
				<fieldset>
					<legend>Select Region for 7-day Forecast</legend>
					<p>
						<select name="region">
							<option value="r1">Beckinshire Moors</option>
							<option value="r2">Vindhya Range</option>
							<option value="r3">Iveray Highlands</option>
							<option value="r4">Vanock Point</option>
							<option value="r5">Aurora Coast</option>
							<option value="r6">Kuban Plains</option>
							<option value="r7">Ruselgas</option>
						</select>
					</p>
				</fieldset>
				<input type="submit" name="selectregion" value="Select Region">
			</form>
		</div>
		<div>						
		<?php 
					
if (!empty($_POST)): 
			if ($_POST["region"] == "r1"){$region = "Salekhard";echo '<h3>Beckinshire Moors 7-day Forecast</h3>';}
			if ($_POST["region"] == "r2"){$region = "Varkuta";echo '<h3>Vindhya Range 7-day Forecast</h3>';}
			if ($_POST["region"] == "r3"){$region = "Norilsk";echo '<h3>Iveray Highlands 7-day Forecast</h3>';}
			if ($_POST["region"] == "r4"){$region = "Dikson";echo '<h3>Vanock Point 7-day Forecast</h3>';}
			if ($_POST["region"] == "r5"){$region = "Tiksi";echo '<h3>Aurora Coast 7-day Forecast</h3>';}
			if ($_POST["region"] == "r6"){$region = "Novosibirsk";echo '<h3>Kuban Plains 7-day Forecast</h3>';}
			if ($_POST["region"] == "r7"){$region = "Qyzylorda";echo '<h3>Ruselgas 7-day Forecast</h3>';}
					
$service_url = 'http://api.openweathermap.org/data/2.5/forecast/daily?q=' . $region . '&units=imperial&cnt=7&APPID=ac8c02ef8cf7667fb84c8c8dc20ec383';
$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
curl_close($curl);
$decoded = json_decode($curl_response);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occured: ' . $decoded->response->errormessage);
}
			
$daily = $decoded->list;
$i=0;
	
echo '<table><tr>';
while($i < 7)
{
	  echo '<th>' . date('m-d-Y', strtotime('+' . $i++ . ' day')) . '</th>';
}
echo '</tr>';
echo '<tr>';
			
$i=0;
while($i < 7)
{
	echo '<td><img src="http://openweathermap.org/img/w/' . $decoded->list[$i]->weather[0]->icon . '.png"><br>' . $decoded->list[$i]->weather[0]->description . '<br>' . $decoded->list[$i]->temp->day . '°F</td>';
	$i++;
}


echo '</tr>';
echo '</table>';
		?>

		<?php endif; ?>
		</div>
	</body>
</html>