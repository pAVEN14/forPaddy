<?php 
  ini_set('display_errors', 'On');
  error_reporting(E_ALL);
$errorMSG = "";

if (empty($_POST["latitude"])) {
    $errorMSG = "<li>Latitude is required</<li>";
} else {
    $lat = $_POST["latitude"];
}

if (empty($_POST["longitude"])) {
    $errorMSG .= "<li>Longitude is required</li>";
} else {
    $lng = $_POST["longitude"];
}


//if (!in_array($result['error']) {

	$handle = curl_init("http://api.positionstack.com/v1/reverse?access_key=e04ae2d09245778dfca6d9ea8a766f3e&query=". $lat . "," . $lng ."&timezone_module=1&limit=1");
	//$handle = curl_init("http://api.geonames.org/findNearbyPlaceNameJSON?formatted=true&lat=" . $lat . "&lng=" . $lng . "&username=pAVENlol&style=full");

	curl_setopt($handle, CURLOPT_HTTPHEADER, array('Content-Type: text/plain; charset=UTF-8'));
	curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	$json_result = curl_exec($handle);
//	echo $json_result;
	$searchResult = [];

	$temp = [];

	$r = json_decode($json_result, true);

	foreach ($r as $result) {

		$temp['name'] = $result['0']['label'];
		$temp['lat'] = $result['0']['latitude'];
		$temp['lng'] = $result['0']['longitude'];
		$temp['country'] = $result['0']['country'];
		$temp['timezone'] = $result['0']['timezone_module']['name'];

		array_push($searchResult, $temp);

	}
	
echo json_encode($searchResult, JSON_UNESCAPED_UNICODE);


    
//echo json_encode($searchResult, JSON_UNESCAPED_UNICODE);