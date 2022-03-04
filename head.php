<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$title?></title>
  <link rel="stylesheet" type="text/css" href="/css/style.css" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#menu" ).menu();
  } );
  </script>
  <style>
  .ui-menu { width: 150px; }
  </style>
</head>
<body>

<table width="100%">
<tr> 
  <td style="background-color:#f0f4fa">
  <a href="/tables.php">테이블목록</a>&nbsp; |&nbsp;
  <a href="/objects.php?on=file">WebFile</a>&nbsp; |&nbsp;
  <a href="/objects.php?on=api">WebAPI</a>&nbsp; |&nbsp;
  <a href="/objects.php?on=app">AppMethod</a>&nbsp; |&nbsp;
  <a href="/objects.php?on=javascript">Javascript</a>&nbsp; |&nbsp;
  <a href="/objects.php?on=cookie">Cookie</a>&nbsp; |&nbsp;
  <a href="/objects.php?on=session">Session</a>&nbsp; |&nbsp;
  <a href="/pagesql.php">페이지별 SQL</a> &nbsp;|&nbsp; 
  <a href="/sqllog.php">로그</a>
  </td>
</tr>
</table>

<br />
