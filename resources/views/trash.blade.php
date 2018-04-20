@extends('layouts.master') 

<!-- title --> 
@section('title') Thùng rác @endsection 
<!-- end title -->

<!-- primary content --> 
@section('content')


       
        
        <div class="pageheader">
          @include('layouts.search') 
          
            <div class="pagetitle">
             <a onClick="return confirm('Xóa vĩnh viễn tất cả ghi chú trong thùng rác ?')" href="{{ url('/') }}/trash/delete_all" class="btn btn-danger"><span class=" iconfa-ban-circle"></span>&nbsp; Dọn sạch thùng rác</a>
            </div>
        </div>
        
        <div class="maincontent">
            <div class="maincontentinner">
            
               
        

<?php if(isset($notes_trash) and count($notes_trash) > 0) { ?>

            	<table class="table table-striped table-bordered table_sentences responsive">
        <tr>
            <th style="width:22px; background:#c0392b !important; border-color:#fff !important; ">STT</th>
            <th style="width:30%; background:#c0392b !important; border-color:#fff !important;">Mẫu câu</th>
            <th style="width:30%; background:#c0392b !important; border-color:#fff !important;">Ý nghĩa</th>
            <th style=" background:#c0392b !important;"">Nhóm</th>
            <th style="width:65px;  background:#c0392b !important; border-color:#fff !important;">Tùy chọn</th>
        </tr>
        <?php $i=1; foreach($notes_trash as $note_trash) { ?>
        <tr>
            <td style="text-align:center; vertical-align:middle;"><?php echo $i; ?></td>
            <td><?php echo $note_trash['title']; ?></td>
            <td><?php echo $note_trash['content']; ?></td>
            <td><div class="note_trash_group_wrapper">
                    <?php if(isset($note_trash['groups']) and count($note_trash['groups']) > 0) {
	$current_groups = $note_trash['groups']; ?>
                    <?php foreach($current_groups as $current_group) { ?>
                    <span class="label label-primary" id="<?php  echo $current_group['id']; ?>">
                    <?php  echo $current_group['title']; ?>
                    </span>
                    <?php } ?>
                    <?php } ?>
                </div></td>
            <td style="text-align:center;"><a href="{{ url('/') }}/note/<?php echo $note_trash['id']; ?>/restore" class="btn btn-warning" style="padding:2px 5px; color:#fff;line-height:1;"> 
           <span class="iconfa-undo"></span></a> <a  onClick="return confirm('Xóa vĩnh viễn ghi chú này ?')"   href="{{ url('/') }}/note/<?php echo $note_trash['id']; ?>/delete" class="btn btn-danger trash_note"
            style="padding:2px 5px; color:#fff;line-height:1;"><span class="iconfa-remove-sign"></span></a></td>
        </tr>
        <?php $i++; }  ?>
    </table>
        

  <?php } else { ?> 

 <div class=" alert alert-info"> <i class="fa fa-bell-o" aria-hidden="true"></i>&nbsp; Thùng rác trống! <a href="{{ url('/notes') }}">Trở về danh sách mẫu câu</a></div>

  <?php } ?>


            
            
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