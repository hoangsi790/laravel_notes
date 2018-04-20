<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>@yield('title')</title>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
<link rel="stylesheet" href="{{url('/')}}/css/selectize.default.css" />
<link rel="stylesheet" href="{{url('/')}}/css/styles.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
<header>



<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><i class="fa fa-bars" aria-hidden="true"></i></a>
      <a class="navbar-brand" href="{{ url('/notes') }}">Hoang Si</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
   <!--   <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        
      </ul>-->
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Tìm kiếm ghi chú...">
        </div>
        <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <?php if (Session::has('user_session'))  { ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
         
         Chào  <strong><?php $user_session = Session::get('user_session'); echo $user_session['display_name'][0];	?></strong>

           <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Thông tin cá nhân</a></li>
            <li><a href="#">Đổi mật khẩu</a></li>
            <li><a href="#">Cài đặt</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ url('/') }}/logout"  onclick="return confirm('Bạn chắc chắn đăng xuất ?')" >Đăng xuất</a></li>
            
            <?php	}?>
            
            
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>




</header>

