<?php
header("Content-Type:application/json");
class jsonwrapper{
	public function success($status,$data){
		$response['method'] = $_SERVER['REQUEST_METHOD'];
		$response['status'] = $status;
		$response['msg'] = 'ok';
		$response['data'] = $data;
		return json_encode($response); 
	}

	public function error($status,$data){
		$response['method'] = $_SERVER['REQUEST_METHOD'];
		$response['status'] = $status;
		$response['msg'] = 'error';
		$response['error'] = $data;
		return json_encode($response); 
	}
}
?>