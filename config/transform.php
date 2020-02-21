<?php
class transform {

	 function getAll($value){
	 	$theight = $this->total_height($value['characters']);
		$meta['no_of_characters'] = sizeof($value['characters']);
		$meta['total_height_of_characters (cm)'] = $theight.'cm'; 
		$meta['total_height_of_characters (ft/inch)']  = $this->height_feet($theight);
		$result['meta'] = $meta;
		$result['data'] = $value;
		return $result;
	 }



	 function total_height($array){
		return array_sum(
			array_map(function($item) { return $item['height']; }, $array)
		);
	}



	function height_feet($value){
		$data = $value / 30.48;
		$format = explode('.', $data);
		$result = $format[0].'feet '.sprintf("%0.3s",$format[1]).'inches';
		return $result;
	}



	function sortASC($array,$field){
		usort($array, function($a, $b) {
	    	return $a['name'] > $b['name'];
		});
		return $array;
	}



	function sortDESC($array,$field){
		usort($array, function($a, $b) {
	    	return $a['name'] < $b['name'];
		});
		return $array;
	}

	
}
?>