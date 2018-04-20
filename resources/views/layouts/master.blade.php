<!-- header -->
@include('layouts.header') 
<!-- end header --> 


    <div class="leftpanel">
        
      @include('layouts.sidebar') 
        
    </div><!-- leftpanel -->
    
    <div class="rightpanel">
          <ul class="breadcrumbs">
                    <li><a href="{{ url('/notes') }}"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
                    <li>@yield('title')</li> 
                   
        </ul>
  @yield('content')
        
    </div><!--rightpanel-->



<!-- footer --> 
@include('layouts.footer') 
<!-- end footer -->







