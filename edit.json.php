<?php
include_once('./_common.php');

$ca=$_POST['ca'];
$id=$_POST["id"];
$memo=trim($_POST['memo']);
list($name, $ref) = explode('|', $id);
$sql = "update documents set memo='$memo' where ca='$ca' and name='$name' and ref='$ref'";
sql_query($sql);
