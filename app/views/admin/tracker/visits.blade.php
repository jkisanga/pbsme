@extends('action.layouts.default')


@section('content')
<div class="col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4>User Log: Visits</h4>
                            </div>
                            <div class="panel-body">
                                <table class="dt table table-hover table-striped table-bordered table-responsive ">
                                    <thead>
                                    <tr>
										<th>User</th>
										 <th>IP</th>
										 <th> Device</th>
										 <th> Browser</th>
										 <th>last login</th>

									 </tr>
									 </thead>
									<tbody>
									 @foreach($sessions as $session)
									 <tr>
										 <td>{{ $session->user_id }}</td>
										 <td>{{ $session->client_ip}}</td>
										 <td>{{ $session->device->kind . ' - ' . $session->device->platform }}</td>
										<td>{{$session->agent->browser . ' - ' . $session->agent->browser_version}}</td>
										<td>{{ $session->created_at}}</td>										
										</tr>
										
									@endforeach
									</tbody>
                                </table>
								
					</div>
                 </div>
        </div>


                    @stop
                    {{-- Scripts --}}
                    @section('scripts')
                    	<script type="text/javascript">
                    		var oTable;
                    		$(document).ready(function() {
                    			oTable = $('.table').dataTable( {

                    			});
                    		});
                    	</script>
                    @stop