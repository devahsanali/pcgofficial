<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Admin Panel</title>
     <!--favicon-->
  <link rel="icon" href="{{ asset('public/theme/images/favicon.png') }}" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('public/theme/css/bootstrap.min.css') }}" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="{{ asset('public/theme/css/animate.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="{{ asset('public/theme/css/icons.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="{{ asset('public/theme/css/app-style.css') }}" rel="stylesheet"/>
</head>

<body>
 <!-- Start wrapper-->
 <div id="wrapper">
    <div class="card border-primary border-top-sm border-bottom-sm card-authentication1 mx-auto my-5 animated bounceInDown">
        <div class="card-body">
         <div class="card-content p-2">
            <div class="text-center">
                <img src="{{ asset('public/theme/images/logo.png') }}">
            </div>
          <div class="card-title text-uppercase text-center py-3">Sign In</div>
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}            
             <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
               <div class="position-relative has-icon-right">
                  <label for="exampleInputUsername" class="sr-only">Email</label>
                  <input type="email" value="{{ old('email') }}" required autofocus id="email" name="email" class="form-control form-control-rounded" placeholder="Email">
                  <div class="form-control-position">
                      <i class="icon-user"></i>
                  </div>
                  @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                  @endif
               </div>
              </div>
              <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
               <div class="position-relative has-icon-right">
                  <label for="exampleInputPassword" class="sr-only">Password</label>
                  <input type="password" id="password" name="password" required class="form-control form-control-rounded" placeholder="Password">
                  <div class="form-control-position">
                      <i class="icon-lock"></i>
                  </div>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
               </div>
              </div>
            <div class="form-row mr-0 ml-0">
             <div class="form-group col-6">
               <div class="demo-checkbox">
              </div>
             </div>
             <div class="form-group col-6 text-right">
             </div>
            </div>
             <button type="submit" class="btn btn-primary shadow-primary btn-round btn-block waves-effect waves-light">Sign In</button>
              <div class="text-center pt-3">
                <p></p>
                
                <hr>
              </div>
             </form>
           </div>
          </div>
         </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
    </div><!--wrapper-->
    
  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('public/theme/js/jquery.min.js') }}"></script>
  <script src="{{ asset('public/theme/js/popper.min.js') }}"></script>
  <script src="{{ asset('public/theme/js/bootstrap.min.js') }}"></script>
</body>

</html>
