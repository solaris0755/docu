<?php
include_once('./_common.php');
include_once('./lib/SqlFormatter.php');

$title='SQL 모음';
include_once('./_head.php');
?>
<h1><?=$title.$uri?></h1>
<table width="100%"> 
  <tr>
    <td width="500">
      <!-- {{ LEFT -->
        <table style="background-color:#f2f7f4">
        </table>
      <!-- LEFT }} -->
    </td>
    <td width="*">
      <!-- {{ RIGHT -->
		<table>
		<?php
		$sql = "select * from sql_log where dt>curdate() order by no desc limit 1000";
		$list = sql_list($sql);
		$i=0;
		foreach($list as $row){
			$sql=trim($row['sql']);
			$sql = SqlFormatter::format($sql);
			
			$i++;
		?>
  		<tr>
			<td width="20"><?=$i?></td>
			<td width="*"><span style="color:#c5c7c5"><?=$row[dt]?></span><br><pre><?=$sql?></pre></td>
  		</tr>
		<?php
		}
		?>
		</table>
      <!-- RIGHT }} -->
    </td>
  </tr>
</table>
<?php
include_once('./_tail.php');
?>
