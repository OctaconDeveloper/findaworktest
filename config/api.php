<?php

include('dbconnect.php');

require_once('../vendor/autoload.php');
use GuzzleHttp\Client;




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

	/***
	* 	Movie List showing just movie title, opening_crawl and comment count
	*	Count count is coming from database
	*
	***/

	public function getMovies(){
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
		$response = $this->basUrl()->get('films/'.$id);
		$response = $response->getBody();
		$apiResult = json_decode($response, true);
		$data =  $apiResult;		
		$result['movie_name'] = $data['title'];
		$result['opening_crawl'] = $data['opening_crawl'];
		$result['release_date'] = $data['release_date'];
		$result['comment_count'] = $this->query->getCommentCount($id);
		return $result;
	}

	/***
	*
	* 	Get Single person details
	*
	***/

	public function getSingleperson($id){
		$response = $this->basUrl()->get('people/'.$id);
		$response = $response->getBody();
		$apiResult = json_decode($response, true);
		$data =  $apiResult;		
		$result['name'] = $data['name'];
		$result['gender'] = $data['gender'];
		$result['date_of_birth'] = $data['birth_year'];
		return $result;
	}


	/***
	*
	* 	Get Annoymous Comments from a Movie
	*
	***/

	public function getMovieComments($id){
		$response = $this->basUrl()->get('films/'.$id);
		$response = $response->getBody();
		$apiResult = json_decode($response, true);
		$data =  $apiResult;		
		$result['movie_name'] = $data['title'];
		$result['opening_crawl'] = $data['opening_crawl'];
		$result['release_date'] = $data['release_date'];
		$result['comments'] = $this->query->getAllComments($id);
		return $result;
	}
}

?>