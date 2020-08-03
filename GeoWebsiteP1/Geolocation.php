<?php 
  ini_set('display_errors', 'On');
  error_reporting(E_ALL);
  set_time_limit(120);
$errorMSG = "";

if (empty($_POST["search"])) {
    $errorMSG = "<li>A country or city is required</<li>";
} else {
    $search = $_POST["search"];
}

	$handle = curl_init("http://api.positionstack.com/v1/forward?access_key=e04ae2d09245778dfca6d9ea8a766f3e&query=". $search ."&timezone_module=1&limit=1&country_module=1");
	curl_setopt($handle, CURLOPT_HTTPHEADER, array('Content-Type: text/plain; charset=UTF-8'));
	curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 15);
	curl_setopt($handle, CURLOPT_TIMEOUT, 30);
	$json_result = curl_exec($handle);
	
//	print_r($json_result);
	$searchResult = [];

	$temp = [];

	$r = json_decode($json_result, true);

	foreach ($r as $result) {

		$temp['name'] = $result['0']['label'];
		$temp['country_code'] = $result['0']['country_module']['global']['alpha2'];
		$temp['lat'] = $result['0']['latitude'];
		$temp['lng'] = $result['0']['longitude'];
		$temp['country'] = $result['0']['country'];
		$temp['timezone'] = $result['0']['timezone_module']['name'];
		$temp['currency'] = $result['0']['country_module']['currencies']['0']['name'];
		$temp['continent'] = $result['0']['country_module']['global']['continent_name'];

		array_push($searchResult, $temp);

	}
	
	$handleweather = curl_init("http://api.openweathermap.org/data/2.5/onecall?lat=". $searchResult['0']['lat'] ."&lon=". $searchResult['0']['lng'] ."&units=metric&appid=56e26f60443619911dfca0de3627ce8b&exclude=minutely,hourly,daily");
	curl_setopt($handleweather, CURLOPT_HTTPHEADER, array('Content-Type: text/plain; charset=UTF-8'));
	curl_setopt($handleweather, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($handleweather, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($handleweather, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($handleweather, CURLOPT_CONNECTTIMEOUT, 15);
	curl_setopt($handleweather, CURLOPT_TIMEOUT, 30);
	$json_resultweather = curl_exec($handleweather);
	
	if ($json_resultweather === false) {
		return false;
	}
	$rw = json_decode($json_resultweather, true);
			
	$tempweather['temp'] = $rw['current']['temp'];
	$tempweather['weather'] = $rw['current']['weather']['0'];
		
	array_push($searchResult, $tempweather);
		

	$handlepop = curl_init("http://api.geonames.org/countryInfoJSON?lang=en&country=".$searchResult['0']['country_code']."&username=pavenlol");
	curl_setopt($handlepop, CURLOPT_HTTPHEADER, array('Content-Type: text/plain; charset=UTF-8'));
	curl_setopt($handlepop, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($handlepop, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($handlepop, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($handlepop, CURLOPT_CONNECTTIMEOUT, 15);
	curl_setopt($handlepop, CURLOPT_TIMEOUT, 30);
	$json_resultpop = curl_exec($handlepop);
	
	if ($json_resultpop === false) {
		return false;
	}
	$rp = json_decode($json_resultpop, true);
		
	$temppop['population'] = $rp['geonames']['0']['population'];
		
	array_push($searchResult, $temppop);

	$handlepoi = curl_init("http://api.geonames.org/wikipediaSearchJSON?formatted=true&q=".$searchResult['0']['country']."&maxRows=10&username=pavenlol&style=full");
    curl_setopt($handlepoi, CURLOPT_HTTPHEADER, array('Content-Type: text/plain; charset=UTF-8'));
    curl_setopt($handlepoi, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($handlepoi, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($handlepoi, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handlepoi, CURLOPT_CONNECTTIMEOUT, 15);
    curl_setopt($handlepoi, CURLOPT_TIMEOUT, 30);
    $json_resultpoi = curl_exec($handlepoi);

    $rpoi = json_decode($json_resultpoi, true);

    foreach ($rpoi as $result) {

        $temp['name'] = $result['0']['title'];
        $temp['lat'] = $result['0']['lat'];
        $temp['lng'] = $result['0']['lng'];
		$temp['wikiLink'] = $result['0']['wikipediaUrl'];
		$temp['summary'] = $result['0']['summary'];

        array_push($searchResult, $temp);

    }
	
echo json_encode($searchResult, JSON_UNESCAPED_UNICODE);


?>
