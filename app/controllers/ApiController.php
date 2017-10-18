<?php
class ApiController  extends BaseController{

    public function get_targets_by_objective($objective_id){
        $targets = Target::where('objective_id','=',$objective_id)->orderBy('target_no')->get();
        return Response::json($targets);
    }

}