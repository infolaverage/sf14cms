<?php slot("breadcrumbs")?>
<?php include_partial("general/breadcrumbs", ["breadcrumbs"=>$breadcrumbs]);?>
<?php end_slot()?>

<div class="page-reference">

    <?php if($cms):?>
        <?php include_partial("cms/compCms",["entity"=>$cms])?>
    <?php endif?>

    <?php include_partial("reference/list/list",["entities"=>$entities])?>

</div>