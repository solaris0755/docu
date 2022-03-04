<?php
namespace PHPSQLParser;
include_once('./_common.php');
require_once 'lib/PHP-SQL-Parser/vendor/autoload.php';

$sql = "select uri, `sql` from sql_log"; 
$list = sql_list($sql);
foreach($list as $row){
	$uri = $row["uri"];
	$table_list = work($row["sql"]);

	//$maps[$uri] += $table_list;
	//if( !$table_list ) die($row["sql"]);
	echo "$uri => ". implode(",", $table_list) ."\n";
}
//print_r($maps);

//$sql = "select 1 from dual";
//$list = work($sql);
//print_r($list);

function work($sql){
	$parser = new PHPSQLParser($sql, true);
	$r = $parser->parsed;
	print_r($r);
	$table_list = [];
	// select , delete
	foreach( $r["FROM"] as $v){
		$table_list[]= $v["table"];
	}
	// update
	foreach( $r["UPDATE"] as $v){
		$table_list[]= $v["table"];
	}
	// insert
	foreach( $r["INSERT"] as $v){
		if( $v["expr_type"]=="table" )
			$table_list[]= $v["table"];
	}

	return $table_list;

}
