<?php
include_once('./_common.php');

$mysqli = $g5['connect_db'];

$sql = "select * from sql_log";
$list = sql_list($sql);
foreach($list as $row){
	//print_r($row);

	$sql = "select no from sql_path where path='{$row[uri]}'";
	$r = sql_fetch($sql);
	if( $r ) {
		$no=$r[no];
	}else{
		$sql = "insert into sql_path set path='{$row[uri]}'";
		sql_query($sql); 
		$no = mysqli_insert_id();
	}

	$s = addslashes($row[sql]);
	$sql = "insert into sql_flow (path_no,`sql`,dt) values ($no,'$s','{$row[dt]}')";
	echo $sql;
	sql_query($sql);
}
/*
MariaDB [erd]> select path from sql_path where no=35;
MariaDB [erd]> insert into sql_path (path,title) values ('_push_p_to_p_new.php','현장도착');
MariaDB [erd]> select LAST_INSERT_ID() ;
MariaDB [erd]> update sql_flow set path_no=37 where path_no=35 and dt='2021-04-26 17:02:14';

INSERT INTO sql_flow (path_no,`sql`,dt)
SELECT 39,TRIM(`sql`),dt FROM sql_log WHERE uri='__app_price_change_pop_apply_process.php'

*/
