@extends('action.layouts.default')

@section('content')
<div class="col-lg-12">
    <div class="panel panel-green">
        <div class="panel-heading">List of Targets
</div>
        <div class="panel-body">
        @if($is_zone_submitted == true)
			 <div class="alert alert-warning alert-block"> Budget for zone level for the current year has been submitted</div>
		 @else

        @if($submitted == true)

            <div class="alert alert-warning alert-block">Budget for  <strong>{{$current_unit->name}}</strong> for the current year has been submitted</div>

        @else
            <table class=" dt table table-hover table-striped">
                <thead>
                <tr>
                    <th>Target No</th>
                    <th>Target Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($objectives as $objective)
                <tr>
                   <th>OBJECTIVE {{$objective->ob_code}}</th>
                   <th colspan="3">{{$objective->ob_description}}</th>
                </tr>
                @foreach(Target::where('objective_id', '=', $objective->id)->orderBy('target_no')->get() as $item)
                <tr>
                    <td>{{$item->target_no}}</td>
                    <td>{{$item->ta_description}}</td>
                  <td><a href="{{URL::to('add_activity/'.$item->id)}}" class="btn btn-info">Add Activity</a> </td>
                </tr>
                @endforeach
                @endforeach
                </tbody>
		</table>
		@endif
		
		 @endif
		</div>
		
		</div>
		</div>
@stop


@stop