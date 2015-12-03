<?php
    /**
     * @var Site $entity
     */
    $entity = $site;
?>
<?php slot("page_title")?>
    <h1>
        <?php include_partial("modelview/base/is_active", array("condition" => $entity->getIsActive(), "color_schema"=>1)); ?>
        <?php echo $entity->getFinalName()?>
        <small>
            site
            <?php echo $entity->getDomain()?>
        </small>
    </h1>
<?php end_slot();?>
<?php slot("page_toolbar")?>
    <a href="<?php echo url_for("custom_site_setting", array("site_id" => $entity->getId())) ?>"
       class="btn btn-primary"
    >
        <i class="fa fa-cog"></i>
        <?php echo Translate::from("cst:site:show:btn:edit_settings:text")?>
    </a>
<?php end_slot();?>
<?php slot("page_breadcrumb")?>
    <?php include_partial("dash_comp/breadcrumb", array("breadcrumbs" => $breadcrumbs)); ?>
<?php end_slot()?>

<?php //slot("page_content_title") ?>
<?php #include_partial("modelview/base/is_active", array("condition" => $entity->getIsEnabled(), "color_schema"=>1, "type" => "is_enabled"))?>
<?php //end_slot(); ?>
<?php //slot("page_content_top_right") ?>
<?php //end_slot() ?>

<?php $s = $entity->getCurrentSiteSettings();?>
<?php //Project::prePrint($s);?>

<?php /*
    <table class="table">
        <tr>
            <th>Contact Upload Dir</th>
            <td>

                Relative: <?php echo $entity->getFinalContactUploadDir()?><br/>
                Absolute: <?php echo $entity->getFinalContactUploadPath()?>

            </td>
        </tr>
    </table>
*/?>
<?php
    /*
    $cms_roles = CmsTable::getRoleOptions();
    $cms_role_urls = array();
    foreach($cms_roles as $r_key => $r_value){
        $cms_role_urls[] = array(
            "text" => $r_value,
            "href" => url_for(
                "custom_site_cms_for_site",
                array(
                    "role_id" => $r_key,
                    "site_id" => $entity->getId()
                )
            )
        );
    }
    */
?>