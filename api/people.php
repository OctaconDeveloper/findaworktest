<?php
include '../config/config.php';
	 
	if($_SERVER['REQUEST_METHOD'] == 'GET'){

		if(isset($_GET['movie_id'])){
			
			$data = $api->getCharacters($_REQUEST['movie_id']);

			if(isset($_GET['field']) && isset($_GET['sort'])){
				$arr = array('name','gender','height');
				$arr2 = array('ASC','DESC');

				if(in_array($_GET['field'], $arr) && in_array($_GET['sort'], $arr2)){
					// echo json_encode("Yes We Are Here");
					echo json_encode($api->sortASC($_REQUEST['movie_id'],$_GET['field']));
				}else{
					$dat[] = ['allowed fields', $arr];
					$dat[] = ['allowed sortd', $arr2];
	 				echo $jsonwrapper->error(422, 
	 					$dat
	 				);
				}
			}else{
				echo $jsonwrapper->success(200, $transform->getAll($data));
			
			}
		
		}else{
			echo $jsonwrapper->error(422,'Unprocessible Identity: Missing Parameter'.json_encode($_REQUEST['movie_id']));
		}
	
	}else{
		echo $jsonwrapper->error(405,'Bad Method Request'); 
	}

?>



<!-- "allowed fields",
      [
        "name",
        "gender",
        "height"
      ]
    ],
    [
      "allowed sortd",
      [
        "ASC",
        "DESC"
      ]
    ] -->