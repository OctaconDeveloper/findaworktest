<?php

include('dbconnect.php');

require_once('../vendor/autoload.php');
use GuzzleHttp\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;




class api {

	/***
	*
	* 	Instatiating query Class
	*
	***/

	public function __construct() {
		$this->query = new query();
    }

    /***
	*
	* 	Base URI Initialization
	*
	***/

	public function basUrl(){
		return new Client(['base_uri' => 'https://swapi.co/api/']);
	} 

	public function Url(){
		return new Client();
	}

	/***
	* 	Movie List showing just movie title, opening_crawl and comment count
	*	Count count is coming from database
	*
	***/

	public function getMovies(){
		try {
			$response = $this->basUrl()->get('films/');
			$response = $response->getBody();
			$apiResult = json_decode($response, true);
			$data =  $apiResult['results'];		
			foreach($data as $index => $key){
				$result[$index]['movie_name'] = $key['title'];
				$result[$index]['opening_crawl'] = $key['opening_crawl'];
				$result[$index]['release_date'] = $key['release_date'];
				$result[$index]['comment_count'] = $this->query->getCommentCount($key['episode_id']);
			}
			return $result;
		} catch (ClientErrorResponseException $exception) {
			return $exception->getResponse()->getBody(true);
		}
	}

	 
	 /***
	*
	* 	Adding Commets. This saves to the database
	*
	***/

	public function addComment($movie_id,$people_id,$people_comment){

		$people =  $this->getSingleperson($people_id);
		$name = $people['name'];
		$gender  = $people['gender'];
		$date_of_birth = $people['date_of_birth'];

		$id = $this->query->addComment($movie_id,$people_id,$people_comment,$name,$gender,$date_of_birth);
		$data = $this->query->getSingleComment($id);
		$result['movie_details'] = $this->getSingleMovie($data['movie_id']);
		$result['person'] = $this->filterPerson($id);
		$result['comment'] = $data['comment'];
		return $result;
	}
	/***
	*
	* 	Filter user Details from Comment
	*
	***/
	public function filterPerson($id){
		$data = $this->query->getSingleComment($id);
		$result['name'] = $data['name'];
		$result['gender'] = $data['gender'];
		$result['date_of_birth'] = $data['date_of_birth'];
		$result['ip_address'] = $data['ipaddress'];
		$result['date'] = $data['post_date'];
		return $result;
	}

	/***
	*
	* 	Getting a single Movie details (transformed)
	*
	***/
	public function getSingleMovie($id){
		try {
			$response = $this->basUrl()->get('films/'.$id);
			$response = $response->getBody();
			$apiResult = json_decode($response, true);
			$data =  $apiResult;		
			$result['movie_name'] = $data['title'];
			$result['opening_crawl'] = $data['opening_crawl'];
			$result['release_date'] = $data['release_date'];
			$result['comment_count'] = $this->query->getCommentCount($id);
			return $result;
		} catch (ClientErrorResponseException $exception) {
			return $exception->getResponse()->getBody(true);
		}
	}

	/***
	*
	* 	Get Single person details
	*
	***/

	public function getSingleperson($id){
		try {
			$response = $this->basUrl()->get('people/'.$id);
			$response = $response->getBody();
			$apiResult = json_decode($response, true);
			$data =  $apiResult;		
			$result['name'] = $data['name'];
			$result['gender'] = $data['gender'];
			$result['date_of_birth'] = $data['birth_year'];
			$result['height'] = $data['height'];
			$result['mass'] = $data['mass'];
			$result['hair_color'] = $data['hair_color'];
			$result['skin_color'] = $data['skin_color'];
			$result['eye_color'] = $data['eye_color'];
			return $result;
		} catch (ClientErrorResponseException $exception) {
			return $exception->getResponse()->getBody(true);
		}
	}


	/***
	*
	* 	Get Annoymous Comments from a Movie
	*
	***/

	public function getMovieComments($id){
		try {
			$response = $this->basUrl()->get('films/'.$id);
			$response = $response->getBody();
			$apiResult = json_decode($response, true);
			$data =  $apiResult;		
			$result['movie_name'] = $data['title'];
			$result['opening_crawl'] = $data['opening_crawl'];
			$result['release_date'] = $data['release_date'];
			$result['comments'] = $this->query->getAllComments($id);
			return $result;
		} catch (ClientErrorResponseException $exception) {
			return $exception->getResponse()->getBody(true);
		}
	}

	/***
	*
	* 	List all Characters from a particular instance
	*
	***/

	public function listCharacters($value){
		foreach ($value as $key => $index) {
			$data = $this->Url()->get($index);
			$data = $data->getBody();
			$apiResult = json_decode($data, true);

			$result[$key]['name'] = $apiResult['name'];
			$result[$key]['gender'] = $apiResult['gender'];
			$result[$key]['date_of_birth'] = $apiResult['birth_year'];
			$result[$key]['height'] = $apiResult['height'];
			$result[$key]['mass'] = $apiResult['mass'];
			$result[$key]['hair_color'] = $apiResult['hair_color'];
			$result[$key]['skin_color'] = $apiResult['skin_color'];
			$result[$key]['eye_color'] = $apiResult['eye_color'];			
		}
		return $result;
	}

	/***
	*
	* 	Get Characters from a particular instance
	*
	***/

	public function getCharacters($id){
		try {
			$response = $this->basUrl()->get('films/'.$id);
			$response = $response->getBody();
			$apiResult = json_decode($response, true);
			$result['movie_name'] = $apiResult['title'];
			$result['characters'] = $this->listCharacters($apiResult['characters']);
			return $result;
		} catch (ClientErrorResponseException $exception) {
			return $exception->getResponse()->getBody(true);
		}
	}

	// function sortNameASC($id,$value){
	// 	try {
	// 		$response = $this->basUrl()->get('films/'.$id);
	// 		$response = $response->getBody();
	// 		$apiResult = json_decode($response, true);
	// 		$array = $this->listCharacters($apiResult['characters']);
	// 		usort($array, function($a, $b) {
	// 	    	return $a['name'] > $b['name'];
	// 		});
	// 		return $array;
	// 	}catch (ClientErrorResponseException $exception) {
	// 		return $exception->getResponse()->getBody(true);
	// 	}
	// 	// return $value;
	// }
}

?>