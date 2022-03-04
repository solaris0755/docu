<?php
include_once('./_common.php');

$item=$_GET["item"];
$sql = "select * from erd_tables where table_name like '%$item%' limit 20";
$list = sql_list($sql);
$out = [];
foreach($list as $row){
	$out[]=array(
		"id"	=> $row["table_name"],
		"label"	=> $row["table_name"],
		"value"	=> $row["table_comment"]
	);
}
echo json_encode($out);
