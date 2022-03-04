<?php
include_once('./_common.php');
include_once('./lib/SqlFormatter.php');

$title='페이지별 SQL 모음';
$no=$_GET['no'];
if( $no ){
	$row = sql_fetch("select * from sql_path where no=$no");
	$title = $row['title'];
	$uri=" (".$row['path'].")";
}
include_once('./_head.php');
?>
<h1><?=$title.$uri?></h1>
<table width="100%"> 
  <tr>
    <td width="500">
      <!-- {{ LEFT -->
        <table style="background-color:#f2f7f4">
        <?php
        $sql = "select * from sql_path order by ord, path";
        $list = sql_list($sql);
        $i=0;
        foreach($list as $row){
			$title=$row['title'];
			if($title) $title="<font color=blue>$title</font><br>";
	        $i++;
        ?>
        <tr>
	        <td width="20"><?=$i?></td>
	        <td width="*"><a href="?no=<?=$row['no']?>"><?=$title?><?=trim($row['path'])?></a></td>
        </tr>
        <?php
        }
        ?>
        </table>
      <!-- LEFT }} -->
    </td>
    <td width="*">
      <!-- {{ RIGHT -->
		<table>
		<?php
		$sql = "select * from sql_flow where path_no=$no order by no";
		$list = sql_list($sql);
		$i=0;
		foreach($list as $row){
			$sql=trim($row['sql']);
			$sql = SqlFormatter::format($sql);
			
			$i++;
		?>
  		<tr>
			<td width="20"><?=$i?></td>
			<td width="*"><span style="color:#c5c7c5"><?=$row['dt']?></span><br><pre><?=$sql?></pre></td>
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
