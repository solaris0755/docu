<?php
include_once('./_common.php');

function reset_token(){
	$token=uniqid();
	$sql="update token set id='$token', datetime=now()";
	sql_query($sql);
	return $token;
}
function token(){
	$sql = "select id from token where date_add(now(), interval -10 MINUTE )<datetime";
	$row = sql_fetch($sql);
	if($row){
		$token = $row['id'];
	}else{
		$token = reset_token();
	} 
	return $token;
}

// LOG 수집의 시작, 종료를 알린다.
if( $q=='reset' ){
	reset_token();
}
// LOG 를 수집한다.
elseif( $q=='log' ){
	$token = token();

	$post = serialize($_POST);

	// TODO : POST 체크
	$sql = "select no from pages where token='$token' and uri='$uri'";
	$row = sql_fetch($sql);
	if($row) {
		$page_no = $row[no];
	}else{
		$sql = "insert into pages set uri=?, token=?, post=?, dt=now()";
		if( $stmt = $mysqli->prepare($sql) ) {
			$stmt->bind_param('sss',$uri, $token, $post);
			$stmt->execute();
			$stmt->close();
		}
		$page_no = $mysqli->insert_id;
	}

	$uri = stripslashes($uri);
	$qry = stripslashes($qry);
	$sql = "insert into log set page_no=$page_no qry=?, dt=now()";
	if( $stmt = $mysqli->prepare($sql) ) {
    	$stmt->bind_param('sss',$qry);
    	$stmt->execute();
    	$stmt->close();
	}
}
