<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>@yield('title')</title>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="{{url('/')}}/css/style.default.css" type="text/css" />
<link rel="stylesheet" href="{{url('/')}}/prettify/prettify.css" type="text/css" />

<link rel="stylesheet" href="{{url('/')}}/css/selectize.default.css" />
<link rel="stylesheet" href="{{url('/')}}/css/styles.css" />

<script type="text/javascript" src="{{url('/')}}/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/prettify/prettify.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/jquery.cookie.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/modernizr.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/responsive-tables.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/custom.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

<body>

<div class="mainwrapper">
    
    <div class="header">
        <div class="logo">
            <a href="{{ url('/notes') }}"><img src="{{url('/')}}/images/logo.png" alt="" /></a>
        </div>
        <div class="headerinner">
            <ul class="headmenu">
                
                
                <li class="odd">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" onClick="return alert('Hiện tại có <?php echo $count_sentences; ?> mẫu câu, thư và <?php echo $count_groups; ?> nhóm!')">
                    <span class="count">1</span>
                    <span class="head-icon head-bar"></span>
                    <span class="headmenu-label">Thống kê</span>
                    </a>
                    
                </li>
                 <li class="odd" style="margin-left:5px;padding:5px;box-sizing:border-box;">
                     <script>
              var loadFile = function(event) {
                var output = document.getElementById('output_avatar');
                output.src = URL.createObjectURL(event.target.files[0]);
                 $('#output_avatar').addClass('active-avatar');
              };
            </script>
                   <label for="fileInput"><p style="width:97px;height:97px;border:1px solid #ccc;text-align:center; display:table-cell;vertical-align:middle;color:#ccc; overflow:hidden;position:relative;">
                    <span class="loading_tr loading_tr2" ><img src="{{url('/')}}/images/loading2.gif" style="width:35px;"></span>
                   <img style="width:97px;max-height:97px !important; vertical-align:middle;" id="output_avatar" alt="Dịch bằng hình (Bản Beta) "/></p>
        <input type="file" id="fileInput"  accept="image/*"  onChange="loadFile(event)"  class="file" name="fileInput"/ style="display:none;"></label>
                  
                    
                </li>
                <li style="padding-top:25px; margin-left:2px;">
                <span class="loading_tr loading_tr3" ><img src="{{url('/')}}/images/loading2.gif" style="width:35px;"></span>
                
                
                <span style="position:absolute;left:0;top:0;padding:3px;color:#fff; font-size:11px; text-align:center;line-height:20px;width:100%;">DỊCH TỰ ĐỘNG</span>
                
                <span style="    position: absolute;
    left: 287px;
    top: 30px;
    padding: 3px;
    color: #fff;
    font-size: 17px;
    text-align: center;
    line-height: 10px;
    cursor:pointer;
    background: #F00;
    border-radius: 3px;" id="empty_tr">x</span>
                
                <textarea id="translate_tr" style="width:280px; margin-bottom:0; height:74px;resize:none; background:#484848; border:1px solid #222;color:#fff; padding-right:20px;" placeholder="Nhập (tiếng Nhật or tiếng Anh) hoặc quét vào mẫu câu để dịch"></textarea>
                <button id="btn_dich" style="margin-bottom:0; height:70px;resize:none; background:#484848; border:1px solid #222;color:#fff;">Dịch<br>
ngay</button>
                <textarea id="result_tr"  style="width:300px;margin-bottom:0; height:74px;resize:none; background:#484848; border:1px solid #222;color:#fff;" placeholder="" readonly></textarea>
                </li>
                
                
                
                
                
                
                
                
                
                
                <li class="right">
                    <div class="userloggedinfo">
                        <img src="{{url('/')}}/images/photos/thumb1.png" alt="" />
                         <?php if (Session::has('user_session'))  { ?>
                        <div class="userinfo">
                            <h5> Chào  <strong><?php $user_session = Session::get('user_session'); echo $user_session['display_name'][0];	?></strong> <small>- hoangsi128@gmail.com</small></h5>
                            <ul>
                                <li><a href="#" onClick="return alert('Chức năng này đang được cập nhật!')">Thông tin cá nhân</a></li>
            <li><a href="#" onClick="return alert('Chức năng này đang được cập nhật!')">Đổi mật khẩu</a></li>

          
            <li><a href="{{ url('/') }}/logout"  onClick="return confirm('Bạn chắc chắn đăng xuất ?')" >Đăng xuất</a></li>
                            </ul>
                        </div>
                        <?php	}?>
                    </div>
                </li>
            </ul><!--headmenu-->
        </div>
    </div>
