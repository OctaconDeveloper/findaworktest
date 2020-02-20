 <?php
const servername = "127.0.0.1";
const username = "root";
const password = "";
const database = "findawork";
class query{

function dbConnect(){
	$conn = new mysqli(servername, username, password);
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function getCommentCount($sql){
	$act=username;
	$ht=servername;
	$ky=password;
	$db=database;
	$conn=mysqli_connect($ht,$act,$ky,$db);
	$b="SELECT count(*) as total FROM ".$db.".comments WHERE movie_id = ? ";
	$stmt = $conn->prepare($b);
	$stmt->bind_param('s',$sql);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($total);
	$stmt->store_result();
	if($stmt->num_rows > 0){
		$stmt->fetch();
		return $total;
	}else{
		return 0;
	}
	$stmt->close();
}

function addComment($sql1,$sql2,$sql3,$sql4,$sql5,$sql6){
	$act=username;
	$ht=servername;
	$ky=password;
	$db=database;
	$conn=mysqli_connect($ht,$act,$ky,$db);
	date_default_timezone_set('UTC');
	$date = date('Y-d-mTG:i:sz', time());
	$ip = $_SERVER['REMOTE_ADDR'];
	$b="INSERT INTO ".$db.".comments (movie_id,user_id,comment,name,gender,date_of_birth,ipaddress,post_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
	$stmt = $conn->prepare($b);
	$stmt->bind_param('ssssssss',$sql1,$sql2,$sql3,$sql4,$sql5,$sql6,$ip,$date);
	$stmt->execute();
	$stmt->store_result();
	// $stmt->close();

	return $stmt->insert_id;
}

function getSingleComment($sql1){
	$act=username;
	$ht=servername;
	$ky=password;
	$db=database;
	$conn=mysqli_connect($ht,$act,$ky,$db);
	$b="SELECT * FROM ".$db.".comments WHERE id = ?";
	$stmt = $conn->prepare($b);
	$stmt->bind_param('i',$sql1);
	$stmt->execute();
	$res=$stmt->get_result();
	while($row=$res->fetch_assoc()){
		return $row;
	}
}

function getAllComments($sql1){
	$act=username;
	$ht=servername;
	$ky=password;
	$db=database;
	$conn=mysqli_connect($ht,$act,$ky,$db);
	$b="SELECT name,gender,date_of_birth,comment,ipaddress,post_date FROM ".$db.".comments WHERE movie_id = ? ORDER BY id DESC";
	$stmt = $conn->prepare($b);
	$stmt->bind_param('s',$sql1);
	$stmt->execute();
	$res=$stmt->get_result();
	while($row=$res->fetch_assoc()){
		$resultSet[] = $row;
	}
	if(!empty($resultSet)){
		return $resultSet;
	}else{
		return 0;
	}
	$stmt->close();
}

function getIP(){
	if(!empty(getenv('HTTP_CLIENT_IP'))){
		$ip = getenv('HTTP_CLIENT_IP');
	}elseif(!empty(getenv('HTTP_X_FORWARDED_FOR'))){
		$ip = getenv('HTTP_X_FORWARDED_FOR');
	}else{
		$ip = getenv('REMOTE_ADDR');
	}
	return $ip;
}

}
?> 