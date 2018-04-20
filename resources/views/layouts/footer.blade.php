<footer></footer>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{url('/')}}/js/jqueryui.js"></script>
<script src="{{url('/')}}/js/selectize.js"></script>
<script src='https://cdn.rawgit.com/naptha/tesseract.js/1.0.10/dist/tesseract.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.selection/1.0.1/jquery.selection.min.js"></script>


 <script>
 
 
 
 $('#search').on('input',function(){
    var get_val =  $('#search').val();
	if(get_val!='') {
		$('#search_result').show();
			$.post( "{{ url('/search') }}", { title : get_val }, function( data ) {
					//alert(data);
				if(data=='') {
						$('#tra_rs li').remove();
						 $('#tra_rs').append('<li class="nav-header">Kết quả tìm kiếm</li>');
					$('#tra_rs').append('<li>Không có kết quả!</li>');
				
			
				} else {
				
					
									//	$('#search_result').show();
										
										data.forEach(function(index){
												 var  get_each_data = `<li><a href="{{ url('/') }}/note/` + index.id + `/edit">` + index.title + `: ` + index.content +`</a></li>`;
												
												$('#tra_rs li').remove();
												 $('#tra_rs').append('<li class="nav-header">Kết quả tìm kiếm</li>');
												 $('#tra_rs').append(get_each_data);
												
										})
					
				 
				 
				}
			});
		
	} else {
		$('#search_result').hide();
	}
});
 
 
 
$('#search').on('keypress',function(e){
	var p = e.which;
     if(p==13){
	e.preventDefault();

		
		 var get_val =  $('#search').val();
	if(get_val!='') {
		$('#search_result').show();
			$.post( "{{ url('/search') }}", { title : get_val }, function( data ) {
					//alert(data);
				if(data=='') {
					
					$('#tra_rs li').remove();
						 $('#tra_rs').append('<li class="nav-header">Kết quả tìm kiếm</li>');
					$('#tra_rs').append('<li>Không có kết quả!</li>');
				
			
				} else {
				
					
									//	$('#search_result').show();
										
										data.forEach(function(index){
												 var  get_each_data = `<li><a href="{{ url('/') }}/note/` + index.id + `/edit">` + index.title + `: ` + index.content +`</a></li>`;
												$('#tra_rs li').remove();
												 $('#tra_rs').append('<li class="nav-header">Kết quả tìm kiếm</li>');
												 $('#tra_rs').append(get_each_data);
												
										})
					
				 
				 
				}
			});
		
	} else {
		$('#search_result').hide();
	}
		
		
		 }
 });
 
 
 
 
 
 
 
 $('#fileInput').click(function(){
	 $('#translate_tr').val('');
});

$(window).load(function() {
  	$('#title').focus();
});

 
 
        document.addEventListener('DOMContentLoaded', function(){
            var fileInput = document.getElementById('fileInput');
            fileInput.addEventListener('change', handleInputChange);
        });
		
		
	
		

        function handleInputChange(event){
			
            var input = event.target;
            var file = input.files[0];
            console.log(file);
            Tesseract.recognize(file, {
				lang: 'jpn'
				})
                .progress(function(message){
					 $('.loading_tr2').show();
					 $('.loading_tr3').show();
                    console.log(message);
                })
               .then(function(result) {
				   
				   $('.loading_tr2').hide();
		
				   
				  var contentArea = document.getElementById('translate_tr');
				  contentArea.innerHTML = result.text;
				 //  $('#translate_tr').text(contentArea);
				   $('#translate_tr').val(contentArea.innerHTML);
				   
				   
				   
				    if($('#translate_tr').val()!='') {
						
						 
						 $.post( "{{ url('/translates') }}", { translate : contentArea.innerHTML }, function( data ) {
								if(data!='') {
									$('.loading_tr3').hide();
									$('#result_tr').val(data);
								} else {	
								}
						});
					}
				   
				   
				   
				   
				   
				   
				})
                .catch(function(err){
                    console.error(err);
                });
        }
    </script>



<script>
$('#background_wrapper_new_note label:first-child input').prop('checked', true );
$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')	} });


$('#remove_add_fl').click(function(e){
	$('#form_add_fl').find('#title').val('');
	$('#form_add_fl').find('#content').val('');
	 var $select = $('#group').selectize(); var control = $select[0].selectize; control.clear();
	 $('#form_add_fl').find('#title').focus(); 
});

$('#btn_add_fl').click(function(e){
	e.preventDefault();
	var title = $('#form_add_fl').find('#title').val();
	var content = $('#form_add_fl').find('#content').val();
	var group = $('#form_add_fl').find('#group').val();
	// console.log(group);
	// var xxx  = $('.selectize-input .item').text();
	// alert(xxx);
	
	if(title=='') { 
		alert('Bạn phải nhập mẫu câu!'); $('#form_add_fl').find('#title').focus(); 
	} else if (content=='') {
		alert('Bạn phải nhập ý nghĩa!'); $('#form_add_fl').find('#content').focus(); 
		 } else {
		
  	$.post( "{{ url('/note/check_exist') }}", { title : title }, function( data ) {
				if(data=='') {
					 // chèn
					 
					 
					 $.post( "{{ url('/note/create_ajax') }}", {  title : title, content : content, group : group }, function( data ) {
								if(data!='') {
								//	alert('Thành công !');
								var append_name_group_last = '';
								/*if(group.length>0) {
									for(i=0; i<=group.length;i++) {
									var append_name_group =	`<a href="http://127.0.0.1:8000/group/`+group[i]+`/get_note" class="  c_get_note label label-primary" id="`+group[i]+`" style="text-transform:none;font-size:12px;color:#fff;background:#555;">`+group[i]+`</a>`;
									append_name_group_last  = append_name_group_last + append_name_group 
									}
								} */
								
								
								$('#form_add_fl').after(`
								
								<tr>
            <td style="text-align:center; vertical-align:middle;">0</td>
            <td class="tiengnhat"><span class="flag_edit_sentence" contenteditable="false" flag="title" sentence_id="`+ data +`">`+ title +`</span></td>
            <td><span class="flag_edit_sentence" contenteditable="false" flag="content" sentence_id="`+ data +`">`+ content +`</span></td>
            <td><div class="note_group_wrapper">
             
			 
			<small>Vui lòng   </small> <a href="" class="btn btn-primary" style="padding:2px 5px; color:#fff;line-height:1;">Tải lại</a> để cập nhật nhóm!
			 
              
			  
			  
			  
                                                        </div></td>
            <td style="text-align:center;"><a href="http://127.0.0.1:8000/note/`+ data +`/edit" class="btn btn-warning" style="padding:2px 5px; color:#fff;line-height:1;">
            <span class="iconfa-pencil"></span></a> <a href="http://127.0.0.1:8000/note/`+ data +`/trash" onclick="return confirm('Bạn chắc chắn xóa ?')" class="btn btn-danger trash_note" style="padding:2px 5px; color:#fff;line-height:1;"><span class=" iconfa-trash"></span></a></td>
        </tr>
								
								`);
								
								
								$('#form_add_fl').find('input').val('');
								$('#form_add_fl').find('#title').focus();
								  <?php if(isset($get_id_group) and $get_id_group != '') { } else { ?> 
								   var $select = $('#group').selectize(); var control = $select[0].selectize; control.clear();
								  <?php } ?> 
									
									 
									 
								} else { alert('Thất bại ! Xin vui lòng thử lại ! ');}
					}); 
					 
					 
					 
					 
					 
				} else if(data!='') {	
					 if (confirm("Mẫu ví dụ này đã tồn tại phần tiếng Nhật:\n"+data+"\nBạn có muốn tiếp tục thêm vào?") == true) { 
					 
					 
					 
					 
					 
					 
					 
					 
					 $.post( "{{ url('/note/create_ajax') }}", {  title : title, content : content, group : group }, function( data ) {
								if(data!='') {
								//	alert('Thành công !');
								var append_name_group_last = '';
								/*if(group.length>0) {
									for(i=0; i<=group.length;i++) {
									var append_name_group =	`<a href="http://127.0.0.1:8000/group/`+group[i]+`/get_note" class="  c_get_note label label-primary" id="`+group[i]+`" style="text-transform:none;font-size:12px;color:#fff;background:#555;">`+group[i]+`</a>`;
									append_name_group_last  = append_name_group_last + append_name_group 
									}
								} */
								
								
								$('#form_add_fl').after(`
								
								<tr>
            <td style="text-align:center; vertical-align:middle;">0</td>
            <td class="tiengnhat"><span class="flag_edit_sentence" contenteditable="false" flag="title" sentence_id="`+ data +`">`+ title +`</span></td>
            <td><span class="flag_edit_sentence" contenteditable="false" flag="content" sentence_id="`+ data +`">`+ content +`</span></td>
            <td><div class="note_group_wrapper">
             
			 
			<small>Vui lòng   </small> <a href="" class="btn btn-primary" style="padding:2px 5px; color:#fff;line-height:1;">Tải lại</a> để cập nhật nhóm!
			 
              
			  
			  
			  
                                                        </div></td>
            <td style="text-align:center;"><a href="http://127.0.0.1:8000/note/`+ data +`/edit" class="btn btn-warning" style="padding:2px 5px; color:#fff;line-height:1;">
            <span class="iconfa-pencil"></span></a> <a href="http://127.0.0.1:8000/note/`+ data +`/trash" onclick="return confirm('Bạn chắc chắn xóa ?')" class="btn btn-danger trash_note" style="padding:2px 5px; color:#fff;line-height:1;"><span class=" iconfa-trash"></span></a></td>
        </tr>
								
								`);
								
								
								$('#form_add_fl').find('input').val('');
								$('#form_add_fl').find('#title').focus();
								  <?php if(isset($get_id_group) and $get_id_group != '') { } else { ?> 
								   var $select = $('#group').selectize(); var control = $select[0].selectize; control.clear();
								  <?php } ?> 
									
									 
									 
								} else { alert('Thất bại ! Xin vui lòng thử lại ! ');}
					}); 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					  } else {  $('#title').focus(); return false; }
				}
		});
		
	
			
		}
		
		
		
});








 <?php if(isset($get_id_group) and $get_id_group != '') { ?> 

/* ================================ */

$('#content').on('keypress',function(e){
	var p = e.which;
     if(p==13){
	e.preventDefault();
	var title = $('#form_add_fl').find('#title').val();
	var content = $('#form_add_fl').find('#content').val();
	var group = $('#form_add_fl').find('#group').val();
	// console.log(group);
	// var xxx  = $('.selectize-input .item').text();
	// alert(xxx);
	
	if(title=='') { 
		alert('Bạn phải nhập mẫu câu!'); $('#form_add_fl').find('#title').focus(); 
	} else if (content=='') {
		alert('Bạn phải nhập ý nghĩa!'); $('#form_add_fl').find('#content').focus(); 
		 } else {
		
  	$.post( "{{ url('/note/check_exist') }}", { title : title }, function( data ) {
				if(data=='') {
					 // chèn
					 
					 
					 $.post( "{{ url('/note/create_ajax') }}", {  title : title, content : content, group : group }, function( data ) {
								if(data!='') {
								//	alert('Thành công !');
								var append_name_group_last = '';
								/*if(group.length>0) {
									for(i=0; i<=group.length;i++) {
									var append_name_group =	`<a href="http://127.0.0.1:8000/group/`+group[i]+`/get_note" class="  c_get_note label label-primary" id="`+group[i]+`" style="text-transform:none;font-size:12px;color:#fff;background:#555;">`+group[i]+`</a>`;
									append_name_group_last  = append_name_group_last + append_name_group 
									}
								} */
								
								
								$('#form_add_fl').after(`
								
								<tr>
            <td style="text-align:center; vertical-align:middle;">0</td>
            <td class="tiengnhat"><span class="flag_edit_sentence" contenteditable="false" flag="title" sentence_id="`+ data +`">`+ title +`</span></td>
            <td><span class="flag_edit_sentence" contenteditable="false" flag="content" sentence_id="`+ data +`">`+ content +`</span></td>
            <td><div class="note_group_wrapper">
             
			 
			<small>Vui lòng   </small> <a href="" class="btn btn-primary" style="padding:2px 5px; color:#fff;line-height:1;">Tải lại</a> để cập nhật nhóm!
			 
              
			  
			  
			  
                                                        </div></td>
            <td style="text-align:center;"><a href="http://127.0.0.1:8000/note/`+ data +`/edit" class="btn btn-warning" style="padding:2px 5px; color:#fff;line-height:1;">
            <span class="iconfa-pencil"></span></a> <a href="http://127.0.0.1:8000/note/`+ data +`/trash" onclick="return confirm('Bạn chắc chắn xóa ?')" class="btn btn-danger trash_note" style="padding:2px 5px; color:#fff;line-height:1;"><span class=" iconfa-trash"></span></a></td>
        </tr>
								
								`);
								
								
								$('#form_add_fl').find('input').val('');
								$('#form_add_fl').find('#title').focus();
								  <?php if(isset($get_id_group) and $get_id_group != '') { } else { ?> 
								   var $select = $('#group').selectize(); var control = $select[0].selectize; control.clear();
								  <?php } ?> 
									
									 
									 
								} else { alert('Thất bại ! Xin vui lòng thử lại ! ');}
					}); 
					 
					 
					 
					 
					 
				} else if(data!='') {	
					 if (confirm("Mẫu ví dụ này đã tồn tại phần tiếng Nhật:\n"+data+"\nBạn có muốn tiếp tục thêm vào?") == true) { 
					 
					 
					 
					 
					 
					 
					 
					 
					 $.post( "{{ url('/note/create_ajax') }}", {  title : title, content : content, group : group }, function( data ) {
								if(data!='') {
								//	alert('Thành công !');
								var append_name_group_last = '';
								/*if(group.length>0) {
									for(i=0; i<=group.length;i++) {
									var append_name_group =	`<a href="http://127.0.0.1:8000/group/`+group[i]+`/get_note" class="  c_get_note label label-primary" id="`+group[i]+`" style="text-transform:none;font-size:12px;color:#fff;background:#555;">`+group[i]+`</a>`;
									append_name_group_last  = append_name_group_last + append_name_group 
									}
								} */
								
								
								$('#form_add_fl').after(`
								
								<tr>
            <td style="text-align:center; vertical-align:middle;">0</td>
            <td class="tiengnhat"><span class="flag_edit_sentence" contenteditable="false" flag="title" sentence_id="`+ data +`">`+ title +`</span></td>
            <td><span class="flag_edit_sentence" contenteditable="false" flag="content" sentence_id="`+ data +`">`+ content +`</span></td>
            <td><div class="note_group_wrapper">
             
			 
			<small>Vui lòng   </small> <a href="" class="btn btn-primary" style="padding:2px 5px; color:#fff;line-height:1;">Tải lại</a> để cập nhật nhóm!
			 
              
			  
			  
			  
                                                        </div></td>
            <td style="text-align:center;"><a href="http://127.0.0.1:8000/note/`+ data +`/edit" class="btn btn-warning" style="padding:2px 5px; color:#fff;line-height:1;">
            <span class="iconfa-pencil"></span></a> <a href="http://127.0.0.1:8000/note/`+ data +`/trash" onclick="return confirm('Bạn chắc chắn xóa ?')" class="btn btn-danger trash_note" style="padding:2px 5px; color:#fff;line-height:1;"><span class=" iconfa-trash"></span></a></td>
        </tr>
								
								`);
								
								
								$('#form_add_fl').find('input').val('');
								$('#form_add_fl').find('#title').focus();
								  <?php if(isset($get_id_group) and $get_id_group != '') { } else { ?> 
								   var $select = $('#group').selectize(); var control = $select[0].selectize; control.clear();
								  <?php } ?> 
									
									 
									 
								} else { alert('Thất bại ! Xin vui lòng thử lại ! ');}
					}); 
					 
					 
					 
				
					 
					 
					  } else {  $('#title').focus(); return false; }
				}
		});
		
	
			
		}
	 }
		
		
});


/* =============================== */


  <?php } ?> 



































$('#empty_tr').click(function(){
	$('#translate_tr').val('');
	$('#result_tr').val('');
	$('#translate_tr').focus();
})

$('.tiengnhat').on('click', function(e){
  var get_select  = $.selection();

	 if(get_select!='') {
		 $('#translate_tr').val('');
		  $('#translate_tr').val(get_select);
		  $('.loading_tr3').show();
		 $.post( "{{ url('/translates') }}", { translate : get_select }, function( data ) {
				if(data!='') {
					$('.loading_tr3').hide();
					$('#result_tr').text(data);
				} else {	
				}
		});
	}
 	

 
});











$("#translate_tr").bind('paste', function(e) {
	setTimeout(function(){ 
	$('.loading_tr3').show();
	var translate = $('#translate_tr').val();

	$.post( "{{ url('/translates') }}", { translate : translate }, function( data ) {
				if(data!='') {
					$('.loading_tr3').hide();
					$('#result_tr').text(data);
				} else {	
				}
		});
	}, 100);

});

$('#btn_dich').click(function(e){
var translate = $('#translate_tr').val();

if(translate!='') {
	$('.loading_tr3').show();
$.post( "{{ url('/translates') }}", { translate : translate }, function( data ) {
				if(data!='') {
					$('.loading_tr3').hide();
					$('#result_tr').text(data);
				} else {	
				}
		});
} else {
	alert('Bạn phải nhập dữ liệu vào khung!');
	 $('#translate_tr').focus();
}
});


$('#btn_new_note').click(function(e){
	e.preventDefault();
	var title = $('#new_note').find('#title').val();
	var content = $('#new_note').find('#content').val();
	/*var content_vi = $('#new_note').find('#content_vi').val();*/
	var title_ja = $('#new_note').find('#title_ja').val();
	/*var content_ja = $('#new_note').find('#content_ja').val();*/
	
	if(title=='') {
		alert('Bạn phải nhập dữ liệu vào khung!');
	 	$('#title').focus();
	}  else if(content=='') {
		alert('Bạn phải nhập dữ liệu vào khung!');
		$('#content').focus();
	} else if(title_ja=='') {
		$('#tab_add li').removeClass('active');
		$('#tab_add li:last-child').addClass('active');
		$('.tab-pane').removeClass('active');
		$('.tab-content #B').addClass('active');
		alert('Bạn phải nhập dữ liệu vào khung!');
	 	$('#title_ja').focus();
	} else {
		$.post( "{{ url('/note/check_exist') }}", { title : title }, function( data ) {
					// alert(data);
					if(data=='') {
						 $('#new_note').submit();
					} else if(data!='') {	
						 if (confirm("Mẫu ví dụ này đã tồn tại phần tiếng Nhật:\n"+data+"\nBạn có muốn tiếp tục thêm vào?") == true) { $('#new_note').submit(); } else {  $('#title').focus(); return false; }
					}
			});
	}
		
		
		
});


$('.flag_edit_sentence').dblclick(function() {
	


    $(this).prop('contenteditable', true);
   $(this).focus();
    $(this).css('outline', '1px solid #f00');
	
	
	
	
	
	
	
});
$('.flag_edit_sentence').stop().blur(function() {
    $(this).prop('contenteditable', false);
    $(this).css('outline', 'none');
    var sentence_id = $(this).attr('sentence_id');
	var sentence = $(this).text();
	var flag =  $(this).attr('flag');
	
	 $.post( "{{ url('/note/"+sentence_id+"/update_note_ajax') }}", {flag : flag, id : sentence_id,  sentence : sentence }, function( data ) {
				if(data!='') {
					// alert(data);
				} else {
					alert('Thất bại ! Xin vui lòng thử lại ! ');
				}
		});
	

});











$('.btn_edit_group').click(function() {
    $(this).closest('span.option_group').prev('a.flag_edit').prop('contenteditable', true);
    $(this).closest('span.option_group').prev('a.flag_edit').focus();
    $(this).closest('span.option_group').prev('a.flag_edit').css({
		'outline' : '1px solid #f00',
		'background' : '#fff',
		 'cursor': 'text'
	}); 
});
$('.flag_edit').stop().blur(function() {
	
    $(this).prop('contenteditable', false);
	$(this).css({
		'outline' : 'none',
		'background' : 'none',
		 'cursor': 'pointer'
	}); 
    var group_id = $(this).attr('post_id');
	var name_group = $(this).text();

	var old_value = $(this).attr('old_value');

if(old_value==name_group) {} else {

$.post( "{{ url('/group/check_exist_group') }}", { title : name_group }, function( data ) {
				
				if(data=='') {
							 $.post( "{{ url('/group/"+group_id+"/update') }}", { id : group_id,  title : name_group }, function( data ) {
								if(data!='') {} else { alert('Thất bại ! Xin vui lòng thử lại ! ');}
							}); 
				} else if(data!='') {	
					
					 $.post( "{{ url('/group/"+group_id+"/update') }}", { id : group_id,  title : name_group+'_Copy' }, function( data ) {
								if(data!='') {
									
									var txt_curent = $('#'+group_id).text();
									$('#'+group_id).text(txt_curent+'_Copy');
								} else { alert('Thất bại ! Xin vui lòng thử lại ! ');}
					}); 
				}
		});

}




   

   
   
   
   
   
   
   
});






$('#create_group').click(function(){
	var name_group = $('#name_group').val();
	if(name_group=='') {
		alert('Vui lòng nhập tên nhóm !'); $('#name_group').focus();
	} else {
		
		$.post( "{{ url('/group/check_exist_group') }}", { title : name_group }, function( data ) {
				
				if(data=='') {
					$.post( "{{ url('/group/create') }}", { title:name_group }, function( data ) {
				if(data!='') {
					$('#group_wrapper').prepend(`
				
					 
					   <li class="list-group-item group_item" id="`+data+`">
                     <a href="{{ url('/') }}/group/`+data+`/get_note?full" class="group_table_cell " contenteditable="false">`+name_group+`</a> 
                     
                     <span class="option_group">
                      <a  href="{{ url('/') }}/group/`+data+`/edit" class="btn_edit_group" style=""><i class="iconfa-pencil"></i></a>
                     <a onClick="return confirm('Xóa nhóm khỏi ghi chú và xóa nhóm ?')" href="{{ url('/') }}/group/`+data+`/delete"><i class=" iconfa-trash"></i></a>
					</span>
                     </li>
					 
					 
					`);
					$('#name_group').val('');
				} else {
					alert('Thất bại ! Xin vui lòng thử lại ! ');
				}
		});
					 
				} else if(data!='') {	
					alert('Tên nhóm bị trùng, vui lòng đổi tên khác!');
					$('#name_group').focus();
				}
		});
		
		
		
		
	}
});


$('#name_group').on('keypress',function(e){
	var p = e.which;
     if(p==13){
        var name_group = $('#name_group').val();
	if(name_group=='') {
		alert('Vui lòng nhập tên nhóm !'); $('#name_group').focus();
	} else {
		$.post( "{{ url('/group/check_exist_group') }}", { title : name_group }, function( data ) {
				
				if(data=='') {
					$.post( "{{ url('/group/create') }}", { title:name_group }, function( data ) {
				if(data!='') {
					$('#group_wrapper').prepend(`
				
					 
					   <li class="list-group-item group_item" id="`+data+`">
                     <a href="{{ url('/') }}/group/`+data+`/get_note?full" class="group_table_cell " contenteditable="false">`+name_group+`</a> 
                     
                     <span class="option_group">
                      <a  href="{{ url('/') }}/group/`+data+`/edit" class="btn_edit_group" style=""><i class="iconfa-pencil"></i></a>
                     <a onClick="return confirm('Xóa nhóm khỏi ghi chú và xóa nhóm ?')" href="{{ url('/') }}/group/`+data+`/delete"><i class=" iconfa-trash"></i></a>
					</span>
                     </li>
					 
					 
					`);
					$('#name_group').val('');
				} else {
					alert('Thất bại ! Xin vui lòng thử lại ! ');
				}
		});
					 
				} else if(data!='') {	
					alert('Tên nhóm bị trùng, vui lòng đổi tên khác!');
					$('#name_group').focus();
				}
		});
	}
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
					
						
						   <li class="list-group-item group_item" id="`+id_group+`">
                     <a href="{{ url('/') }}/group/`+id_group+`/get_note?full" class="group_table_cell " contenteditable="true">`+name_group+`</a> 
                     
                     <span class="option_group">
                      <a  href="{{ url('/') }}/group/`+id_group+`/edit" class="btn_edit_group" style=""><i class="iconfa-pencil"></i></a>
                     <a onClick="return confirm('Xóa nhóm khỏi ghi chú và xóa nhóm ?')" href="{{ url('/') }}/group/`+id_group+`/delete"><i class=" iconfa-trash"></i></a>
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

<script src="{{url('/')}}/plugins/ckeditor/ckeditor.js"></script>

<script>
CKEDITOR.replace( 'content_vi', {
filebrowserBrowseUrl : '{{url("/")}}/plugins/ckfinder/ckfinder.html', filebrowserImageBrowseUrl : '{{url("/")}}/plugins/ckfinder/ckfinder.html?type=Images', filebrowserFlashBrowseUrl : '{{url("/")}}/plugins/ckfinder/ckfinder.html?type=Flash', filebrowserUploadUrl : '{{url("/")}}/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files', filebrowserImageUploadUrl : '{{url("/")}}/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images', filebrowserFlashUploadUrl : '{{url("/")}}/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash', height : 400, language: 'vi', font : 'quicksand' });
</script>

<script>
CKEDITOR.replace( 'content_ja', {
filebrowserBrowseUrl : '{{url("/")}}/plugins/ckfinder/ckfinder.html', filebrowserImageBrowseUrl : '{{url("/")}}/plugins/ckfinder/ckfinder.html?type=Images', filebrowserFlashBrowseUrl : '{{url("/")}}/plugins/ckfinder/ckfinder.html?type=Flash', filebrowserUploadUrl : '{{url("/")}}/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files', filebrowserImageUploadUrl : '{{url("/")}}/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images', filebrowserFlashUploadUrl : '{{url("/")}}/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash', height : 400, language: 'vi', font : 'quicksand' });
</script>
<?php /*?><script>
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
</script><?php */?>



</body>
</html>










</div><!--mainwrapper-->

</body>
</html>
