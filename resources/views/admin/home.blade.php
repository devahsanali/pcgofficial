@extends('layouts.admin')

@section('content')

<div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>Widget Settings</h3>
      </div>
      <div class="modal-body"> Widget settings form goes here </div>
    </div>
    <div class="clearfix"></div>
    <div class="content ">
      <div class="page-title">
        <h3>Dashboard </h3>
      </div>
      <div id="container">
         
        <div class="row 2col bottom-space">
            
          <div class="col-md-3 ">
            <div class="tiles white  card-box-title">
              <div class="tiles-body">
                <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                <div class="tiles-title"> TOTAL REVENUE </div>
                
                <div class="heading">AED <span class="animate-number" data-value="" data-animation-duration="1200">0</span> </div>
                
                
              </div>
            </div>
          </div>
          
          <div class="col-md-3 ">
            <div class="tiles white  card-box-title">
              <div class="tiles-body">
                <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                <div class="tiles-title"> TOTAL BOOKINGS </div>
               
                <div class="heading"> <span class="animate-number" data-value=" " data-animation-duration="1000">0</span> </div>
                
                
              </div>
            </div>
          </div>
          
          <div class="col-md-3 ">
            <div class="tiles white card-box-title">
              <div class="tiles-body">
                <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                <div class="tiles-title"> TOTAL MANUAL BOOKING </div>
                
                <div class="heading">  <span class="animate-number" data-value="" data-animation-duration="1200">0</span> </div>
                
                
              </div>
            </div>
          </div>
          
          <div class="col-md-3 ">
            <div class="tiles white  card-box-title">
              <div class="tiles-body">
                <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                <div class="tiles-title"> TOTAL ONLINE BOOKING</div>
                <div class="row-fluid">
                   
                  <div class="heading"> <span class="animate-number" data-value="" data-animation-duration="700">0</span> </div>
                 
                </div>
                
              </div>
            </div>
          </div>
          
        </div>
        
            
        <div class="row 2col bottom-space">
            
            <div class="col-lg-4">
                <div class="card-box" style="height: 370px;">
                   
                    <div class="dropdown pull-right">
                        <select class="select_period" name="period_total_revenue" id="period_data"  >
                            <option value="1" >Daily</option>
                            <option value="4" >Weekly</option>
                            <option value="2" >Montly</option>
                            <option selected value="3" >Yearly</option>
                        </select>
                    </div>
                     <h4 class="header-title m-t-0">Total Revenue</h4>
                    <div id="total_revenue" style="height: 280px;"></div>
                </div>
            </div><!-- end col -->
            
            <div class="col-lg-4">
                <div class="card-box">
                    <h4 class="header-title m-t-0">Daily Sales</h4>
    
                    <div class="widget-chart text-center">
                        <div id="sales-chart"style="height: 245px;"></div>

                    </div>
                </div>
            </div><!-- end col -->
            
            <div class="col-lg-4">
                <div class="card-box" style="height: 370px;">
                   
                    <div class="dropdown pull-right">
                        <select class="manual_booking" name="manual_booking" id="manual_booking"  >
                            <option value="1" >Daily</option>
                            <option value="4" >Weekly</option>
                            <option value="2" >Montly</option>
                            <option selected value="3" >Yearly</option>
                        </select>
                    </div>
                     <h4 class="header-title m-t-0">Comparison</h4>
                    <div id="manual_booking_revenue" style="height: 280px;"></div>
                </div>
            </div><!-- end col -->
          
                            
        </div>
      
             <div class="row 2col bottom-space">
        
            <div class="col-lg-4">
                <div class="card-box">
                    <div class="dropdown pull-right">
                        <select class="select_period" name="period" data-id="cat-graph" data-cat-id="" >
                            <option value="1" >Daily</option>
                            <option value="4" >Weekly</option>
                            <option value="2" >Montly</option>
                            <option selected value="3" >Yearly</option>
                        </select>
                    </div>
                    <h4 class="header-title m-t-0"> Revenue</h4>
                    <div id="cat-graph" style="height: 280px;"></div>
                </div>
            </div><!-- end col -->
               
        
       
      
      </div>
      <!-- END PAGE -->
    </div>
  </div>
  <script type="text/javascript">
  $(document).ready(function () {
     $('.select_period').change(function() {
         
         var div_id = $(this).data('id');
         var cat_id = $(this).data('cat-id');
         
         $("#"+div_id).empty();
         var value = $(this).val();
        //  console.log(value);
        var color;
         if(value == 1) //daily
         {
             color =  "rgb(242,192,32)";
        
         }
         else if(value == 2) //montly
         {
             color =  "rgb(237,119,195)";
        
         }
         else if(value == 3) //yearly
         {
             color =  "rgb(43,109,209)";
        
         }
         else if(value == 4) //weekly
         {
             color =  "rgb(13,109,209)";
        
         }
         
         $.ajax({
            url: "<?= URL::to('') ?>/admin/dashboard/graph",
            data: {cat_id : cat_id,time_period:value},
            type: "post",
            dataType: "json",
            error: function(jqXHR, textStatus, errorThrown)
            {
                console.log("Request not completed.Please try Again");
            },
            success: function(data) {
           //   console.log(data);
                var data_array = [];
                for (var  i=0;i<data.length;i++) 
                  {
                      var temp_obj = new Object();
                      temp_obj.pushups = data[i]['count'];
                      temp_obj.day = data[i]['month'];
                      //console.log(total_revenue[i]['count']);
                      data_array.push(temp_obj);
                  }
                new Morris.Area({
                  element: div_id,
                  data: data_array,
                  xkey: 'day',
                  parseTime: false,
                  ykeys: ['pushups'],
                  labels: ['Revenue'],
                  hideHover: 'auto',
                  lineColors: [color]
                });
                
        
            }
        });
         
     });
     
     $('#period_data').change(function() {
         
         $("#total_revenue").empty();
         var value = $('select[name="period_total_revenue"] option:selected').val();
        //  console.log(value);
        var color;
        var barratio;
         if(value == 1) //daily
         {
             color =  "rgb(242,192,32)";
             barratio = 0.4;
         }
         else if(value == 2) //weekly
         {
             color =  "rgb(237,119,195)";
             barratio = 0.4;
         }
         else if(value == 3) //yearly
         {
             color =  "rgb(43,109,209)";
             barratio = 0.2;
             
         }
         else if(value == 4) //weekly
         {
             color =  "rgb(13,109,209)";
        
         }
         
         $.ajax({
            url: "<?= URL::to('') ?>/admin/dashboard/graph",
            data: {bar:'2' ,time_period:value},
            type: "post",
            dataType: "json",
            error: function(jqXHR, textStatus, errorThrown)
            {
                console.log("Request not completed.Please try Again");
            },
            success: function(data) {
           //   console.log(data);
                var data_array = [];
                for (var  i=0;i<data.length;i++) 
                  {
                      var temp_obj = new Object();
                      temp_obj.a = data[i]['count'];
                      temp_obj.y = data[i]['month'];
                      //console.log(total_revenue[i]['count']);
                      data_array.push(temp_obj);
                  }
                
                var bar = new Morris.Bar({
                  barGap:4,
                  barSizeRatio:barratio,
                  element: 'total_revenue',
                  resize: true,
                  data: data_array,
                  barColors: function (row, series, type) {
                    return [color];
                },
                hoverCallback: function (index, options, content, row) {
                    //  console.log(row);
                     var hover = "<div class='morris-hover-row-label'>Revenue</div><div class='morris-hover-point' style='color: #A4ADD3'><p color:black>"+row.a+"</p></div>";
                      return hover;
                    },
                  xkey: 'y',
                  ykeys: ['a'],
                  labels: ['Booking'],
                  barRatio: 100,
                  hideHover: 'auto',
                  xLabelAngle :35,
                });
                
                
        
            }
        });
         
     });
     
     $('#manual_booking').change(function() {
         
         $("#manual_booking_revenue").empty();
         var value = $('select[name="manual_booking"] option:selected').val();
        //  console.log(value);
        var color ;
        var barratio;
         if(value == 1) //daily
         {
             color =  "rgb(242,192,32)";
             barratio = 0.4;
         }
         else if(value == 2) //weekly
         {
             color =  "rgb(237,119,195)";
             barratio = 0.4;
         }
         else if(value == 3) //yearly
         {
             color =  "rgb(43,109,209)";
             barratio = 0.2;
             
         }
         else if(value == 4) //weekly
         {
             color =  "rgb(13,109,209)";
        
         }
         
         $.ajax({
            url: "<?= URL::to('') ?>/admin/dashboard/graph",
            data: {bar_2:'2' ,time_period:value},
            type: "post",
            dataType: "json",
            error: function(jqXHR, textStatus, errorThrown)
            {
                console.log("Request not completed.Please try Again");
            },
            success: function(data) {
           //   console.log(data);
                var data_array = [];
                for (var  i=0;i<data.length;i++) 
                  {
                      var temp_obj = new Object();
                      temp_obj.a = data[i]['AdminCount'];
                      temp_obj.b = data[i]['UserCount'];
                      temp_obj.y = data[i]['YEAR'];
                      //console.log(total_revenue[i]['count']);
                      data_array.push(temp_obj);
                  }
                
                var bar = new Morris.Bar({
                  barGap:4,
                  barSizeRatio:barratio,
                  element: 'manual_booking_revenue',
                  resize: true,
                  data: data_array,
                  colors: [color,"rgb(43,109,209)"]
                ,
                 hoverCallback: function (index, options, content, row) {
                    //   console.log(row);
                     var hover = "<div class='morris-hover-row-label'>Count</div><div class='morris-hover-point' style='color: #A4ADD3'><p color:black>Users: "+row.a+"</p><p> Admin: "+row.b+"</p></div>";
                      return hover;
                    },
                  xkey: 'y',
                  ykeys: ['a','b'],
                  labels: ['Booking'],
                  barRatio: 100,
                  hideHover: 'auto',
                  xLabelAngle :35,
                });
                
                
        
            }
        });
         
     });
  });

  
  $(function () {
    
    "use strict";
    
    //BAR CHART COMPAIR
    $.ajax({
            url: "<?= URL::to('') ?>/admin/dashboard/graph",
            data: {bar_2: '1'},
            type: "post",
            dataType: "json",
            error: function(jqXHR, textStatus, errorThrown)
            {
                console.log("Request not completed.Please try Again");
            },
            success: function(data) {
           //   console.log(data);
                var data_array = [];
                for (var  i=0;i<data.length;i++) 
                  {
                      var temp_obj = new Object();
                      temp_obj.a = data[i]['AdminCount'];
                      temp_obj.b = data[i]['UserCount'];
                      temp_obj.y = data[i]['YEAR'];
                      //console.log(total_revenue[i]['count']);
                      data_array.push(temp_obj);
                  }
                 
                var $arrColors = ["#157DEC","#3EA055","#ffff00","#FF0000","#FF00FF","#00ff00","#fcdfff","#571B7E","#0000ff","#d3d3d3","#614051","#000000"];
                var bar = new Morris.Bar({
                  barGap:4,
                  barSizeRatio:0.2,
                  element: 'manual_booking_revenue',
                  resize: true,
                  data: data_array,
                  colors: ["rgb(43,109,209)", "rgb(237,119,195)"],
                hoverCallback: function (index, options, content, row) {
                    //   console.log(row);
                     var hover = "<div class='morris-hover-row-label'>Count</div><div class='morris-hover-point' style='color: #A4ADD3'><p color:black>Users: "+row.a+"</p><p> Admin: "+row.b+"</p></div>";
                      return hover;
                    },
                  xkey: 'y',
                  ykeys: ['a','b'],
                  labels: ['Booking'],
                  barRatio: 100,
                  hideHover: 'auto'
                });
                
        
            }
        });

    //BAR CHART
    $.ajax({
            url: "<?= URL::to('') ?>/admin/dashboard/graph",
            data: {bar: '1'},
            type: "post",
            dataType: "json",
            error: function(jqXHR, textStatus, errorThrown)
            {
                console.log("Request not completed.Please try Again");
            },
            success: function(data) {
           //   console.log(data);
                var data_array = [];
                for (var  i=0;i<data.length;i++) 
                  {
                      var temp_obj = new Object();
                      temp_obj.a = data[i]['count'];
                      temp_obj.y = data[i]['month'];
                      //console.log(total_revenue[i]['count']);
                      data_array.push(temp_obj);
                  }
                 
                var $arrColors = ["#157DEC","#3EA055","#ffff00","#FF0000","#FF00FF","#00ff00","#fcdfff","#571B7E","#0000ff","#d3d3d3","#614051","#000000"];
                var bar = new Morris.Bar({
                  barGap:4,
                  barSizeRatio:0.2,
                  element: 'total_revenue',
                  resize: true,
                  data: data_array,
                  barColors: function (row, series, type) {
                    return ['rgb(43,109,209)'];
                },
                hoverCallback: function (index, options, content, row) {
                    //  console.log(row);
                     var hover = "<div class='morris-hover-row-label'>Revenue</div><div class='morris-hover-point' style='color: #A4ADD3'><p color:black>"+row.a+"</p></div>";
                      return hover;
                    },
                  xkey: 'y',
                  ykeys: ['a'],
                  labels: ['Booking'],
                  barRatio: 100,
                  hideHover: 'auto'
                });
                
        
            }
        });
    
    
    //DONUT CHART
    $.ajax({
            url: "<?= URL::to('') ?>/admin/dashboard/graph",
            data: {donut:1},
            type: "post",
            dataType: "json",
            error: function(jqXHR, textStatus, errorThrown)
            {
                console.log("Request not completed.Please try Again");
            },
            success: function(data) {
           //   console.log(data);
                var data_array = [];
                for (var  i=0;i<data.length;i++) 
                  {
                      var temp_obj = new Object();
                      temp_obj.value = data[i]['count'];
                      temp_obj.label = data[i]['month'];
                      //console.log(total_revenue[i]['count']);
                      data_array.push(temp_obj);
                  }
                 
                var donut = new Morris.Donut({
                  element: 'sales-chart',
                  resize: true,
                  colors: ["rgb(43,109,209)", "rgb(237,119,195)", "rgb(242,192,32)","rgb(90,192,113)"],
                  data: data_array,
                  hideHover: 'auto'
                });
                
        
            }
        });
    
    
    //vertical chart
    $.ajax({
            url: "<?= URL::to('') ?>/admin/dashboard/graph",
            data: {v_bar:1},
            type: "post",
            dataType: "json",
            error: function(jqXHR, textStatus, errorThrown)
            {
                console.log("Request not completed.Please try Again");
            },
            success: function(data) {
           //   console.log(data);
                var label_array = [];
                var series_array = [];
                for (var  i=0;i<data.length;i++) 
                  {
                      label_array.push(data[i]['tour_name']);
                      series_array.push(data[i]['count']);
                  }
           //   new Chartist.Bar('#horizontal-bar-chart', {
        //           labels: label_array,
        //           series: [
        //             series_array
        //           ]
        //         }, {
        //           seriesBarDistance: 10,
        //           reverseData: true,
        //           horizontalBars: true,
        //           axisY: {
        //             offset: 70
        //           },
        //           plugins: [
        //             Chartist.plugins.tooltip()
        //           ]
        //         });
                
        
            }
        });
    
    var cat_size = $("input[name='cat_size']").val();
    
    for(var i= 0;i<category_data.length;i++)
    {
        // console.log(arrColor[i]);
        $.ajax({
            url: "<?= URL::to('') ?>/admin/dashboard/graph",
            data:{id:category_data[i]['category_id']},
            type: "post",
            async:false,
            dataType: "json",
            error: function(jqXHR, textStatus, errorThrown)
            {
                console.log("Request not completed.Please try Again");
            },
            success: function(data) {
           //   console.log(data);
                var data_array = [];
                var cat_id;
                for (var  j=0;j<data.length;j++) 
                  {
                      var temp_obj = new Object();
                      cat_id = data[j]['cat_id'];
                      temp_obj.pushups = data[j]['count'];
                      temp_obj.day = data[j]['month'];
                      //console.log(total_revenue[i]['count']);
                      data_array.push(temp_obj);
                  }
                  var arrColor = ["rgb(43,109,209)", "rgb(237,119,195)", "rgb(242,192,32)","rgb(90,192,113)"];
                //   console.log(i);
                  var array = [];
                  array.push(arrColor[i]);
                //   console.log("color"+array);
                new Morris.Area({
                  element: 'cat-graph'+cat_id,
                  data: data_array,
                  xkey: 'day',
                  parseTime: false,
                  barRatio: 100,
                  ykeys: ['pushups'],
                  labels: ['Revenue'],
                  hideHover: 'auto',
                  lineColors: array
                });
        
            }
        });
        
    }
    
  });
  
  
 
  </script>
@endsection
