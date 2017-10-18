<div class="pull-right mb-10">

<div class="btn-group">
      <input type="submit" class="btn btn-primary" value="Search"/>
</div>
 @if( isset($items)) 
    <div class="btn-group">
       <a href="{{URL::to('reports/unitForm3c')}}" class="btn btn-primary" ><i class="fa fa-file-excel"></i> Download</a>
    </div><!--btn group-->
	@endif
 </div>