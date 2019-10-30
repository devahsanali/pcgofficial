@extends('layouts.layout')
@section('content')

<div class="clearfix"></div>
    
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-12">
            <h4 class="page-title">Create Tournament</h4>
            <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Tournament</li>
            <li class="breadcrumb-item active" aria-current="page">
              <a href="{{route('admin.tournament.manage')}}">Manage</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
         </ol>
       </div>
     </div>
    <!-- End Breadcrumb-->
       <div class="row">
        <div class="col-lg-12">
         @include('admin.includes.alert')
          <div class="card">
             <div class="card-header text-uppercase">Create</div>
             <div class="card-body">
              <form enctype="multipart/form-data" action="{{route('admin.tournament.upload.image')}}" class="dropzone" id="dropzone">
                  <div class="fallback dropzone">
                    <input name="file[]" id="file" type="file" multiple="multiple">
                  </div>
                  <input type="hidden" name="new_name" value="">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </form> 
              <br/>
                 <form id="form-create">   
                  <p>Title</p>   
                  <div class="input-group mb-3">
                    <input type="text" class="form-control invt" name="title">
                  </div> 
                  <p>Type</p>   
                  <div class="input-group mb-3">
                   <select class="custom-select invt" name="type_id" id="type_id">
                    <option value="">Choose...</option>
                    @foreach($types as $type)
                    <option value="{{$type->id}}">{{$type->title}}</option>
                    @endforeach
                  </select>
                  </div> 
                  <p>Platform</p>   
                  <div class="input-group mb-3">
                    <input type="text" class="form-control invt" id="platform" name="platform">
                    <label class="error"></label>
                  </div> 
                  <input type="hidden" name="fileName" id="fileName" value=""/>
                  <p>Start Date</p>   
                  <div class="input-group mb-3">
                    <input type="text" class="form-control invt autoclose-datepicker" name="start_date">
                  </div> 
                  <p>End Date</p>   
                  <div class="input-group mb-3">
                    <input type="text" class="form-control invt autoclose-datepicker" name="end_date">
                  </div> 
                  <p>Entry Charges</p>   
                  <div class="input-group mb-3">
                    <input type="text" class="form-control invt" name="entry_charges">
                  </div> 
                  <span id="team">
                    <p>No Of Teams</p>   
                    <div class="input-group mb-3">
                      <input type="text" class="form-control invt" name="no_of_teams">
                    </div> 
                  </span>
                  <p>No Of Players</p>   
                  <div class="input-group mb-3">
                    <input type="text" class="form-control invt" name="no_of_players">
                  </div>
                  <p>Awarding Price</p>   
                  <div class="input-group mb-3">
                    <input type="text" class="form-control invt" name="awarding_price">
                  </div> 
                  <p>Description</p>   
                  <textarea class="summernoteEditor" class="form-control invt" name="description" id="description">
                  </textarea>
                  <button type="submit" class="btn btn-primary create btn-lg btn-block waves-effect waves-light m-1">Create</button>
                </form>                
            </div>
          </div>
        </div>

    </div>
    <!-- End container-fluid-->
    </div><!--End content-wrapper-->
@include('admin.tournament.includes.tournamentJs')

@endsection
