<div class="panel panel-info">
    <div class="panel-heading">
        <h5><strong><?php echo Auth::user()->unit->zone->zone_name;?></strong> units/districts submitted budgets financial year <b> <?php echo $financial_year->year;?></b><span class="badge badge-warning"><?php echo count($submitted_budgets)?></span></h5>
    </div>

    <div class="panel-body">

        <table class="table table-striped table-hover table-bordered dtable">
            <tr>
                <th>Unit #</th>
                <th>Submitted By</th>
                <th>Action</th>
            </tr>
            <?php
            foreach($submitted_budgets as $budget){?>
                <tr>
                    <td><?php echo $budget->unit?></td>
                    <td><?php echo $budget->first_name?> <?php echo $budget->last_name?> (<?php echo $budget->title?> )</td>
                    <td><a href="<?php echo URL::to('budget/unlock',$budget->id)?>" class="btn btn-primary" onclick="return confirm('are you sure?')"> Unlock</a></td>
                </tr>
            <?php }?>
        </table>
    </div>
</div>