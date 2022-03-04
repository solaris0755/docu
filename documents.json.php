<?php
include_once('./_common.php');

$ca=$_GET["ca"];
$item=$_GET["item"];
$sql = "select * from documents where ca='$ca' && name like '%$item%' limit 20";
$list = sql_list($sql);
$out = [];
foreach($list as $row){
	$out[]=array(
		"id"	=> $row["name"],
		"label"	=> $row["name"],
		"value"	=> $row["memo"]
	);
}
echo json_encode($out);
