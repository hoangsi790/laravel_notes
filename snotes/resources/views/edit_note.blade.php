@extends('layouts.master') 

<!-- title --> 
@section('title') Notes @endsection 
<!-- end title -->

<!-- primary content --> 
@section('content')
<?php if(isset($notes) and count($notes) > 0) { foreach($notes as $note) { ?>
<?php $id = $note['id']; ?>
{!! Form::model($id, [
		'route' => ['note.update_note', $id],
        'method' => 'put'
]) !!}





<div class="list_note_wrapper row"> 
    
    <!--  note item -->
    <div class="col-sm-6 col-md-6 col-lg-6 " style="cursor:default;" >
                <div class="alert alert-warning note_item"  style="background:#FFF2B5;"> 
            <!-- note title -->
            <div class="note_title_wrapper">
                        <h2 class="note_title">
                    <input placeholder="Nhập tiêu đề của ghi chú..." type="text" id="title" name="title" class="form-control" required style="background:none;border:none;outline:none;box-shadow:none;" autocomplete="off" value="<?php echo $note['title']; ?>">
                    </strong> </h2>
                        <hr>
                    </div>
            <!-- end note title --> 
            
            <!-- note content -->
            <div class="note_content_wrapper">
                        <textarea rows="8"  placeholder="Nhập nội dung của ghi chú..." id="content" name="content" class="form-control"  style="resize:none; background:none;border:none;outline:none;box-shadow:none;"><?php echo $note['content']; ?></textarea>
                    </div>
            <!-- end note content -->
            
            <div class="note_group_wrapper collapse in"  id="open_group">
                        <select  id="group" name="group[]"  multiple placeholder="Chọn hoặc tạo nhóm cho ghi chú"  style="background:none;border:none;outline:none;box-shadow:none; text-align:left; display:inline-block;" >
                <?php if(isset($groups) and count($groups) > 0) { foreach($groups as $group) { ?>
<option value="<?php echo $group['id']; ?>"
 <?php if(isset($note['groups']) and count($note['groups']) > 0) {  $current_groups = $note['groups']; 
  foreach($current_groups as $current_group){   ?>
		 <?php if($current_group['id'] == $group['id']) { echo 'selected'; } ?>
<?php } } ?> ><?php echo $group['title']; ?></option>
<?php } } ?>
                </select>
                    </div>
            
            <!-- end note group -->
            
            <div class="note_footer_wrapper">
                        <div class="dropup pull-left" id="color_note_wrapper" style="display:inline-block;"> <a style="display:inline-block; text-align:right;" href="#" class=" color_button text-center dropdown-toggle"  
                             id="dropdown_colors" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"
                            data-toggle="tooltip" data-placement="bottom" title="Đổi màu !"><i class="fa fa-pie-chart" aria-hidden="true"></i></a>
                    <ul id="color_note_list" class="dropdown-menu" aria-labelledby="dropdown_colors">
                                <?php if(isset($backgrounds) and count($backgrounds) > 0) { foreach($backgrounds as $background) { ?>
                                <li><a id="<?php echo $background['id']; ?>" href="#"  style="background:<?php echo $background['background']; ?>;" ></a> </li>
                                <?php } } ?>
                                <input type="hidden" name="background_id" id="background_id" value="21">
                            </ul>
                </div>
                        <a style="width:30px;display:inline-block; padding:3px 2px;" href="#" class="pull-left color_button text-center"  
                            data-toggle="collapse"  data-target="#open_group" ><i class="fa fa-tags" aria-hidden="true"></i></a>
                        <button type="submit" class="btn btn-default pull-right">Lưu</button>
                        <div class="clearfix"></div>
                    </div>
        </div>
            </div>
    <!-- end note item --> 
    
</div>

















{!! Form::close() !!}
<?php } } ?>
@endsection 
<!-- end primary content -->