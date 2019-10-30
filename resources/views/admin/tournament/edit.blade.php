@extends('layouts.layout')
@section('content')

<div class="clearfix"></div>
    
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-12">
            <h4 class="page-title">Edit Tournament</h4>
            <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Tournament</li>
            <li class="breadcrumb-item active" aria-current="page">
              <a href="{{route('admin.tournament.manage')}}">Manage</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
         </ol>
       </div>
     </div>
    <!-- End Breadcrumb-->
       <div class="row">
        <div class="col-lg-12">
         @include('admin.includes.alert')
          <div class="card">
             <div class="card-header text-uppercase">Edit</div>
             <div class="card-body">
              <form enctype="multipart/form-data" action="{{route('admin.tournament.upload.image')}}" class="dropzone" id="dropzone">
                  <div class="fallback dropzone">
                    <input name="file[]" id="file" type="file" multiple="multiple">
                  </div>
                  <input type="hidden" name="new_name" value="">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </form> 
              <br/>
                 <form id="form-update">   
                  <p>Title</p>   
                  <div class="input-group mb-3">
                    <input type="text" class="form-control invt" value="{{$tournament->title}}" name="title">
                  </div> 
                  <input type="hidden" name="id" id="id" value="{{$tournament->id}}"/>
                  <p>Type</p>   
                  <div class="input-group mb-3">
                   <select class="custom-select invt" name="type_id" id="type_id">
                    <option value="">Choose...</option>
                    @foreach($types as $type)
                      @if($tournament->type_id == $type->id)
                        <option selected="selected" value="{{$type->id}}">{{$type->title}}</option>
                      @else
                        <option value="{{$type->id}}">{{$type->title}}</option>
                      @endif
                    @endforeach
                  </select>
                  </div> 
                  <p>Platform</p>   
                  <div class="input-group mb-3">
                    <input type="text" class="form-control invt" id="platform" value="{{$tournament->platform}}" name="platform">
                    <label class="error"></label>
                  </div> 
                  <input type="hidden" name="fileName" id="fileName" value=""/>
                  <p>Start Date</p>   
                  <div class="input-group mb-3">
                    <input type="text" class="form-control invt autoclose-datepicker"  value="{{$tournament->start_date}}" name="start_date">
                  </div> 
                  <p>End Date</p>   
                  <div class="input-group mb-3">
                    <input type="text" class="form-control invt autoclose-datepicker" value="{{$tournament->end_date}}" name="end_date">
                  </div> 
                  <p>Entry Charges</p>   
                  <div class="input-group mb-3">
                    <input type="text" class="form-control invt" value="{{$tournament->entry_charges}}" name="entry_charges">
                  </div> 
                  <span id="team">
                    <p>No Of Teams</p>   
                    <div class="input-group mb-3">
                      <input type="text" class="form-control invt" name="no_of_teams" value="{{$tournament->no_of_teams}}">
                    </div> 
                  </span>
                  <p>No Of Players</p>   
                  <div class="input-group mb-3">
                    <input type="text" class="form-control invt" name="no_of_players" value="{{$tournament->no_of_players}}">
                  </div>
                  <p>Awarding Price</p>   
                  <div class="input-group mb-3">
                    <input type="text" class="form-control invt" name="awarding_price" value="{{$tournament->awarding_price}}">
                  </div> 
                  <p>Description</p>   
                  <textarea class="summernoteEditor" class="form-control invt" name="description" id="description">
                    {!!$tournament->description!!}
                  </textarea>
                  <button type="submit" class="btn btn-primary update btn-lg btn-block waves-effect waves-light m-1">Submit</button>
                </form>                
            </div>
          </div>
        </div>

    </div>
    <!-- End container-fluid-->
    </div><!--End content-wrapper-->
<script>
    var allFile = new Array();
    var findImage  = "{{$tournament->images}}";
    var image_path = "{{env('PRODUCT_IMAGES')}}";
    <?php foreach($tournament->images as $key => $val){ ?>
        allFile.push('<?php echo $val; ?>');
    <?php } ?>
    var images = Array();
    for (var i = 0; i < JSON.parse(allFile.length); i++){
        images.push(JSON.parse(allFile[i]).image);
        document.getElementById('fileName').value += JSON.parse(allFile[i]).image+"~~";
    }
</script>
@include('admin.tournament.includes.tournamentJs')
@include('admin.tournament.includes.editJs')

@endsection
