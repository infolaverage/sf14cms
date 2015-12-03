<?php slot("breadcrumbs")?>
    <?php include_partial("general/breadcrumbs", ["breadcrumbs"=>$breadcrumbs]);?>
<?php end_slot()?>

<div class="page-team-member">

    <?php if($cms):?>
        <?php include_partial("cms/compCms",["entity"=>$cms])?>
    <?php endif?>

    <?php include_partial("team_member/list/list",["entities"=>$entities])?>

</div>