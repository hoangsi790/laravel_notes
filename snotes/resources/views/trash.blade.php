@extends('layouts.master') 

<!-- title --> 
@section('title') Trash @endsection 
<!-- end title -->

<!-- primary content --> 
@section('content')





<?php if(isset($notes_trash) and count($notes_trash) > 0) { ?>
<div class="">
<div class="alert alert-danger" style="display:inline-block;padding: 5px 35px 6px 15px;">  Ghi chú trong <strong>Thùng rác</strong> sẽ bị xóa sau 30 ngày</div>
<a onclick="return confirm('Xóa vĩnh viễn tất cả ghi chú trong thùng rác ?')" href="{{ url('/') }}/trash/delete_all" class="btn btn-default" style="margin-top:-3px; position:relative;"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp; Dọn sạch thùng rác</a>
</div>

<div class="list_note_wrapper row">
<?php foreach($notes_trash as $note_trash) { ?>

 <!-- end note item -->
    <div class="col-sm-4 col-md-4 col-lg-3">
        <div class="alert alert-warning note_item"  id="<?php echo $note_trash['id']; ?>" style="background:<?php echo $note_trash['background']; ?>;"> 
            <!-- note title -->
            <div class="note_title_wrapper">
                <h2 class="note_title"><?php echo $note_trash['title']; ?></strong> </h2>
                
                <hr>
            </div>
            <!-- end note title --> 
            
            <!-- note content -->
            <div class="note_content_wrapper">
                <p><?php 	$content = $note_trash['content'];	
$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
if(preg_match($reg_exUrl, $content, $url)) {
        $http_content = preg_replace($reg_exUrl, '<a href="'.$url[0].'" rel="nofollow" target="_blank">'.$url[0].'</a>', $content);
		echo nl2br($http_content);
} else {
      echo nl2br($content);
}
 ?></p>
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
            <div class="note_footer_wrapper text-right">
            
                <div class="dropdown" style="display:inline-block;"> <a style="width:30px;display:inline-block;" href="#" class="color_button text-center dropdown-toggle"  
                             id="dropdown_options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" ><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                    <ul id="note_options" class="dropdown-menu" aria-labelledby="dropdown_options">
                        <li><a href="{{ url('/') }}/note/<?php echo $note_trash['id']; ?>/restore">Khôi phục</a></li>
                        <li><a  onclick="return confirm('Xóa vĩnh viễn ghi chú này ?')"   href="{{ url('/') }}/note/<?php echo $note_trash['id']; ?>/delete">Xóa vĩnh viễn</a></li>
                    </ul>
                </div>
            </div>
        </div>
  
  <?php } ?>
    </div>
    <!-- end note item -->
  <?php } else { ?> 

 <div class=" alert alert-info"> <i class="fa fa-bell-o" aria-hidden="true"></i>&nbsp; Thùng rác trống !</div>

  <?php } ?>
</div>

@endsection 
<!-- end primary content -->