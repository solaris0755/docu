<?php
include_once('./_common.php');

$table_name=$_GET["table_name"];
?>
<table>
<thead>
<?php
$list=[];
if( $table_name ){
	$sql = "select * from documents where ca='column' and ref='$table_name'";
	$list = sql_list($sql);
}
if($list) $tt = "$table_name 컬럼목록";
?>
<tr>
	<th colspan="3"><?=$tt?></th>
</tr>
</thead>
<tbody>
<?php
$i=0;
foreach($list as $row){
    $i++;
	$col=''; if($i%2) $col="#e6ecf5";
	$memo = trim($row['memo']);
	if(!$memo) $memo='.....';
?>
<tr style="background-color:<?=$col?>">
    <td width="20"><?=$i?></td>
    <td width="120"><?=$row['name']?></td>
    <td width="*"><span id="<?=$row['name']?>|<?=$row['ref']?>" class="editor"><?=htmlspecialchars($memo)?></span></td>
</tr>
<?php
}
?>
</tbody>
</table>
