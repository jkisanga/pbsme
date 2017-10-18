

<div class="panel panel-info">
    <div class="panel-heading">
        <h5>Activities <span class="badge badge-warning"><?php echo count($activities)?></span>
        </h5>
    </div>

    <div class="panel-body">
        <p class="text-center">Total Budget for Current Financial year <label><?php echo $financial_year->year;?></label><br>
        <button><?php echo String::formatMoney($activities)?></button>
        </p>
     </div>
 </div>