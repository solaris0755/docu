<?php
include_once('./_common.php');

$search=$_GET["search"];
$list=[];
if( $search ){
	$sql = "select * from documents where ca='column' and ( name like '%$search%' or memo like '%$search%' ) limit 30";
	$list = sql_list($sql);
}
?>
<table>
<thead>
<tr>
	<th colspan="4">컬럼목록</th>
</tr>
</thead>
<tbody>
<tr>
    <td width="20">No</td>
    <td width="120">테이블명</td>
    <td width="120">컬럼명</td>
    <td width="*">설명</td>
</tr>
<?php
$i=0;
foreach($list as $row){
    $i++;
	$col=''; if($i%2) $col="#e6ecf5";

	$memo = $row[memo];
	if( !$memo ) $memo = '.....';
?>
<tr style="background-color:<?=$col?>">
    <td width="20"><?=$i?></td>
    <td width="120"><?=$row['ref']?></td>
    <td width="120"><?=$row['name']?></td>
    <td width="*"><span id="<?=$row['name']?>|<?=$row['ref']?>" class="editor"><?=htmlspecialchars($memo)?></span></td>
</tr>
<?php
}
?>
</tbody>
</table>
