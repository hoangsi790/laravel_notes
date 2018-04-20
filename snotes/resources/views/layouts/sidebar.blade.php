<div class="list_menu_wrapper">
    <div class="list-group"> <a href="{{ url('/notes') }}" class="list-group-item "><i class="fa fa-sticky-note-o" aria-hidden="true"></i>&nbsp; Ghi chú</a> <a href="{{ url('/note/new') }}" class="list-group-item "><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;  Tạo mới </a> </div>
</div>
<div class="input-group">
    <input type="text" class="form-control" placeholder="Nhập tên nhóm..."  name="name_group" id="name_group" required>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <span class="input-group-btn">
    <button class="btn btn-default" type="submit" id="create_group">Thêm</button>
    </span> </div>
<!-- /input-group --> 

<br>
<div class="list_group_wrapper">
    <ul class="list-group" id="group_wrapper">
        <?php if(isset($groups) and count($groups) > 0) { foreach($groups as $group) { ?>
        <li class="list-group-item group_item " id="<?php echo $group['id']; ?>"> <a href="{{ url('/') }}/group/<?php echo $group['id']; ?>/get_note" class="group_table_cell"><?php echo $group['title']; ?></a> <span class="group_options group_table_cell">
            <div class="dropdown" style="display:inline-block;"> <span class="bg_carret dropdown-toggle"   id="group_dropdown_options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                <ul id="group_options" class="dropdown-menu" aria-labelledby="group_dropdown_options">
                    <li>
                        <div class="dropdown" id="color_note_wrapper"> <a href="javascript:void(0)" class="  text-center dropdown-toggle"  
                             id="dropdown_colors" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="width:100%;display:block;text-align:left;"> Đổi màu <span class="caret_color pull-right"><i class="fa fa-caret-right" aria-hidden="true"></i></span></a>
                            <ul id="color_group_list" class="dropdown-menu" aria-labelledby="dropdown_colors">
                                <?php if(isset($backgrounds) and count($backgrounds) > 0) { foreach($backgrounds as $background) { ?>
                                <li><a id="<?php echo $background['id']; ?>" href="#"  style="background:<?php echo $background['background']; ?>;" 
 onclick="event.preventDefault(); document.getElementById('group_13ecf0f1').submit();"></a></li>
                                <?php } } ?>
                            </ul>
                        </div>
                    </li>
                    <li><a href="#" data-toggle="modal" data-target="#group_<?php echo $group['id']; ?>"> Chỉnh sửa</a> 
                        
                      
                        
                    </li>
                    <li><a  onclick="return confirm('Xóa nhóm khỏi ghi chú và xóa nhóm ?')" href="{{ url('/') }}/group/<?php echo $group['id']; ?>/delete">Xóa nhóm</a></li>
                </ul>
            </div>
            </span></li>
            
            
              <!-- edit group -->
                        <div id="group_<?php echo $group['id']; ?>" class="modal fade" role="dialog">
                            <div class="modal-dialog"> 
                                
                                <!-- Modal content-->
                                        <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <input type="text" class="form-control" id="title" name="title" value="<?php echo $group['title']; ?>">
                                              </div>
                                              <div class="modal-body">
                                                     <div class="form-group">
                                                    <label>Mô tả</label>
                                                    <textarea rows="4" class="form-control" id="content" name="content"><?php echo $group['content']; ?></textarea>
                                                  </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="submit" class="btn btn-default" >Lưu</button>
                                              </div>
                                            </div>
                            </div>
                        </div>
                        <!-- end edit group --> 
            
            
        <?php } } ?>
        
    </ul>
</div>
<div class="list_menu_wrapper">
    <div class="list-group"> <a href="{{ url('/trash') }}" class="list-group-item"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp; Thùng rác</a> <a href="{{ url('/feedback') }}" class="list-group-item"><i class="fa fa-commenting" aria-hidden="true"></i>&nbsp; Phản hồi</a> <a href="{{ url('/setting') }}" class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp; Cài đặt</a> <a href="{{ url('/') }}/logout"  onclick="return confirm('Bạn chắc chắn đăng xuất ?')"  class="list-group-item"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp; Đăng xuất</a> </div>
</div>


