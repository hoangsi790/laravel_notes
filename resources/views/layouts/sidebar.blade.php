<div class="leftmenu">
    <ul class="nav nav-tabs nav-stacked">

           <li class="<?php if(isset($full_path) and $full_path=='notes') {echo 'active';}?>"><a href="{{ url('/notes') }}"><span class="iconfa-th-list"></span> Danh sách mẫu câu</a></li>
        <li class="<?php if(isset($full_path) and $full_path=='note/new') {echo 'active';}?>"><a href="{{ url('/note/new') }}"><span class=" iconfa-file"></span>  Tạo mới mẫu câu</a></li>
        <li class="<?php if(isset($full_path) and $full_path=='notesmail') {echo 'active';}?>"><a href="{{ url('/notes?mail') }}"><span class="iconfa-envelope"></span> Danh sách mẫu thư</a></li>
        <li class="<?php if(isset($full_path) and $full_path=='note/newmail') {echo 'active';}?>"><a href="{{ url('/note/new?mail') }}"><span class=" iconfa-file"></span>  Tạo mới mẫu thư</a></li>
       <li   style="background:#fff; padding: 10px;">
            <div class="input-group" style="position:relative;">
                <input type="text" class="form-control" placeholder="Nhập tên nhóm"  name="name_group" id="name_group" required style="width:168px;height:22px; border-color:#222;">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <span class="input-group-btn">
                <button class="btn btn-default" type="submit" id="create_group">Thêm</button>
                </span> </div>
            <!-- /input-group --> 
            
         
            <div class="list_group_wrapper">
                <ul class="list-group" id="group_wrapper">
                    <?php if(isset($groups) and count($groups) > 0) { foreach($groups as $group) { ?>
                    <li class="list-group-item group_item  <?php if(isset($get_id_group) and $get_id_group == $group['id']) { echo 'active'; }; ?> ">
                     <a href="{{ url('/') }}/group/<?php echo $group['id']; ?>/get_note?full" class="group_table_cell flag_edit" contenteditable="false" post_id="<?php echo $group['id']; ?>"   id="<?php echo $group['id']; ?>" old_value="<?php echo $group['title']; ?>"><?php echo $group['title']; ?></a> 
                     
                     <span class="option_group">
                      <a  href="#"  class="btn_edit_group" style=""><i class="iconfa-pencil"></i></a>
                     <a onClick="return confirm('Xóa nhóm khỏi ghi chú và xóa nhóm ?')" href="{{ url('/') }}/group/<?php echo $group['id']; ?>/delete"><i class=" iconfa-trash"></i></a>
					</span>
                     </li>
                    
                 
                    
                    <?php } } else { ?>
                    <small style="color:#666;">Danh sách nhóm rỗng!</small>
                    <?php } ?>
                </ul>
            </div>
            <div style="clear:both;"></div>
        </li>
        <li class=""><a href="#" onClick="return alert('Chức năng này đã bị lược bỏ trong bản cập nhật!')"><span class=" iconfa-trash"></span> Thùng rác</a></li>
        <li><a href="skype:gkv_hoangsi?chat" ><span class="iconfa-comments"></span> Phản hồi</a></li>
        <li><a href="#" onClick="return alert('Chức năng này đang được cập nhật!')"><span class="iconfa-cogs"></span> Cài đặt</a></li>
        <li><a href="{{ url('/') }}/logout"  onClick="return confirm('Bạn chắc chắn đăng xuất ?')"  ><span class="iconfa-signout"></span> Đăng xuất</a></li>
    </ul>
</div>
<!--leftmenu--> 

