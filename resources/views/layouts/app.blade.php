<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{@$title}}</title>
  <!--favicon-->
  <link rel="icon" href="{{ asset('public/theme/images/favicon.png') }}" type="image/x-icon">
  <link href="{{ asset('public/theme/plugins/dropzone/css/dropzone.css') }}" rel="stylesheet" type="text/css">
  <!-- simplebar CSS-->
  <link href="{{ asset('public/theme/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('public/theme/css/bootstrap.min.css') }}" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="{{ asset('public/theme/css/animate.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="{{ asset('public/theme/css/icons.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="{{ asset('public/theme/css/sidebar-menu.css') }}" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="{{ asset('public/theme/css/app-style.css') }}" rel="stylesheet"/>
  <!-- Wordpad -->
  <link rel="stylesheet" href="{{ asset('public/theme/plugins/summernote/dist/summernote-bs4.css')}}" rel="stylesheet"/>
  <!-- Tag input -->
  <link rel="stylesheet" href="{{ asset('public/theme/plugins/inputtags/css/bootstrap-tagsinput.css')}}" rel="stylesheet"/>
   <!-- Date Picker -->
  <link href="{{ asset('public/theme/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet"/>
   <!--switch button-->
  <link href="{{ asset('public/theme/plugins/switchery/css/switchery.min.css')}}" rel="stylesheet" />
  <link href="{{ asset('public/theme/plugins/bootstrap-switch/bootstrap-switch.min.css')}}" rel="stylesheet" />

  <link href="{{ asset('public/theme/css/custom.css') }}" rel="stylesheet"/>

  <script src="{{ asset('public/theme/js/jquery.min.js') }}"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

  <!-- Dropzone JS  -->
  <script src="{{ asset('public/theme/plugins/dropzone/js/dropzone.js') }}"></script>
  <style>
   .search-link{
      cursor: pointer;
    }
  </style>
</head>

<body>

<!-- Start wrapper-->
 <div id="wrapper">
 
   <!--Start sidebar-wrapper-->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="{{route('admin.home')}}">
       <!-- <img src="{{asset('public/theme/images/favicon.png')}}" class="logo-icon" alt="logo icon"> -->
        <h5 class="logo-text">Admin Panel</h5> 
     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol">
      <li class="sidebar-header">MAIN NAVIGATION</li>
      <li>
        <a href="{{route('home')}}" class="waves-effect">
          <i class="icon-layers"></i> <span>Home</span>
        </a>
      </li>
    </ul>
   
   </div>
   <!--End sidebar-wrapper-->

<!--Start topbar header-->
<header class="topbar-nav">
 <nav class="navbar navbar-expand fixed-top bg-white">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
       <i class="iconl-menu menu-iconl"></i>
     </a>
    </li>
  </ul>    
  <ul class="navbar-nav align-items-center right-nav-link">
 
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="{{ route('logout') }}" 
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <span class="user-profile"><i class="icon-power mr-2"></i>
          Log Out
        </span>
      </a>
    </li>
  </ul>
</nav>
</header>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
<!--End topbar header-->
     @include('admin.includes.customJs')


        @yield('content')

 <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
  
  <!--Start footer-->
  <footer class="footer">
      <div class="container">
        <div class="text-center">
         
        </div>      
      </div>
    </footer>
  <!--End footer-->
   
  </div><!--End wrapper-->


  <!-- Bootstrap core JavaScript-->

  <script src="{{ asset('public/theme/js/popper.min.js') }}"></script>
  <script src="{{ asset('public/theme/js/bootstrap.min.js') }}"></script>
  
  <!-- simplebar js -->
  <script src="{{ asset('public/theme/plugins/simplebar/js/simplebar.js') }}"></script>
  <!-- waves effect js -->
  <script src="{{ asset('public/theme/js/waves.js') }}"></script>
  <!-- sidebar-menu js -->
  <script src="{{ asset('public/theme/js/sidebar-menu.js') }}"></script>
  <!-- Custom scripts -->
  <script src="{{ asset('public/theme/js/app-script.js') }}"></script>
  <!-- Word pad-->
  <script src="{{ asset('public/theme/plugins/summernote/dist/summernote-bs4.min.js') }}"></script>
  <!-- Tag input-->
  <script src="{{ asset('public/theme/plugins/inputtags/js/bootstrap-tagsinput.js') }}"></script>
   <!-- Date picker-->
  <script src="{{ asset('public/theme/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
   <!-- Switch Button-->
  <script src="{{ asset('public/theme/plugins/switchery/js/switchery.min.js') }}"></script>
  <script src="{{ asset('public/theme/plugins/bootstrap-switch/bootstrap-switch.min.js') }}"></script>
  <!-- Custom js-->
  <script src="{{ asset('public/js/custom.js') }}"></script>
  <script>
    function find(){
      var keyword = $("#search").val();
      var type    = $("#search_option").val();
      window.location.href = "{{route('admin.search')}}?keyword="+keyword+"&type="+type;
    }
    function findbykey(e){
      if(e.keyCode == 13){
        find();
      }
    }
   
    
  </script>
</body>
</html>
