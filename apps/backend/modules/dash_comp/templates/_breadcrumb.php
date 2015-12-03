<?php #Project::prePrint($breadcrumbs,1)
    $with_hours         = isset($with_hours) ? $with_hours : null;
    $datepicker_type    = isset($datepicker_type) ? $datepicker_type : null;
?>
    <ul class="page-breadcrumb breadcrumb">
        <?php $bi = 0; foreach($breadcrumbs as $bc):?>
            <?php if($bi==0):?>
                <li>
                    <i class="icon-home"></i>
                    <a href="<?php echo url_for("@homepage")?>">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
            <?php endif;?>
            <li>
                <a href="<?php echo url_for($bc['link'])?>" class="<?php if($bi == count($breadcrumbs)-1){ echo "active"; } ?>"><?php echo $bc['text']?></a>
                <?php if($bi < count($breadcrumbs)-1):?>
                    <i class="fa fa-circle"></i>
                <?php else:?>
                <?php endif;?>
            </li>
            <?php $bi++; endforeach;?>

        <?php if (isset($with_datepicker) && $with_datepicker): ?>
            <li class="pull-right">
                <div id="dashboard-report-range" class="dashboard-date-range <?php echo (isset($datepicker_color)) ? "".$datepicker_color : '' ?> tooltips ">
                    <i class="fa fa-calendar"></i>
                    <span></span>
                    <i class="fa fa-angle-down"></i>
                </div>
            </li>
        <?php endif; ?>
    </ul>



<?php if (isset($with_datepicker) && $with_datepicker): ?>
    <?php include_partial("dash_comp/datepicker", array("with_hours" => $with_hours, "ptype" => $datepicker_type)) ?>
<?php endif; ?>