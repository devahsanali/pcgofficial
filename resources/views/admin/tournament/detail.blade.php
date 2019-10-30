@extends('layouts.layout')
@section('content')
<div class="clearfix"></div>
    
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-12">
            <h4 class="page-title">Tournament Details</h4>
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page">Tournament</li>
              <li class="breadcrumb-item active" aria-current="page">
               <a href="{{route('admin.tournament.manage')}}">Manage</a>
              </li> 
              <li class="breadcrumb-item active" aria-current="page">Details</li> 
            </ol>
       </div>
     </div>
    <!-- End Breadcrumb-->
      <div class="row">
        <div class="col-lg-12">
            @include('admin.includes.alert')
            <div class="card">
              <div class="card-body"> 
                <ul class="nav nav-tabs nav-tabs-primary">
                  <li class="nav-item">
                    <a class="nav-link active show" data-toggle="tab" href="#tabe-1"><i class="icon-home"></i> <span class="hidden-xs">Details</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link " data-toggle="tab" href="#tabe-2"><i class="icon-people icons"></i> <span class="hidden-xs">Player</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link " data-toggle="tab" href="#tabe-3"><i class="icon-clock icons"></i> <span class="hidden-xs">Schedule</span></a>
                  </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                  <div id="tabe-1" class="container tab-pane active show">
                   <div class="col-lg-12">
                    <div class="card card-primary" style="width: 100px;">
                      <img src="{{env('PRODUCT_IMAGES')}}{{@$tournament->images[0]->image}}" alt="{{$tournament->title}}" class="card-img-top">
                    </div>
                   </div>
                    <table class="table table-bordered">
                      <tbody>
                        @if(isset($error))
                        <tr>
                          <th colspan="2">
                            No Result Found
                          </th>
                        </tr>
                        @else
                        <tr>
                          <th scope="col">Title</th>
                          <td>{{$tournament->title}}</td>
                        </tr>
                        <tr>
                          <th scope="col">Type</th>
                          <td>{{$tournament->type->title}}</td>
                        </tr>
                        <tr>
                          <th scope="col">Status</th>
                          <td>{{($tournament->status == 1)? 'Active' : 'Disable' }}</td>
                        </tr>
                         <tr>
                          <th scope="col">Platform</th>
                          <td>{{$tournament->platform}}</td>
                        </tr>
                        <tr>
                          <th scope="col">Start Date</th>
                          <td>{{dt_format($tournament->start_date)}}</td>
                        </tr>
                        <tr>
                          <th scope="col">End Date</th>
                          <td>{{dt_format($tournament->end_date)}}</td>
                        </tr>
                        <tr>
                          <th scope="col">Entry Charges</th>
                          <td>{{$tournament->entry_charges}}</td>
                        </tr>
                        <tr>
                          <th scope="col">Teams</th>
                          <td>{{$tournament->no_of_teams}}</td>
                        </tr>
                        <tr>
                          <th scope="col">Players</th>
                          <td>{{ $tournament->no_of_players }}</td>
                        </tr>
                        <tr>
                          <th scope="col">Awarding Price</th>
                          <td>{{ $tournament->awarding_price }}</td>
                        </tr>
                         <tr>
                          <th scope="col">Description</th>
                          <td>{!! $tournament->description !!}</td>
                        </tr>    
                        <tr>                      
                          <th>Images</th>
                          <td align="center">
                            <div class="col-lg-4">
                              <div id="carousel-3" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                  @for($i = 0; $i< sizeof($tournament->images); $i++)
                                  @if($i == 0)
                                  <div class="carousel-item active">
                                  @else
                                  <div class="carousel-item">
                                  @endif
                                    <img class="d-block w-100"  src="{{env('PRODUCT_IMAGES')}}{{$tournament->images[$i]->image}}" alt="">
                                  </div>
                                  @endfor
                                </div>
                                <a class="carousel-control-prev" href="#carousel-3" role="button" data-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel-3" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                                </a>
                             </div>
                           </div>
                          </td>
                        </tr>
                        @endif
                      </tbody>
                    </table>
                  </div>
                  <div id="tabe-2" class="container tab-pane fade">
                    <table class="table table-bordered">
                      <tbody>
                        @if(isset($error))
                        <tr>
                          <th colspan="2">
                            No Result Found
                          </th>
                        </tr>
                        @else
                        <tr>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Phone</th>
                          <th scope="col">Registration Date</th>
                        </tr>
                        @foreach($players as $player)
                          <tr>
                            <td>{{$player->tournamentUser->name}}</td>
                            <td>{{$player->tournamentUser->email}}</td>
                            <td>{{$player->tournamentUser->phone}}</td>
                            <td>{{dt_format($player->created_at)}}</td>
                          </tr>
                        @endforeach
                        @endif
                      </tbody>
                    </table>
                  </div>
                  <div id="tabe-3" class="container tab-pane fade">
                    <table class="table table-bordered">
                      <tbody>
                        @if(isset($error))
                        <tr>
                          <th colspan="2">
                            No Result Found
                          </th>
                        </tr>
                        @else
                        <tr>
                          <th colspan="2">
                            <a href="{{route('admin.tournament.schedule.delete', $tournament->id)}}">
                             <button type="button" class="btn-sm btn-dark waves-effect waves-light m-1" title="Delete"> <i class="fa fa-trash"></i></button>
                            </a>
                          </th>
                        </tr>
                        <tr>
                          <th scope="col">Player1</th>
                          <th scope="col">Player2</th>
                        </tr>
                        @foreach($schedules as $schedule)
                          <tr>
                            <td>{{$schedule->scheduleUser1->name}}</td>
                            <td>{{$schedule->scheduleUser2->name}}</td>
                          </tr>
                        @endforeach
                        @endif
                      </tbody>
                    </table>
                  </div>
              </div>
           </div>
  </div>
  </div>
@endsection
