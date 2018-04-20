@extends('layouts.master') 

<!-- title --> 
@section('title') Chỉnh sửa mẫu <?php if(isset($query_string) and $query_string=='mail') { ?> thư<?php } else { ?>câu	<?php } ?> @endsection 
<!-- end title --> 

<!-- primary content --> 
@section('content')

<div class="pageheader">
   @include('layouts.search') 
    <div class="pagetitle"> 
    
    <?php if(isset($query_string) and $query_string=='mail') { ?> 
  <a href="{{ url('/notes?mail') }}" class="btn btn-primary"><span class="iconfa-th-list"></span>&nbsp; Danh sách mẫu thư</a> 
    <a href="{{ url('/note/new?mail') }}" class="btn btn-primary"><span class=" iconfa-file"></span>&nbsp; Tạo mới mẫu thư</a>
    <?php } else { ?>
	
	  <a href="{{ url('/notes') }}" class="btn btn-primary"><span class="iconfa-th-list"></span>&nbsp; Danh sách mẫu câu</a> 
    <a href="{{ url('/note/new') }}" class="btn btn-primary"><span class=" iconfa-file"></span>&nbsp; Tạo mới mẫu câu</a>
	<?php } ?>
    
    
     </div>
</div>
<div class="maincontent">
    <div class="maincontentinner">
     <?php if(isset($notes) and count($notes) > 0) { foreach($notes as $note) { ?>
        <div class="widgetbox box-inverse">
            <h4 class="widgettitle">Chỉnh sửa mẫu <?php if(isset($query_string) and $query_string=='mail') { ?> thư<?php } else { ?>câu	<?php } ?> <a href="{{ url('/') }}/note/<?php echo $note['id']; ?>/delete"  onClick="return confirm('Bạn chắc chắn xóa ?')" class="pull-right trash_note" style="padding:0px 5px;color:#dd0000;">Xóa mẫu <?php if(isset($query_string) and $query_string=='mail') { ?> thư<?php } else { ?>câu	<?php } ?> này</a></h4>
            
            
            <?php if(isset($query_string) and $query_string=='mail') { ?>
			<div class="widgetcontent ">
            
                
                <?php $id = $note['id']; ?>
                {!! Form::model($id, [
                'route' => ['note.update_note', $id],
                'method' => 'put',
                'class' => 'stdform stdform2',
                'id' => 'edit_note',
                ]) !!}
                
                
                
                <input type="hidden" value="1" name="key_sentence">
                
                
                <div class="tabbable tabs-below">
                  <ul class="nav nav-tabs" style="background:#333; border:none;">
                            	<li class="active" ><a data-toggle="tab" href="#A">Tiếng Việt</a></li>
                            	<li class="" ><a data-toggle="tab" href="#B">日本語</a></li>
                            
                            </ul>
                            <div class="tab-content" style="border:none;padding:0px;">
                                <div id="A" class="tab-pane active">
                                <!-- content -->
                                   <p>
                                <label>Chủ đề</label>
                                <span class="field" ><input type="text" name="title" id="title" class="input-xxlarge" required  autocomplete="off" style="width:100%;" value="<?php  if(isset($note['title'])) { echo $note['title'];} ?>"></span>
									 </p>
                            
                                    <p>
                                        <label>Mẫu thư</label>
                                        <span class="field">
                                        <textarea rows="5" name="content" id="content_vi" class="input-xxlarge ckedit" required  style="width:100%;"><?php  if(isset($note['content'])) { echo $note['content'];} ?></textarea>
                                        </span>
                                    </p>
                            <!-- end content -->
                         
                            	</div>
                            	<div id="B" class="tab-pane">
                              	      <!-- content -->
                                   <p>
                                <label>主題</label>
                                <span class="field" ><input type="text" name="title_ja" id="title_ja" class="input-xxlarge" required  autocomplete="off" style="width:100%;"
                                 value="<?php  if(isset($note['title_ja'])) { echo $note['title_ja'];} ?>"></span>
									 </p>
                            
                                    <p>
                                        <label>サンプルレター</label>
                                        <span class="field">
                                        <textarea rows="5" name="content_ja" id="content_ja" class="input-xxlarge ckedit" required  style="width:100%;"><?php  if(isset($note['content_ja'])) { echo $note['content_ja'];} ?></textarea>
                                        </span>
                                    </p>
                            <!-- end content -->
                            	</div>
                            
                            </div>
                          
                        </div>
                
                
                        <p>
                                <label>Sử dụng trong trường hợp</label>
                                <span class="field" style="padding-right: 15px;" ><input type="text" name="use_th" id="use_th" class="input-xxlarge" required  autocomplete="off" style="width:100%;" value="<?php if(isset($note['use_th'])) { echo $note['use_th'];} ?>"></span>
									 </p>
                
                
                
                
                   <p>
                                <label>Chọn nhóm</label>
                                <span class="field note_group_wrapper"  id="open_group">
                                
                             
            <select  id="group" name="group[]"  multiple placeholder="Chọn hoặc tạo nhóm"  style="background:none;border:none;outline:none;box-shadow:none; text-align:left; display:inline-block; " >
                        <?php if(isset($groups) and count($groups) > 0) { foreach($groups as $group) { ?>
                        <option value="<?php echo $group['id']; ?>"
 <?php if(isset($note['groups']) and count($note['groups']) > 0) {  $current_groups = $note['groups']; 
  foreach($current_groups as $current_group){   ?>
		 <?php if($current_group['id'] == $group['id']) { echo 'selected'; } ?>
<?php } } ?> ><?php echo $group['title']; ?></option>
                        <?php } } ?>
                    </select>
      
        
        </span>
                            </p>
                                                    
                                                    
                                                    
                                                    
                            <p class="stdformbutton">
                                <button class="btn btn-primary" type="submit"><span class="iconfa-save"></span>&nbsp; Lưu</button>
                                <button type="reset" class="btn" type="reset">Reset</button>
                            </p>
                
                
                
                
                
                
                
                 
                           
                 {!! Form::close() !!}
                </div>
			<?php } else { ?>
            <div class="widgetcontent ">
               
                <?php $id = $note['id']; ?>
                {!! Form::model($id, [
                'route' => ['note.update_note', $id],
                'method' => 'put',
                'class' => 'stdform stdform2',
                'id' => 'edit_note',
                ]) !!}
             
                
                
                <p>
                                <label>Mẫu câu</label>
                                <span class="field" ><span style=" display:inline-block;vertical-align:top;"><input type="text" name="title" id="title" class="input-xxlarge" required style="margin-right:25px;" autocomplete="off" value="<?php echo $note['title']; ?>"></span>
                                
                                <span style="display:inline-block;"><input type="text" name="furigana" id="furigana" class="input-xxlarge" placeholder="Furigana nếu có" autocomplete="off" value="<?php echo $note['furigana']; ?>"><br>

                                  <span class="label label-danger" style="    background: #c0392b;
    font-size: 13px;
    padding: 5px;
    display: inline-block;
    margin-top: 2px; ">Từ cần Furigana được đặt trong "{}", phân cách bằng dấu hai chấm ":", Ví dụ: .....{犬:いぬ}... </span>
                                </span>
                                <span style="clear:both"></span>
                                </span>
                            </p>
                
                
                
                  <p>
                
                
                    <label>Ýnghĩa</label>
                    <span class="field">
                    <textarea rows="5" name="content" id="content" class="input-xxlarge" required><?php echo $note['content']; ?></textarea>
                    </span> </p>
                <p>
                    <label>Chọn nhóm</label>
                    <span class="field">
                    <select  id="group" name="group[]"  multiple placeholder="Chọn hoặc tạo nhóm cho ghi chú"  style="background:none;border:none;outline:none;box-shadow:none; text-align:left; display:inline-block;" >
                        <?php if(isset($groups) and count($groups) > 0) { foreach($groups as $group) { ?>
                        <option value="<?php echo $group['id']; ?>"
 <?php if(isset($note['groups']) and count($note['groups']) > 0) {  $current_groups = $note['groups']; 
  foreach($current_groups as $current_group){   ?>
		 <?php if($current_group['id'] == $group['id']) { echo 'selected'; } ?>
<?php } } ?> ><?php echo $group['title']; ?></option>
                        <?php } } ?>
                    </select>
                    </span> </p>
                <p class="stdformbutton">
                    <button class="btn btn-primary" type="submit"><span class="iconfa-save"></span>&nbsp; Lưu</button>
                    <button type="reset" class="btn" type="button">
                    Hủy
                    </button>
                </p>
                
                  {!! Form::close() !!}
            </div>
            <?php } ?>
            
            
            
            
            <div class="footer">
                <div class="footer-left">
                    <p>&copy; 2018. Hoangsi. All Rights Reserved.</p>
                </div>
                <div class="footer-right"> <span>Designed by: <a href="https://hoangsi.com" target="_blank">HoangSi</a></span> </div>
            </div>
            <!--footer--> 
        </div>
      
                <?php } } ?>
    </div>
</div>
@endsection 
<!-- end primary content -->