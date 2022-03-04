<?php
include_once('./_common.php');

$title='테이블목록';
$t = $_GET[t];
if( $t ){
	$title = "$t 테이블 정보";
}
include_once('./_head.php');
?>
<style>
.frm_input{height:35px;width:200px;line-height:32px;border:1px solid #d5d5d5;} 
span.editon { 
	padding: 4px 4px; 
	border: 1px solid #D6D6D6; 
	border-radius: 4px; 
} 
</style>

<script>
var origin_datas = {};

function get_tables(){
    $.ajax({
        url: 'tables.ajax.php?search='+$('#search').val(),
        success: function(html){
			$('#left_table').html(html);
			edit_fn();
        }
    });
}
function search_columns(){
    $.ajax({
        url: 'cols.ajax.php?search='+$('#search').val(),
        success: function(html){
			$('#right_table').html(html);
            edit_fn();
        }
    });
}
function get_columns(table_name){
    $.ajax({
        url: 'columns.ajax.php?table_name='+table_name,
        success: function(html){
			$('#right_table').html(html);
			edit_fn();
        }
    });
}
function edit_fn(){
    $(".editor").click(function(){
		var el = $(this);
		console.log('click -> ' + el.attr('contenteditable') ) ;
		if( el.attr('contenteditable')=='true' ) return;

		console.log('1');

		// 편집하기전의 스트링을 보관하고있자.
		origin_datas[ el.attr('id') ] = el.text();
		//console.log(el.attr('id'));
		//console.log(el.text() );
        //el.attr('contenteditable','true').addClass('editon');
        el.attr('contenteditable','true');
		el.keypress(function(e){
			if(e.which===13){
				e.preventDefault();
				el.blur();
				el.off('keypress'); // 핸들러를 제거한다.
			}
		});
		el.blur( function(){
        	el.attr('contenteditable','false');
			//el.removeClass('editon');
			console.log('blur'+ Math.random().toString(36));
			// 변경사항이 있을때만 ajax 호출
			if( origin_datas[ el.attr('id') ] != el.text() ){
				edit_save(el.attr('id'), el.text());
			}
			el.off('blur');// 핸들러를 제거한다.(제거안하면 클릭할때마다 핸들러가 추가되어 여러번 호출된다)
		});

    });
}
function edit_save(id,text){
	var ca = 'table';
	if( id.indexOf('|') !=-1 ) ca='column';
	
    $.ajax({
        url: 'edit.json.php',
		type: 'POST',
		dataType: 'json',
		data: {
            'ca' : ca,
			'id' : id,
			'memo' : text
		},
        success: function(result){
        }
    });
}
$(function(){
	get_tables();

	$("#search").keyup( function(){
		//if( $("#search").val().length <2 ) return;
		get_tables();
		search_columns();
	});
});
</script>

<!-- <h1><?=$title?></h1> -->

<table width="100%" border="0">
  <tr>
	<td colspan="2" align="left">
		<div class="ui-widget">
  		<input id="search" class="frm_input" placeholder="검색어">
		</div>
	</td>
  </tr>
  <tr>
    <td width="600" id="left_table">
    </td>
    <td width="*" id="right_table">
    </td>
  </tr>
</table>
<?php
include_once('./_tail.php');
?>
