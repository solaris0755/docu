<?php
include_once('./_common.php');
include_once('./lib/SqlFormatter.php');

$title = '스카이뺑뺑';
$no = $_GET[no];
?>
<!DOCTYPE html>
<html>
<head>
    <title>SqlFormatter Examples</title>
    <style>
        body {
            font-family: arial;
			font-size:12px;
        }

        table, td, th {
            border: 1px solid #aaa;
        }

        table {
            border-width: 1px 1px 0 0;
            border-spacing: 0;
        }

        td, th {
            border-width: 0 0 1px 1px;
            padding: 5px 10px;
            vertical-align: top;
        }

        pre {
            padding: 0;
            margin: 0;
        }
    </style>
</head>
<body>
<h1><?=$title?></h1>
<hr>
<table>
<?php
$sql = "select * from sql_flow where path_no=$no";
$list = sql_list($sql);
$i=0;
foreach($list as $row){
	$sql=trim($row['sql']);
	$sql = SqlFormatter::format($sql);
	
	$i++;
?>
  <tr>
	<td width="20"><?=$i?></td>
	<td width="*"><pre><?=$sql?></pre></td>
  </tr>
<?php
}
?>
</table>
