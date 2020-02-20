<?php
include 'config/config.php';
// $data = $api->getMovies(); 

// switch ($_GET['release_date']) {
// 	case 'ASC':
// 		$response = sortASC($data);
// 		break;
// 	case 'DESC':
// 		$response = sortDESC($data);
// 		break;
// 	default:
// 		$response = $data;
// 		break;
// }


// function sortASC($array){
// 	usort($array, function($a, $b) {
//     	return $a['release_date'] > $b['release_date'];
// 	});
// 	return $array;
// }

// function sortDESC($array){
// 	usort($array, function($a, $b) {
//     	return $a['release_date'] < $b['release_date'];
// 	});
// 	return $array;
// }

// 	// echo "<pre>";

// echo json_encode($response);

// echo $query->addComment('4','2','Hello People I love you');
	
	$movie_id='4';
	$user_id='1';
	$comment = 'hello world';
	$data = $api->addComment($movie_id,$user_id,$comment);
	echo json_encode($data);

	// $var = $api->getMovieComments('4');
	// echo json_encode($var);
?>
