@extends('layouts.master') 

<!-- title --> 
@section('title') <?php if(isset($query_string) and $query_string=='mail') { ?>Thêm mới mẫu thư<?php } else { ?>Thêm mới mẫu câu<?php } ?> @endsection 
<!-- end title --> 

<!-- primary content --> 
@section('content')


   
        
      


<?php if(isset($query_string) and $query_string=='mail') { ?>
  <div class="pageheader">
         @include('layouts.search') 
            <div class="pagetitle">
             <a href="{{ url('/notes?mail') }}" class="btn btn-primary"><span class="iconfa-th-list"></span>&nbsp; Danh sách mẫu thư</a>
            </div>
        </div>


 <div class="maincontent">
            <div class="maincontentinner">
            
<div class="widgetbox box-inverse">
                <h4 class="widgettitle">Thêm mẫu thư mới</h4>
                <div class="widgetcontent ">
                {!! Form::open([
		'action' => 'NotesController@create_note',
        'method' => 'post',
        'id' => 'new_note',
        'class' => 'stdform stdform2'
]) !!}
                
                
                <input type="hidden" value="1" name="key_sentence">
                
                
                
                
                <div class="tabbable tabs-below">
                  <ul class="nav nav-tabs" style="background:#333; border:none;" id="tab_add">
                            	<li class="active" ><a data-toggle="tab" href="#A">Tiếng Việt</a></li>
                            	<li class="" ><a data-toggle="tab" href="#B">日本語</a></li>
                            
                            </ul>
                            <div class="tab-content" style="border:none;padding:0px;">
                                <div id="A" class="tab-pane active">
                                <!-- content -->
                                   <p>
                                <label>Chủ đề</label>
                                <span class="field" ><input type="text" name="title" id="title" class="input-xxlarge" required  autocomplete="off" style="width:100%;"></span>
									 </p>
                            
                                    <p>
                                        <label>Mẫu thư</label>
                                        <span class="field">
                                        <textarea rows="5" name="content" id="content_vi" class="input-xxlarge ckedit" required  style="width:100%;"></textarea>
                                        </span>
                                    </p>
                            <!-- end content -->
                         
                            	</div>
                            	<div id="B" class="tab-pane">
                              	      <!-- content -->
                                   <p>
                                <label>主題</label>
                                <span class="field" ><input type="text" name="title_ja" id="title_ja" class="input-xxlarge" required  autocomplete="off" style="width:100%;"></span>
									 </p>
                            
                                    <p>
                                        <label>サンプルレター</label>
                                        <span class="field">
                                        <textarea rows="5" name="content_ja" id="content_ja" class="input-xxlarge ckedit" required  style="width:100%;"></textarea>
                                        </span>
                                    </p>
                            <!-- end content -->
                            	</div>
                            
                            </div>
                          
                        </div>
                
                
                
                        <p>
                                <label>Sử dụng trong trường hợp</label>
                                <span class="field" style="padding-right: 15px;" ><input type="text" name="use_th" id="use_th" class="input-xxlarge" required  autocomplete="off" style="width:100%;"></span>
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
                                <button class="btn btn-primary" type="button" id="btn_new_note"><span class="iconfa-save"></span>&nbsp; Lưu</button>
                                <button type="reset" class="btn" type="reset">Reset</button>
                            </p>
                
                
                
                
                
                
                
                 
                           
                 {!! Form::close() !!}
                </div><!--widgetcontent-->
                
                
                   <div class="footer">
                    <div class="footer-left">
                         <p>&copy; 2018. Hoangsi. All Rights Reserved.</p>
                    </div>
                    <div class="footer-right">
                        <span>Designed by: <a href="https://hoangsi.com" target="_blank">HoangSi</a></span>
                    </div>
                </div><!--footer-->
            </div>
</div>
</div>

<?php } else { ?>
  <div class="pageheader">
         @include('layouts.search') 
            <div class="pagetitle">
             <a href="{{ url('/notes') }}" class="btn btn-primary"><span class="iconfa-th-list"></span>&nbsp; Danh sách mẫu câu</a>
            </div>
        </div>

<div class="maincontent">
            <div class="maincontentinner">
            
<div class="widgetbox box-inverse">
                <h4 class="widgettitle">Thêm mẫu câu mới</h4>
                <div class="widgetcontent ">
                {!! Form::open([
		'action' => 'NotesController@create_note',
        'method' => 'post',
        'id' => 'new_note',
        'class' => 'stdform stdform2'
]) !!}
                
                 <input type="hidden" value="0" name="key_sentence">
                            <p>
                                <label>Mẫu câu</label>
                                <span class="field" ><span style=" display:inline-block;vertical-align:top;"><input type="text" name="title" id="title" class="input-xxlarge" required style="margin-right:25px;margin-bottom:10px;" autocomplete="off"></span>

                                <span style="display:inline-block;"><input type="text" name="furigana" id="furigana" class="input-xxlarge" placeholder="Furigana nếu có" autocomplete="off"><br>

                                  <span class="label label-danger" style="    background: #c0392b;
    font-size: 13px;
    padding: 5px;
    display: inline-block;
    margin-top: 2px;">Từ cần Furigana được đặt trong "{}", phân cách bằng dấu hai chấm ":", Ví dụ: .....{犬:いぬ}... </span>
                                </span>
                                <span style="clear:both"></span>
                                </span>
                            </p>
                            
                         
                            
                            <p>
                                <label>Ýnghĩa</label>
                                <span class="field"><textarea rows="5" name="content" id="content" class="input-xxlarge" required></textarea>
                                
                              
                                
                                </span>
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
                                <button class="btn btn-primary" type="button" id="btn_new_note"><span class="iconfa-save"></span>&nbsp; Lưu</button>
                                <button type="reset" class="btn" type="reset">Reset</button>
                            </p>
                 {!! Form::close() !!}
                </div><!--widgetcontent-->
                
                
                   <div class="footer">
                    <div class="footer-left">
                         <p>&copy; 2018. Hoangsi. All Rights Reserved.</p>
                    </div>
                    <div class="footer-right">
                        <span>Designed by: <a href="https://hoangsi.com" target="_blank">HoangSi</a></span>
                    </div>
                </div><!--footer-->
            </div>
</div>
</div>
<?php } ?>

@endsection 
<!-- end primary content -->