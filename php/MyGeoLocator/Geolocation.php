<?php 
  ini_set('display_errors', 'On');
  error_reporting(E_ALL);

  include(dirname(__DIR__).'/MyGeoLocator/AbstractGeocoder.php');
  include(dirname(__DIR__).'/MyGeoLocator/Geocoder.php');
  
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

if (empty($_POST["checked"])) {
    $checked = "0";
} else {
    $checked = $_POST["checked"];
}

if(!empty($errorMSG)){
	echo json_encode(['code'=>404, 'msg'=>$errorMSG]);
	exit;
}

$geocoder = new \OpenCage\Geocoder\Geocoder('99096bff44974bc582f0d44980f614a2');
$result = $geocoder->geocode($lat . "," . $lng);

if (in_array($result['status']['code'], [401,402,403,429]) or $checked != 0) {

	$handle = curl_init("http://api.geonames.org/findNearbyPlaceNameJSON?formatted=true&lat=" . $lat . "&lng=" . $lng . "&username=pAVENlol&style=full");

	curl_setopt($handle, CURLOPT_HTTPHEADER, array('Content-Type: text/plain; charset=UTF-8'));
	curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	$json_result = curl_exec($handle);

	$searchResult = [];
	$searchResult['results'] = [];

	$temp = [];

	$r = json_decode($json_result, true);

	foreach ($r as $result) {

		$temp['asciiName'] = $result['0']['asciiName'];
		$temp['lat'] = $result['0']['lat'];
		$temp['lng'] = $result['0']['lng'];
		$temp['countryCode'] = $result['0']['countryCode'];
		$temp['timezone'] = $result['0']['timezone'];

		array_push($searchResult['results'], $temp);

	}
	
	}else{

		$searchResult = [];
		$searchResult['results'] = [];

		$temp = [];

		foreach ($result['results'] as $entry) {
			$temp['source'] = 'opencage';
			$temp['formatted'] = $entry['formatted'];
			$temp['geometry']['lat'] = $entry['geometry']['lat'];
			$temp['geometry']['lng'] = $entry['geometry']['lng'];
			$temp['countryCode'] = strtoupper($entry['components']['country_code']);
			$temp['timezone'] = $entry['annotations']['timezone']['name'];

			array_push($searchResult['results'], $temp);

		}
	}

//header('Content-Type: application/json; charset=UTF-8');






echo json_encode(['reply'=>$searchResult], JSON_UNESCAPED_UNICODE);


    
//echo json_encode($searchResult, JSON_UNESCAPED_UNICODE);