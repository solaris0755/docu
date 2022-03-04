<?php
include_once('./_common.php');

//$data = file_get_contents('/tmp/debug.20210813.log');
$data = $_POST['log'];
$data = stripslashes($data);
$arr = explode('[2021-08', $data);
foreach($arr as $str){
	list($a,$b) = explode('] /', $str);
	$dt = "2021-08".$a;
	list($uri, $sql, $t) = explode('#$#', $b);
	//print_r( explode('#$#', $b) );
	//echo "$uri, $sql,$t"; 
	$path = parse_url($uri, PHP_URL_PATH);
	//print_r( [$dt, $path, $sql] );
	work([$dt, $path, $sql]);
}
echo "OK\n";


function work($in){
	global $mysqli;
	$qry = "insert into sql_log (dt,uri,`sql`) values (?,?,?)";
	if( $stmt = $mysqli->prepare($qry) ) {
    	$stmt->bind_param('sss',$in[0], $in[1], $in[2]);
    	$stmt->execute();
    	$stmt->close();
	}
}
