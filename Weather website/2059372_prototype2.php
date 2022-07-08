<?php
// Connect to database
$mysqli = new mysqli("localhost","root","","weatherinfo");
if ($mysqli -> connect_errno) {
echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
exit();
}

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 1000");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");

// Select weather data for given parameters
$sql = "SELECT *
FROM weather_data
WHERE city = '{$_GET['city']}'
AND time >= DATE_SUB(NOW(), INTERVAL 10 SECOND)
ORDER BY time DESC limit 1";
$result = $mysqli -> query($sql);
// If 0 record found
if ($result->num_rows == 0) {
$url = 'https://api.openweathermap.org/data/2.5/weather?q=' . $_GET['city'] . '&appid=eb6ec15215f8d022cb5736c2633a21ba';
// Get data from openweathermap and store in JSON object
$data = file_get_contents($url);
$json = json_decode($data, true);
// Fetch required fields
$weather_description = $json['weather'][0]['description'];
$weather_temperature = $json['main']['temp'];
$windsp = $json['wind']['speed'];
$datentime = date("Y-m-d H:i:s"); // now
$city = $json['name'];
$max_temp = $json['main']['temp_max'];
$min_temp = $json['main']['temp_min'];
$humidity =  $json['main']['humidity'];
$winddirection = $json['wind']['deg'];
$icon = $json['weather'][0]['icon'];
// Build INSERT SQL statement
$sql = "INSERT INTO weather_data (city, temp, min_temp, max_temp,  humidity, windspeed, wind_dir, description, time, icon)
VALUES('{$city}', '{$weather_temperature}', '{$min_temp}','{$max_temp}','{$humidity}','{$windsp}','{$winddirection}','{$weather_description}','{$datentime}','{$icon}')";
// Run SQL statement and report errors
if (!$mysqli -> query($sql)) {
echo("<h4>SQL error description: " . $mysqli -> error . "</h4>");

}
// Execute SQL query
$sql = "SELECT * FROM weather_data ORDER BY time DESC limit 1";
$result = $mysqli -> query($sql);
// Get data, convert to JSON and print
$row = $result -> fetch_assoc();
print json_encode($row);
// Free result set and close connection
$result -> free_result();
$mysqli -> close();
}




?>