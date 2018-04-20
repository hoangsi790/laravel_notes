@extends('layouts.master') 

<!-- title --> 
@section('title') Notes @endsection 
<!-- end title --> 

<!-- primary content --> 
	@section('content')
    <?php if(isset($notes) and count($notes) > 0) { ?>
	
{!! Form::open([
		'action' => 'NotesController@sort_note',
        'method' => 'post',
        'id' => 'sort_note'
]) !!}
<input type="hidden" name="arr_id_note" id="arr_id_note">
<div class="list_note_wrapper row" id="note_order_wrapper">
		 <?php foreach($notes as $note) { ?>
    <!--  note item -->
    <div class="col-sm-4 col-md-4 col-lg-3 note_order"  id="<?php echo $note['id']; ?>">
        <div class="alert alert-warning note_item"  id="<?php echo $note['id']; ?>" style="background:<?php echo $note['background']; ?>;"> 
            <!-- note title -->
            <div class="note_title_wrapper">
                <h2 class="note_title"><?php echo $note['title']; ?></strong> </h2>
                <a href="{{ url('/') }}/note/<?php echo $note['id']; ?>/edit" data-toggle="tooltip" data-placement="bottom" title="Chỉnh sửa !" class="trash_note color_button"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                <hr>
            </div>
            <!-- end note title --> 
            
            <!-- note content -->
            <div class="note_content_wrapper">
                <p> 
<?php 	$content = $note['content'];	
$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
if(preg_match($reg_exUrl, $content, $url)) {
        $http_content = preg_replace($reg_exUrl, '<a href="'.$url[0].'" rel="nofollow" target="_blank">'.$url[0].'</a>', $content);
		echo nl2br($http_content);
} else {
      echo nl2br($content);
}
 ?> </p>
            </div>
            <!-- end note content -->
            <div class="note_group_wrapper">
                <?php if(isset($note['groups']) and count($note['groups']) > 0) {
	$current_groups = $note['groups']; ?>
                <?php foreach($current_groups as $current_group) { ?>
                <span class="label label-danger" id="<?php  echo $current_group['id']; ?>">
                <?php  echo $current_group['title']; ?>
                </span>
                <?php } ?>
                <?php } ?>
            </div>
            <div class="note_footer_wrapper text-right"> <a href="#" data-toggle="tooltip" data-placement="top" title="Ghim ghi chú !" class="pull-left color_button"><i class="fa fa-thumb-tack" aria-hidden="true"></i></a>
                <div class="dropup" id="color_note_wrapper" style="display:inline-block;"> <a style="width:55px;display:inline-block; text-align:right;" href="#" class=" color_button text-center dropdown-toggle"  
                             id="dropdown_colors" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"
                            data-toggle="tooltip" data-placement="bottom" title="Đổi màu !"><i class="fa fa-pie-chart" aria-hidden="true"></i></a>
                    <ul id="color_note_list" class="dropdown-menu" aria-labelledby="dropdown_colors">
                        <?php if(isset($backgrounds) and count($backgrounds) > 0) { foreach($backgrounds as $background) { ?>
                        <li><a id="<?php echo $background['id']; ?>" href="#"  style="background:<?php echo $background['background']; ?>;" 
 onclick="event.preventDefault(); document.getElementById('group_13ecf0f1').submit();"></a></li>
                        <?php } } ?>
                    </ul>
                </div>
                <div class="dropdown" style="display:inline-block;"> <a style="width:30px;display:inline-block;" href="#" class="color_button text-center dropdown-toggle"  
                             id="dropdown_options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" ><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                    <ul id="note_options" class="dropdown-menu" aria-labelledby="dropdown_options">
                        <li><a href="#">Đổi nhóm</a></li>
                        <li><a href="#">Sao chép ghi chú</a></li>
                        <li><a href="{{ url('/') }}/note/<?php echo $note['id']; ?>/trash">Xóa ghi chú</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end note item -->
    <?php }  ?> 
    </div>
    {!! Form::close() !!}
    <?php } else { ?>
 <div class=" alert alert-info"> <i class="fa fa-bell-o" aria-hidden="true"></i>&nbsp; Chưa có ghi chú, <a href="{{ url('/note/new') }}"><strong>Tạo ngay</strong></a></div>
 <?php }  ?> 
@endsection 
<!-- end primary content -->