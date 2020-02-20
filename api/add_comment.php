<?php
include '../config/config.php';
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		if(isset($_REQUEST['movie_id']) && isset($_REQUEST['user_id']) && isset($_REQUEST['comment'])){
			$movie_id=$_REQUEST['movie_id'];
			$user_id=$_REQUEST['user_id'];
			$comment = $_REQUEST['comment'];
			if(strlen($comment) > 500){
				echo $jsonwrapper->error(421,'Comment must not exceed 500 characters');
			}else{
				$data = $api->addComment($movie_id,$user_id,$comment);
				echo  $jsonwrapper->success(201,$data);
			}
		}else{
			echo $jsonwrapper->error(422,'Unprocessible Identity: Missing Parameter');
		}
	}else{
		echo $jsonwrapper->error(405,'Bad Method Request');
	}
?>