@extends('action.layouts.default')

@section('content')
 <!--BEGIN CONTENT-->

                <div class="panel panel-default">
                <div class="col-md-5 tile"><h2>Total Budget : <b> {{String::formatMoney($total)}}</b>  </h2></div>
                <div class="col-md-4"></div>
                <div class="col-lg-2 pull-right "><h2 class="pull-right"> <b> {{$year->year}}</b>  </h2></div>

                        <div class="panel-body">
                        <div class="row">

                             <div class="col-sm-12 col-md-12">
                              <!-- top tiles -->
                                       <div class="row tile_count text-center">@foreach($budgets as $budget)
                                         <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                                           <span class="count_top"> {{$budget->zone}}</span>
                                           <div class=""><b>{{ $sum = String::formatMoney($budget->OBJECTIVEA +$budget->OBJECTIVEB + $budget->OBJECTIVEC + $budget->OBJECTIVED + $budget->OBJECTIVEE)}}</b></div>
                                        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>{{number_format((float)(($budget->OBJECTIVEA +$budget->OBJECTIVEB + $budget->OBJECTIVEC + $budget->OBJECTIVED + $budget->OBJECTIVEE)/$total)*100 , 2, '.', '')}}% </i> </span>
                                         </div>
                                         @endforeach
                                       </div>
                                       <!-- /top tiles -->

							</div>
							</div>
                        </div>
                </div>
				
				<div class="panel panel-default">
                    <div class="panel-heading"><h5>Zones Budget Statistics </h5></div>
                        <div class="panel-body">
						{{$zones_budget_chart_view}}
                        </div>
                </div>
			
                <!--END CONTENT-->
               @stop
			   
			   @section('scripts')		
		<script>
		 // Bar chart
      var ctx = document.getElementById("mybarChart");
      var mybarChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: {{json_encode($labels)}},
          datasets: [{
            label: 'Budget',
            backgroundColor: [
            "#455C73",
            "#9B59B6",
            "#BDC3C7",
            "#26B99A",
            "#3498DB",
			"#34495E",
            "#B370CF",
            "#CFD4D8",
            "#36CAAB"
          ],
            data: {{json_encode($data)}}
          }]
        },

        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });	

	  // Pie chart
      var ctx = document.getElementById("mypieChart");
      var mypieChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: {{json_encode($labels)}},
          datasets: [{
            label: 'Budget',
			backgroundColor: [
            "#455C73",
            "#9B59B6",
            "#BDC3C7",
            "#26B99A",
            "#3498DB",
			"#34495E",
            "#B370CF",
            "#CFD4D8",
            "#36CAAB"
          ],
            data: {{json_encode($data)}}
          }]
        },

     
      });
		</script>
		@stop