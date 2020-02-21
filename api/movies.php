<?php
include '../config/config.php';
$data = $api->getMovies();
 
if($_SERVER['REQUEST_METHOD'] == 'GET'){
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
			echo  $jsonwrapper->success(200,$response);
		}else{
			echo  $jsonwrapper->error(406,'Option Not Allowed');
		}
	}else{
		echo  $jsonwrapper->success(200,$data);
	}
}else{
	echo $jsonwrapper->error(405,'Bad Method Request');
}





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


?>