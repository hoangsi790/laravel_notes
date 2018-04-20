<!-- header -->
@include('layouts.header') 
<!-- end header --> 

<!-- section -->
<section> 
    <div class="container-fluid" >
    <div class="row">
    <!-- sidebar -->
    <div class="col-md-2"> @include('layouts.sidebar') </div>
    <!-- end sidebar --> 
    
    <!-- content -->
    <div class="col-md-10"> 
        <!-- primary content --> 
        @yield('content')
        <div class="clearfix"></div>
        <!-- end primary content --> 
    </div>
    <div class="clearfix"></div>
    <!-- end content --> 
    
</section>
<!-- end section --> 
</div>
</div>
<!-- footer --> 
@include('layouts.footer') 
<!-- end footer -->







