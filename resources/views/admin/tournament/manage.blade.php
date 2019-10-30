@extends('layouts.layout')
@section('content')

<div class="clearfix"></div>
    
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-12">
            <h4 class="page-title">Manage Tournament</h4>
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page">Tournaments</li>
              <li class="breadcrumb-item active" aria-current="page">
               <a href="{{route('admin.tournament.manage')}}">Manage</a>
             </li> 
            </ol>
       </div>
     </div>
    <!-- End Breadcrumb-->
      <div class="row">
        <div class="col-lg-12">
            @include('admin.includes.alert')
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">All Tournaments</h5>
              <div class="table">
               <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col" colspan="2">Title</th>
                      <th scope="col">Type</th>
                      <th scope="col">Platform</th>
                      <th scope="col">Players</th>
                      <th scope="col">Start</th>
                      <th scope="col">End</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  @php($i= $tournaments->perPage() * ($tournaments->currentPage() - 1)+1)
                  <tbody>
                    @if(isset($error))
                    <tr>
                      <th colspan="6">
                        No Result Found
                      </th>
                    </tr>
                    @else
                    @foreach($tournaments as $tournament)
                    <tr>
                      <th scope="row">{{$i++}}</th>
                      <td>
                        @if(!isset($tournament->images[0]->image))
                            <img width="40" src="" title="Image not found"/>
                        @else
                            <img width="40" src="{{env('PRODUCT_IMAGES')}}{{$tournament->images[0]->image}}"/>
                        @endif
                      </td>
                      <td class="pro-title">{{$tournament->title}}</td>
                      <td class="pro-title">{{$tournament->type->title}}</td>
                      <td>{{$tournament->platform}}</td>
                      <td>{{$tournament->no_of_players}}</td>
                      <td>{{dt_format($tournament->start_date)}}</td>
                      <td>{{dt_format($tournament->end_date)}}</td>
                      <td>
                        @php($status = ($tournament->status == 1)? 'checked' :'')
                        @php($tournament_id = $tournament->id)
                        <input type="checkbox" {{$status}} onchange="update_status('{{$tournament_id}}')" data-size="small" class="js-switch update_status"/>  
                      </td>
                      <td class="action-buttons">
                        <a href="{{route('admin.tournament.details', $tournament->id)}}">
                          <button type="button" class="btn-sm btn-dark waves-effect waves-light m-1" title="View Detail"> <i class="fa fa-eye"></i> </button>
                        </a>
                        <a href="{{route('admin.tournament.edit', $tournament->id)}}">
                          <button type="button" class="btn-sm btn-dark waves-effect waves-light m-1" title="Edit"> <i class="fa fa-pencil"></i></button>
                        </a>
                        <a href="{{route('admin.tournament.schedule', $tournament->id)}}">
                          <button type="button" class="btn-sm btn-dark waves-effect waves-light m-1" title="Create Schedule"> <i class="fa fa-calendar"></i></button>
                        </a>
                         <button type="button" class="btn-sm btn-dark waves-effect waves-light m-1" onclick="item_delete({{$tournament->id}})" title="Delete"> <i class="fa fa-trash"></i></button>
                         
                      </td>
                    </tr>
                    
                    @endforeach
                    @endif
                  </tbody>
                </table>

            </div>
            </div>
          </div>
        </div>
      </div><!--End Row-->
   @include('admin.tournament.includes.tournamentJs')
 <?php if(isset($tournaments)){?>    
 {!! $tournaments->render() !!}
 <?php }?>
    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
@endsection