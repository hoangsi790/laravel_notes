<footer></footer>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{url('/')}}/js/jqueryui.js"></script>
<script src="{{url('/')}}/js/selectize.js"></script>

<script>
$('#background_wrapper_new_note label:first-child input').prop('checked', true );
$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')	} });
$('#create_group').click(function(){
	var name_group = $('#name_group').val();
	if(name_group=='') {
		alert('Vui lòng nhập tên nhóm !'); $('#name_group').focus();
	} else {
		$.post( "{{ url('/group/create') }}", { title:name_group }, function( data ) {
				if(data!='') {
					$('#group_wrapper').prepend(`
                           <li class='list-group-item group_item' > <a href='#' class='group_table_cell'>`+name_group+`</a>
						   <span class='group_options group_table_cell'>
						<span class='bg_carret dropdown-toggle'>
							<i class='fa fa-caret-down' aria-hidden='true'></i>
						</span>
					</span>
						   </li>
					`);
					$('#name_group').val('');
				} else {
					alert('Thất bại ! Xin vui lòng thử lại ! ');
				}
		});
	}
});
</script>

<script>
$(function() {
	$('#group').selectize({
		plugins: ['remove_button'],
		delimiter: ',',
		persist: false,
		create: function(input, callback){
			/* tạo group nhanh */
				var name_group = input;
				$.post( "{{ url('/group/create') }}", { title:name_group }, function( id_group ) {
					if(id_group!='') {
						$('#group_wrapper').prepend(`
						<li class='list-group-item group_item' id='`+id_group+`'> <a href='#' class='group_table_cell'>`+name_group+`</a>
						 <span class='group_options group_table_cell'>
						<span class='bg_carret dropdown-toggle'>
							<i class='fa fa-caret-down' aria-hidden='true'></i>
						</span>
					</span>
						</li>
						`);
						callback({ value: id_group, text: input });
					} else {
						alert('Thất bại ! Xin vui lòng thử lại ! ');
					}
				});
			/* kết thúc tạo group nhanh */
		}
	});
});
</script>
<script>
$(function() {
	$( '#note_order_wrapper').sortable({
		placeholder: 'col-sm-4 col-md-4 col-lg-3  ui-state-highlight',
		update: function (event, ui) {
				var arr_sort_note = new Array();
				$('#note_order_wrapper .note_order').each(function() {
					arr_sort_note.push($(this).attr("id"));
				});
				$('#arr_id_note').val(arr_sort_note);
				$.post('{{ url("/sort_note") }}', $('#sort_note').serialize())	
   		 }
	});
});
</script>



</body>
</html>