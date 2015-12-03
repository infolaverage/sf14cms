<?php slot("breadcrumbs")?>
<?php include_partial("general/breadcrumbs", ["breadcrumbs"=>$breadcrumbs]);?>
<?php end_slot()?>

<?php
    /**
     * @var Cms $entity
     */
?>
<div class="">

    <div class="h1">
        <?php echo $entity->getFinalTitle()?>
    </div>

    <div class="row">
        <div class="col-sm-16">

            <?php //include_partial(
//                Project::getThemePartial("cms", "ccnt", array()),
//                array(
//                    "entity" => $entity
//                )
//            );?>

            <div class="ccnt">
                <?php echo $entity->getFinalContent(ESC_RAW)?>
                <div class="clearfix"></div>
            </div>

            <?php if(
                $site->getId() == 1 &&
                $entity->getRole() == CmsTable::getRoleOptionKey("contact_thank_you")
            ):?>
            <?php endif;?>

            <?php //include_partial("social/addthis/default")?>

        </div>
        <div class="col-sm-7 col-sm-offset-1">
            <?php include_partial("custom_content/sidebar");?>
        </div>
    </div>

</div>