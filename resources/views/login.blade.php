<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>HoangSi</title>
<link rel="stylesheet" href="{{url('/')}}/css/style.default.css" type="text/css" />
<link rel="stylesheet" href="{{url('/')}}/css/style.shinyblue.css" type="text/css" />
<script type="text/javascript" src="{{url('/')}}/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/modernizr.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/jquery.cookie.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/custom.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#login_form').submit(function(){
            var u = jQuery('#username').val();
            var p = jQuery('#password').val();
            if(u == '' && p == '') {
                jQuery('.login-alert').fadeIn();
                return false;
            }
        });
    });
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body class="loginpage">
<div class="loginpanel">
    <div class="loginpanelinner">
        <div class="logo  bounceIn"><img src="images/logo.png" alt="" /></div>
      
        {!! Form::open([
        'action' => 'NotesController@login',
        'method' => 'post',
        'id' => 'login_form'
        ]) !!}
          <?php if(isset($alert_fail) and $alert_fail!='') { ?>
        <div class="inputwrapper">
            <div class="alert alert-error"> <?php echo $alert_fail; ?></div>
        </div>
        <?php } ?>
        <div class="inputwrapper  bounceIn">
            <input type="text" name="username" id="username" required placeholder="Nhập tài khoản">
        </div>
        <div class="inputwrapper  bounceIn">
            <input type="password" name="password" id="password" required placeholder="Nhập mật khẩu">
        </div>
        <div class="inputwrapper  bounceIn">
            <button type="submit">Đăng nhập</button>
        </div>
        <div class="inputwrapper  bounceIn">
            <label>
                <input type="checkbox" class="remember" name="signin" />
                Nhớ tài khoản</label>
        </div>
        {!! Form::close() !!} </div>
    <!--loginpanelinner--> 
</div>
<!--loginpanel-->

<div class="loginfooter">
    <p>&copy; 2018. Hoangsi. All Rights Reserved.</p>
</div>
</body>
</html>
