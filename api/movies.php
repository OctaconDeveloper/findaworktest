<?php
include 'config/config.php';
$data = $api->getMovies();

$arr = array('ASC','DESC');

if(isset($_GET['release_date'])){
	if(in_array($_GET['release_date'], $arr)){
		switch ($_GET['release_date']) {
			case 'ASC':
				$response = sortASC($data);
				break;
			case 'DESC':
				$response = sortDESC($data);
				break;
			default:
				$response = $data;
				break;
		}
	}else{
		$response = {
			'status': 422,
			'Unprocessible Identity: Please check your parameter'
		}
}else{
	$response = $data;
}

// if($_GET['release_date'])



function sortASC($array){
	usort($array, function($a, $b) {
    	return $a['release_date'] > $b['release_date'];
	});
	return $array;
}

function sortDESC($array){
	usort($array, function($a, $b) {
    	return $a['release_date'] < $b['release_date'];
	});
	return $array;
}


// echo "<pre>";
// echo json_encode($response);
// echo "Hello";

?>