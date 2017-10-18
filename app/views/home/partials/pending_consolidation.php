<div class="panel panel-danger">
    <div class="panel-heading">
        <h5>Pending Targets For HQ consolidation <span class="badge badge-warning"><?php echo count($pending_consolidation)?></span></h5>
    </div>

    <div class="panel-body">
        <table class="table table-striped table-hover table-bordered dtable">
            <tr>
                <th>Target</th>
				<th>Description</th>
            </tr>
	
          <?php foreach($pending_consolidation as $pending){?>
			<tr>
				<td> <?php echo $pending->objective.$pending->target_no?></td>
				<td> <?php echo $pending->ta_description?></td>
             </tr>
			<?php }?>
        </table>


        </div>
    </div>