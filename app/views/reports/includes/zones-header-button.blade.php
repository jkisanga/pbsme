<div class="">
<div class="btn-group">
      <input type="submit" class="btn btn-primary" value="Search"/>
</div>
   @if( isset($objectives)  || isset($selectedObjective)) 
    <div class="btn-group">
        <button type="button" class="btn btn-primary  dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
           Download <span class="caret"></span>
        </button>
	
        <ul class="dropdown-menu" role="menu">
            <li><a href="{{URL::to('reports/zoneBudget')}}"><i class="fa fa-file-excel-o"></i> Excel</a></li>
             <!--<li><a href="#"><i class="fa fa-file-pdf-o"></i> PDF</a></li>-->

        </ul>
		
    </div><!--btn group-->
	@endif
 </div>