<?php
include_once('./_common.php');

$search=$_GET["search"];
?>
<div style="overflow:auto;">

<table> 
<thead>
<tr>
	<th colspan="3">테이블목록</th>
</tr>
</thead>
<tbody>
<tr>
    <td width="20">No</td>
    <td width="120">테이블명</td>
    <td width="*">설명</td>
</tr>
<?php
$search_sql = "";
if( $search ) $search_sql=" and ( name like '%$search%' or memo like '%$search%' ) ";
$sql = "select * from documents where ca='table' $search_sql";
$list = sql_list($sql);
$i=0;
foreach($list as $row){
    $i++;
	$col=''; if($i%2) $col="#bbfcb3";
	if($row['name']==$t) $col="#f590f1";
	$memo = trim($row['memo']);
	if(!$memo) $memo='.....';
?>
<tr style="background-color:<?=$col?>">
    <td width="20"><?=$i?></td>
    <td width="120"><a href="javascript:get_columns('<?=$row['name']?>');"><?=$row['name']?></a></td>
    <td width="*"><span id="<?=$row['name']?>" class="editor"><?=htmlspecialchars($memo)?></span></td>
</tr>
<?php
}
?>
</tbody>
</table>

</div>
