<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <?php include_http_metas() ?>
    <?php //include_metas() ?>
    <?php //include_title() ?>
    <?php include_custom_title() ?>
    <?php include_custom_metas()?>

    <link rel="shortcut icon" href="/favicon.ico" />

    <?php include_partial("general/head/head")?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body onload="breakoutOfFrame()">

    <?php include_component("site_menu", "top")?>

    <?php include_slot("content_top_outer_1");?>

    <?php
        $base_container_class = "container";
        //echo str_repeat("<br/>",8);var_dump(has_slot("base_container_class"));
        if(has_slot("base_container_class")){
            $base_container_class = get_slot("base_container_class");
        }
    ?>
    <div class="<?php echo $base_container_class?>">

        <?php if(get_slot("breadcrumbs")){
            include_slot("breadcrumbs");
        }?>

        <?php include_partial("general/alert")?>

        <?php echo $sf_content ?>
    </div>

    <?php include_partial("custom_content/footer/footer")?>

</body>
</html>
