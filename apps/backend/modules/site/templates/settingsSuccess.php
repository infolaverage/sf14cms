<?php
    $url_to_site_show = url_for("site_show", $site);
?>
<?php slot("page_title")?>
    <h1>
        Site Options
        <small>
            site
            <?php //echo $site->getDomain()?>
        </small>
    </h1>
<?php end_slot()?>
<?php slot("page_toolbar")?>
    <a class="btn green" href="<?php echo $url_to_site_show?>">
        <i class="fa fa-globe"></i>
        <?php echo Translate::from("cst:helper:site:btn:link_to_show:text")?>
    </a>
<?php  end_slot()?>

<?php slot("page_breadcrumb")?>
    <?php include_partial("dash_comp/breadcrumb", array("breadcrumbs" => $breadcrumbs)); ?>
<?php end_slot()?>

<?php if(isset($form)):?>

    <div class="portlet light">
        <div class="portlet-body form">
            <?php include_partial("site/settings/form", array("form" => $form)); ?>
        </div>
    </div>


<?php endif;?>