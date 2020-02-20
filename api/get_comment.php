<?php
include '../config/config.php';
	
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		if(isset($_REQUEST['movie_id'])){
			$movie_id=$_REQUEST['movie_id'];
			$data = $api->getMovieComments($movie_id);
			echo  $jsonwrapper->success(201,$data);
		}else{
			echo $jsonwrapper->error(422,'Unprocessible Identity: Missing Parameter');
		}
	}else{
		echo $jsonwrapper->error(405,'Bad Method Request');
	}
?>