@extends('layouts.master') 

<!-- title --> 
@section('title') Danh sách mẫu <?php if(isset($query_string) and $query_string=='mail') { ?> thư<?php } elseif(isset($query_string) and $query_string=='full') {?> câu và thư <?php  } else { ?>câu	<?php } ?> @endsection 
<!-- end title --> 



        <!-- primary content --> 
@section('content')

   <?php $full_url =  $_SERVER['REQUEST_URI']; 
   $item_url = explode("/",$full_url);
   if(isset($item_url[2])) { $get_id_group = $item_url[2];	}
   ?>
       
        <div class="pageheader" style="position:relative;">
           @include('layouts.search') 
          
            <div class="pagetitle">
             <?php if(isset($query_string) and $query_string=='mail') { ?>
            <a href="{{ url('/note/new?mail') }}" class="btn btn-primary"><span class=" iconfa-file"></span>&nbsp; Tạo mới mẫu thư</a>
           <?php }  elseif(isset($query_string) and $query_string=='full') {?>
          <a href="{{ url('/note/new') }}" class="btn btn-primary"><span class=" iconfa-file"></span>&nbsp; Tạo mới mẫu câu</a>
           <a href="{{ url('/note/new?mail') }}" class="btn btn-primary"><span class=" iconfa-file"></span>&nbsp; Tạo mới mẫu thư</a>
               <?php } else { ?>
        	 <a href="{{ url('/note/new') }}" class="btn btn-primary"><span class=" iconfa-file"></span>&nbsp; Tạo mới mẫu câu</a>
        		<?php } ?>
            </div>
        </div>
      
        <div class="maincontent">
            <div class="maincontentinner">
            
               

  
  <?php if(isset($notes) and count($notes) > 0) { ?>
       <table class="table table-striped table-bordered table_sentences responsive">
        <tr>
            <th style="width:22px;">STT</th>
            <th style="width:30%;"> <?php if(isset($query_string) and $query_string=='mail') { ?>Chủ đề <?php }  elseif(isset($query_string) and $query_string=='full') {?>Mẫu câu & Chủ đề mẫu thư<?php } else { ?>Mẫu câu<?php } ?></th>
             
             <?php /* ?><?php if(isset($query_string) and $query_string=='mail') { ?><?php } else { ?><th style="width:30%;">Ý nghĩa</th><?php } ?> <?php */ ?>
            
            <th>Nhóm</th>
            <th style="width:65px;">Tùy chọn</th>
        </tr>
       
        <?php /* ?> <?php if(isset($query_string) and $query_string=='mail') { }  elseif(isset($query_string) and $query_string=='full') {} else { ?>
          <tr id="form_add_fl">
        
            <td style="padding-bottom:0;">   <a href="#" class="btn btn-danger" id="remove_add_fl" style="padding:4px 5px; margin:5px; color:#fff;line-height:1;   ">
            <span class="iconfa-remove"></span></a> </td>
            <td style="padding-bottom:0;"><input type="text" name="title" id="title" class="add_fl"  autocomplete="off" required placeholder="Nhập mẫu câu để tạo nhanh..."></td>
            <td style="padding-bottom:0;"><input type="text" name="content" id="content" class="add_fl"  autocomplete="off" required  placeholder="Nhập ý nghĩa để tạo nhanh..."></td>
            <td style="padding-bottom:0;">
            
              <span class="field note_group_wrapper"  id="open_group">
                                
                             
            <select  id="group" name="group[]"  multiple placeholder="Chọn hoặc tạo nhóm cho ghi chú"  style="background:none;border:none;outline:none;box-shadow:none; text-align:left; display:inline-block;" >
                        <?php if(isset($groups) and count($groups) > 0) { foreach($groups as $group) { ?>
                        <option value="<?php echo $group['id']; ?>"
                        <?php if(isset($get_id_group) and $get_id_group == $group['id']) { echo 'selected'; } ?> 
                        ><?php echo $group['title']; ?></option>
                        <?php } } ?>
                    </select>
      
        
        </span>
            
            </td>
            <td style="text-align:center;"><button type="button" class="btn btn-primary" id="btn_add_fl" style="padding:4px 5px; margin:5px;  color:#fff;line-height:1; background:#27ae60;    border: 1px solid #27ae60;">
            <span class="iconfa-ok"></span></button>
            
         
            
             </td>
             
        </tr>
        <?php } ?> <?php */ ?>
        
        <?php $i=1; foreach($notes as $note) { ?>
        <tr>
            <td style="text-align:center; vertical-align:middle;"><?php echo $i; ?></td>
            <td class="tiengnhat"><span class="flag_edit_sentence" contenteditable="false"  flag="title" sentence_id="<?php echo $note['id']; ?>"><?php echo $note['title']; ?></span></td>

            <?php /* ?><?php if(isset($query_string) and $query_string=='mail') { ?><?php } else { ?>
                <td><span class="flag_edit_sentence " contenteditable="false" flag="content" sentence_id="<?php echo $note['id']; ?>">
			<?php echo $limit = str_limit($note['content'], 70); ?>
			</span></td><?php } ?> <?php */ ?>

            
            <td><div class="note_group_wrapper">
                    <?php if(isset($note['groups']) and count($note['groups']) > 0) {
	$current_groups = $note['groups']; ?>
                    <?php foreach($current_groups as $current_group) { ?>
                    
                    <a href="{{ url('/') }}/group/<?php echo $current_group['id']; ?>/get_note<?php if(isset($note['key_sentence']) and $note['key_sentence']=='1') { echo '?mail'; }?>"  class="<?php if(isset($get_id_group) and $get_id_group == $current_group['id']) { echo 'active'; }; ?>  c_get_note label label-primary" id="<?php  echo $current_group['id']; ?>" style="text-transform:none;font-size:12px;color:#fff;background:#555;">
                    <?php  echo $current_group['title']; ?>
                    </a>
                    
                    
                    <?php } ?>
                    <?php } ?>
                </div></td>
            <td style="text-align:center;"><a href="{{ url('/') }}/note/<?php echo $note['id']; ?>/edit<?php if(isset($note['key_sentence']) and $note['key_sentence']=='1') { echo '?mail'; }?>" class="btn btn-warning" style="padding:2px 5px; color:#fff;line-height:1;">
            <span class="iconfa-pencil"></span></a> <a href="{{ url('/') }}/note/<?php echo $note['id']; ?>/delete"  onClick="return confirm('Bạn chắc chắn xóa ?')" class="btn btn-danger trash_note" style="padding:2px 5px; color:#fff;line-height:1;"><span class=" iconfa-trash"></span></a></td>
        </tr>
        <?php $i++; }  ?>
    </table>
            <?php } else { ?>
<div class=" alert alert-info"> <i class="fa fa-bell-o" aria-hidden="true"></i>&nbsp; Chưa có mẫu câu, <a href="{{ url('/note/new') }}"><strong>Tạo mới</strong></a></div>
<?php }  ?>    
              
               @if(isset($paginate_notes)) {{ $paginate_notes->links() }} @endif
              
              
            
            
            <div class="footer">
                    <div class="footer-left">
                         <p>&copy; 2018. Hoangsi. All Rights Reserved.</p>
                    </div>
                    <div class="footer-right">
                        <span>Designed by: <a href="https://hoangsi.com" target="_blank">HoangSi</a></span>
                    </div>
                </div><!--footer-->
                
            
            </div><!--maincontentinner-->
        </div>
        
        
@endsection 
<!-- end primary content -->



