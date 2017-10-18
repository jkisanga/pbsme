<div class="col-sm-12 col-md-12">

<ul class="breadcrumb">
		@if( Auth::user()->hasRole('manager') || Auth::user()->hasRole('supermanager') )
			 <li {{ (Request::is('reports/unitBudgetView') ? ' class="active"' : '') }}><a href="{{URL::to('reports/unitBudgetView')}}"> Unit Budgets</a></li>
		   <li {{ (Request::is('reports/unitBudgetSummary') ? ' class="active"' : '') }}><a href="{{{ URL::to('reports/unitBudgetSummary') }}}">Units Budget Summary </a></li>
                <li {{ (Request::is('reports/zonesBudgetView') ? ' class="active"' : '') }}><a href="{{{ URL::to('reports/zonesBudgetView')}}}">Zonal Budget</a></li>
                <li {{ (Request::is('reports/zonesDistribution') ? ' class="active"' : '') }}><a href="{{{ URL::to('reports/zonesDistribution')}}}">Zonal Budget Distribution</a></li>
			<li {{ (Request::is('reports/unitBudgetView') ? ' class="active"' : '') }}><a href="{{URL::to('reports/unitBudgetView')}}"> {{Auth::user()->unit->name}} Budget</a></li>
		  <li {{ (Request::is('reports/unitForm3cView') ? ' class="active"' : '') }}><a href="{{URL::to('reports/unitForm3cView')}}">{{Auth::user()->unit->name}} Form3c</a></li>
		  <li {{ (Request::is('reports/zoneForm3cView') ? ' class="active"' : '') }}><a href="{{URL::to('reports/zoneForm3cView')}}">Zonal Form3c</a></li>
			@else
			<li {{ (Request::is('reports/unitBudgetView') ? ' class="active"' : '') }}><a href="{{URL::to('reports/unitBudgetView')}}"> {{Auth::user()->unit->name}} Budget</a></li>
		  <li {{ (Request::is('reports/unitForm3cView') ? ' class="active"' : '') }}><a href="{{URL::to('reports/unitForm3cView')}}">Unit Form3c</a></li>
			@endif

           	@if( Auth::user()->hasRole('supermanager') )
           	<li {{ (Request::is('reports/zonesBudgetView') ? ' class="active"' : '') }}><a href="{{{ URL::to('reports/zonesBudgetView')}}}">Zonal Budget</a>
                <li {{ (Request::is('reports/overallBudget') ? ' class="active"' : '') }}><a href="{{{ URL::to('reports/overallBudget') }}}">Overall Budget</a></li>
                <li {{ (Request::is('reports/zonesBudgetSummary') ? ' class="active"' : '') }}><a href="{{{ URL::to('reports/zonesBudgetSummary')}}}">Zone Budget Summary</a></li>
		<li {{ (Request::is('reports/hqForm3cView') ? ' class="active"' : '') }}><a href="{{URL::to('reports/hqForm3cView')}}">HQ Form3c</a></li>
			@endif
		</ul>
</div>
