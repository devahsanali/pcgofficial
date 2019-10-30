@extends('layouts.admin')

@section('content')
  <div class="page-content">
    <div class="content">
      <ul class="breadcrumb">
        <li>
          <p>Dashboard</p>
        </li>
        <li><a href="#" class="active">Create User</a> </li>
      </ul>
     <!--  <div class="page-title"> <i class="icon-custom-left"></i>
       <h3><span class="semi-bold">Back</span></h3>
     </div> -->
    <!-- BEGIN BASIC FORM ELEMENTS-->
        <div class="row">
            <div class="col-md-12">
              <div class="grid simple">
                <div class="grid-title no-border">
                  <h4>Create New User <span class="semi-bold"></span></h4>
                </div>
                <div class="grid-body no-border"> <br>
                  <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-8">
                      <form method="POST" action="{{ route('admin.post.register') }}">
                        @csrf
                        
                        <div class="form-group">
                          <label class="form-label">Name <span class="red_asterisk">*</span></label>
                          <div class="input-with-icon right controls">
                            <i class=""></i>
                             <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Enter Name"  autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="form-label">Email <span class="red_asterisk">*</span></label>
                          <div class="input-with-icon right controls">
                            <i class=""></i>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"  placeholder="Enter Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="form-label">Password <span class="red_asterisk">*</span></label>
                          <div class="input-with-icon right controls">
                            <i class=""></i>
                           <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="form-label">Confirm Password<span class="red_asterisk">*</span></label>
                          <div class="input-with-icon right controls">
                            <i class=""></i>
                           <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          </div>
                        </div>

                        <div class="form-group">
                              <button class="btn btn-primary btn-cons ajaxFormSubmitAlter pull-right" type="button">Submit</button>      
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- END BASIC FORM ELEMENTS-->  
@endsection
