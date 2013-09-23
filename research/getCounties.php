<?php

//A simple script for extracting the Counties from the SearchPubs.json results

$file = file_get_contents('SearchPubs.json');

$json = json_decode($file, true);

$pubdata = $json['response']['Pub'];

$counties = array();

array_shift($pubdata);
foreach($pubdata as $pub){
	if(is_string($pub['PubID'])){
		$counties[$pub['County']] = 1;
	}
}

$counties = array_keys($counties);
sort($counties);

file_put_contents('PubRegions.json', json_encode($counties));

exit();